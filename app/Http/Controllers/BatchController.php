<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Batches as batchresourcecollection;
use App\Http\Resources\Departmens as departmentsresourcecollection;
use App\Department;
use App\Batch;
use App\Lecturer;
use App\Schedule;
use Illuminate\Support\Facades\DB;
use App\Exports\ScheduleExports;
use App\Exports\ScheduleDepartmentExport;
use Maatwebsite\Excel\Facades\Excel;


class BatchController extends Controller
{
    public function getbatchespost(Request $request){

        $lecturer=Lecturer::where('name',$request->lecturer)->first();
        $department=Department::find($lecturer->departments_id);
        $batches=Batch::where('departments_id',$department->id)->get();
 
        $response=['Department'=>$department->title,'Batches'=> $batches];
        
       return $response;
    
    }

    public function getdepartmentsget(Request $request){

        $department=Department::all();
        // $batches=Batch::where;
        return $department;
    }
    
    public function getbatchesforreports(Request $request){

        $department=Department::where('title',$request->department)->first();
        $batches=Batch::where('departments_id',$department->id)->get();
        return $batches;
    }

    public function getbatchreport(Request $request){

        $department=Department::where('title',$request->department)->first();

        // select lecturers.name,schedule.time,schedule.day,resources.floor_number,
        // resources.room_no from schedule 
        // join lecturers on schedule.lecturer_id=lecturers.id join resources on 
        // resources.id=schedule.resource_id where department_id=2 and batch_id=1;

        $result=DB::table('schedule')
        ->where('schedule.department_id',$department->id,'and')
        ->where('schedule.batch_id',$request->batch)
        ->join('lecturers', 'lecturers.id', '=', 'schedule.lecturer_id') 
        ->join('resources', 'resources.id', '=', 'schedule.resource_id')
        ->select('lecturers.name',
                    'schedule.time',
                    'schedule.day',
                    'resources.floor_number',
                    'resources.room_no' ,
                    'schedule.id'
                    )
        ->get();


        return $result;
    }

    public function getdepartmentreport(Request $request){

        $department=Department::where('title',$request->department)->first();

        // select lecturers.name,schedule.time,schedule.day,resources.floor_number,
        // resources.room_no from schedule 
        // join lecturers on schedule.lecturer_id=lecturers.id join resources on 
        // resources.id=schedule.resource_id where department_id=2 and batch_id=1;

        $result=DB::table('schedule')
        ->where('schedule.department_id',$department->id)
        ->join('lecturers', 'lecturers.id', '=', 'schedule.lecturer_id') 
        ->join('resources', 'resources.id', '=', 'schedule.resource_id')
        ->select('lecturers.name',
                    'schedule.time',
                    'schedule.day',
                    'resources.floor_number',
                    'resources.room_no' ,
                    'schedule.id',
                    'schedule.batch_id'
                    )
        ->get();


        return $result;
    }

    public function savedata(Request $request){
        
        // $file=public_path()."/storage/schedule.xlsx";
        
       Excel::store(new ScheduleExports($request->department,$request->batch), '/public/schedule.xlsx');
       return public_path()."/storage/schedule.xlsx";
    }
    public function getsavedata(Request $request){
        $file= public_path()."/storage/schedule.xlsx";
         return response()->download($file);
     }
 

    public function savedepartmentdata(Request $request){
        // $file=public_path()."/storage/schedule.xlsx"; 
       Excel::store(new ScheduleDepartmentExport($request->department), '/public/departmentschedule.xlsx');
       return public_path()."/storage/departmentschedule.xlsx";
    }
    public function getdepartmentsavedata(Request $request){
        $file= public_path()."/storage/departmentschedule.xlsx";
         return response()->download($file);
     }

  

        
}
