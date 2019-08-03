<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Getdatavalidator;
use App\Resource;
use App\Schedule;
use Illuminate\Support\Facades\DB;

class getData extends Controller
{
    public function index(Getdatavalidator $request){


                
            $floornumber=$request->floornumber;
            $roomnumber=$request->roomnumber;
            $resource=Resource::where('floor_number',$floornumber,'and')->where('room_no',$roomnumber)->first();

            if($resource){
                $result=DB::table('departments')
                ->join('schedule', 'departments.id', '=', 'schedule.department_id')
                ->where('schedule.resource_id',$resource->id)
                ->join('lecturers', 'schedule.lecturer_id', '=', 'lecturers.id')
                ->select('schedule.batch_id',
                            'schedule.id',
                            'schedule.date',
                            'departments.title',
                            'lecturers.name', 
                            'schedule.day', 
                            'schedule.onetime',
                            'schedule.time')
                ->get();
                
                return response()->json($result)->setStatusCode(200);

            }else{
                 return response()->json(['Message'=>'No data found']);
            }

         
    
        // select s.time,s.batch_id,d.title,s.date,l.name from departments as d inner join 
        // schedule as s on s.department_id=d.id and s.resource_id in(select id from resources 
        // where floor_number=1 and room_no=1) inner join lecturers as l on l.id=s.lecturer_id  ;
    }
}
