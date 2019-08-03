<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Department;
use App\Batch;
use App\Lecturer;
use App\Schedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LecturerSchedule implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public $lecturer;
    public function __construct(string $lecturer){
        $this->lecturer=$lecturer;
    }

    public function collection()
    {

        $lecturer=Lecturer::where('name',$this->lecturer)->first();
            
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

        return $result;
    }

    
    public function headings():array
    {
        return [
            'Day',
            'Time',
            'Department',
            'Batch_id',
            'Floor_no',
            'Room_no',

        ];
    }
}
