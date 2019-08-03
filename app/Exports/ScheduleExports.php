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

class ScheduleExports implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $department,$batch;
    public function __construct(string $department,int $batch){
        $this->department=$department;
        $this->batch=$batch;
    }

    public function headings():array
    {
        return [
            'Lecturer',
            'Time',
            'Day',
            'Floor_no',
            'Room_no',
        ];
    }

    public function collection()
    {

        $department=Department::where('title',$this->department)->first();

        $result=DB::table('schedule')
        ->where('schedule.department_id',$department->id,'and')
        ->where('schedule.batch_id',$this->batch)
        ->join('lecturers', 'lecturers.id', '=', 'schedule.lecturer_id') 
        ->join('resources', 'resources.id', '=', 'schedule.resource_id')
        ->select('lecturers.name',
                    'schedule.time',
                    'schedule.day',
                    'resources.floor_number',
                    'resources.room_no' 
                   
                    )->get();

        return $result;
    }
}
