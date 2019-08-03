<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ValidateCreateUser;
use App\Http\Resources\CreateUsers;
use App\Lecturer;
use App\Operator;
use App\Schedule;
use App\Batch;
use App\Resource;
use App\Department;
use App\Http\Resources\lecturerscollection;
use App\Http\Resources\operatorscollection;
use  App\Http\Requests\bookhall;
use Illuminate\Support\Facades\DB;
use App\Exports\LecturerSchedule;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin',['except'=>['getsavedata','getsavedlecturerdata','getscheduleforlecturer','clearschedule','createuser','getuser','deleteuser','edithall','getlecturer','bookhall']]);
    }
 
    public function index(){
        return view('admin-dashboard');
    }

    public function createuser(ValidateCreateUser $request){

        if(Gate::allows('admin-only',auth()->user())){
            if($request->input('usertype')==="Lecturer"){
                $lecturer=new Lecturer;
    
                $lecturer->name= $request->input('name');
                $lecturer->email=$request->input('email');
                $lecturer->phone=$request->input('phone');
                $lecturer->departments_id=$request->input('Department_id');
                $lecturer->password=bcrypt($request->input('password'));
                $lecturer->save();
            }
    
            if($request->input('usertype')==="Operator"){
                $operator=new Operator;
    
                $operator->name= $request->input('name');
                $operator->email=$request->input('email');
                $operator->contact_no=$request->input('phone');
                $operator->password=bcrypt($request->input('password'));
                $operator->save();
            }
        
            return response()->json('User created',200);
        }
        
            return response()->json("You are not allowed",404);
        
    }

    public function getuser(){
        $operator=Operator::all();
        $lecturer=Lecturer::all();

        lecturerscollection::withoutWrapping();
        operatorscollection::withoutWrapping();

        return response()->json([
            'lecturers' => lecturerscollection::collection($lecturer),
            'operators' => operatorscollection::collection($operator)
        ]);
    

    }

    public function deleteuser(Request $request){

        if($request->usertype==='Operator'){
            $operator=Operator::find($request->userid);
            if($operator->delete()){
                return "User Deleted";
            }else{
                return "Unable to delete the user";
            }
           
        }

        if($request->usertype==='Lecturer'){
            $lecturer=Lecturer::find($request->userid);
            if($lecturer->delete()){
                return "User Deleted";
            }else{
                return "Unable to delete the user";
            }
        }

    }

    public function getlecturer(){
        $lecturer=Lecturer::all();

        lecturerscollection::withoutWrapping();

        return lecturerscollection::collection($lecturer);
    }
    
    public function getscheduleforlecturer(Request $request){
        $lecturer=Lecturer::where('name',$request->lecturer)->first();
            
        $result=DB::table('schedule')
        ->where('schedule.lecturer_id',$lecturer->id)
        ->join('resources', 'resources.id', '=', 'schedule.resource_id')
        ->join('departments','departments.id','=','schedule.department_id') 
        ->select(   'departments.title',
                    'schedule.time',
                    'schedule.day',
                    'resources.floor_number',
                    'resources.room_no' ,
                    'schedule.id',
                    'schedule.batch_id'
                    )
        ->get();

                if($result){
                    return response()->json($result);
                }
        return response()->json(
          [  'Error'=>'Record not found'],404
        );

    }

    public function getsavedlecturerdata(Request $request){
        // $file=public_path()."/storage/schedule.xlsx"; 
       Excel::store(new LecturerSchedule($request->lecturer), '/public/lecturersschedule.xlsx');
    //    getsavedata();
       return public_path()."/storage/lecturersschedule.xlsx";

    }
    public function getsavedata(){
        $file= public_path()."/storage/lecturersschedule.xlsx";
         return response()->download($file);
     }


    public function bookhall(bookHall $request){

            $lecturer=Lecturer::where('name',$request->lecturer)->first();
            $department=Department::where('title','like',$request->department.'%')->first();
            $resource=Resource::where('floor_number',$request->floornum,'and')->where('room_no',$request->roomnum)->first();
            $batch=Batch::where('batch_id',$request->batchid,'and')->where('departments_id',$department->id)->first();
            $exist=Schedule::where('resource_id',$resource->id,'and')
                                // ->where('onetime',$request->onetime,'and')
                                ->where('onetime',$request->onetime,'and')
                                ->where('time',$request->time,'and')
                                ->where('day',$request->day)->first();

            if($exist){
                $lec=Lecturer::find($exist->lecturer_id);
                return response()->json(['Message'=>"The resource is already allocated on $request->day $request->time for $lec->name"],404);
            }else{
                
                try{
                    $schedule=new Schedule;

                    $schedule->time=$request->time;
                    $schedule->date=$request->date;
                    $schedule->lecturer_id=$lecturer->id;
                    $schedule->batch_id=$batch->id;
                    $schedule->department_id=$department->id;
            
                    $schedule->resource_id=$resource->id;
                    $schedule->day=$request->day;
                    $schedule->onetime=$request->onetime;
                    $schedule->save();

                    return response()->json(['Message'=>"The Resource allocated on $request->date $request->time"],200);
                }
                catch(Exception $e){
                    return $e;
                }
            }
    }
    public function clearschedule(){
        
        try{
            Schedule::truncate();

            }
        catch(Exception $e){
            return response()->json("Message: $e");
        }
        return response()->json('Schedule cleared');
    }

    public function edithall(bookHall $request){


        $lecturer=Lecturer::where('name',$request->lecturer)->first();
        $department=Department::where('title','like',$request->department.'%')->first();
        $resource=Resource::where('floor_number',$request->floornum,'and')->where('room_no',$request->roomnum)->first();
        $batch=Batch::where('batch_id',$request->batchid,'and')->where('departments_id',$department->id)->first();
           
        $exist=Schedule::where('resource_id',$resource->id,'and')
                            ->where('date',$request->date,'and')
                            ->where('time',$request->time,'and')
                            ->where('onetime','1','and')
                            // ->where('onetime','0','and')
                            ->where('day',$request->day)->first();

        if($exist){
            $exist->delete();

            try{
                $schedule=new Schedule;

                $schedule->time=$request->time;
                $schedule->date=$request->date;
                $schedule->lecturer_id=$lecturer->id;
                $schedule->batch_id=$batch->id;
                $schedule->department_id=$department->id;
        
                $schedule->resource_id=$resource->id;
                $schedule->day=$request->day;
                $schedule->onetime=$request->onetime;
                $schedule->save();

                return response()->json(['Message'=>"The Resource changed on $request->date $request->time"]);
            }
            catch(Exception $e){
                return $e;
            }
        }else{
            try{
                $schedule=new Schedule;

                $schedule->time=$request->time;
                $schedule->date=$request->date;
                $schedule->lecturer_id=$lecturer->id;
                $schedule->batch_id=$batch->id;
                $schedule->department_id=$department->id;
   
                $schedule->resource_id=$resource->id;
                $schedule->day=$request->day;
                $schedule->onetime=$request->onetime;
                $schedule->save();

                return response()->json(['Message'=>"The Resource changed on $request->date $request->time"]);
            }
            catch(Exception $e){
                return $e;
            }
        }
}
    


}
