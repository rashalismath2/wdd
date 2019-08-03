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

class ScheduleDepartmentExport implements FromCollection, WithHeadings
{
     /**
    * @return \Illuminate\Support\Collection
    */
    public $department;
    public function __construct(string $department){
        $this->department=$department;
    }

    public function headings():array
    {
        return [
            'Lecturer',
            'Time',
            'Day',
            'Floor_no',
            'Room_no',
            'Batch_id'
        ];
    }

    public function collection()
    {

        $department=Department::where('title',$this->department)->first();

        $result=DB::table('schedule')
        ->where('schedule.department_id',$department->id)
        ->join('lecturers', 'lecturers.id', '=', 'schedule.lecturer_id') 
        ->join('resources', 'resources.id', '=', 'schedule.resource_id')
        ->select('lecturers.name',
                    'schedule.time',
                    'schedule.day',
                    'resources.floor_number',
                    'resources.room_no', 
                   'schedule.batch_id'
                    )->get();

        return $result;
    }
}
