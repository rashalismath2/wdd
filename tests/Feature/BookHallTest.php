<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Resource;
use App\Lecturer;
use App\Department;
use App\Schedule;
use App\Batch;

class BookHallTest extends TestCase
{  
     protected $lecturer;
     protected $resource;
     protected $batch;
     

    public function setUp():void{
        parent::setUp();
        $this->lecturer=factory(Lecturer::class)->create();
        $this->resource=factory(Resource::class)->create();
        $this->batch=factory(Batch::class)->create();
    }

    
    public function test_whether_we_can_book_hall(){
        $this->withoutExceptionHandling();
        $response=$this->post('/api/admin/bookhall',[
            'date'=>date("Y/m/d"),
            'time'=>'morning',
            'lecturer'=>$this->lecturer->name,
            'batchid'=>1,
            'department'=>Department::find($this->lecturer->departments_id)->title,
            'floornum'=>$this->resource->floor_number,
            'roomnum'=>$this->resource->room_no,
            'day'=>'monday',
            'onetime'=>0
            ]);
           
            $response->assertStatus(200);

            Schedule::where('lecturer_id',$this->lecturer->id,'and')
            ->where('department_id',$this->lecturer->departments_id,'and')
            ->where('resource_id',$this->resource->id,'and')
            ->where('day','monday','and')
            ->where('onetime',0,'and')
            ->where('batch_id',$this->batch->id)->first()->delete();
            $this->lecturer->delete();
            $this->batch->delete();
            Department::where('title','testdepartment')->first()->delete();
            $this->resource->delete();

    }

    public function test_whether_we_get_to_edit_record(){
        $this->withoutExceptionHandling();
        $response=$this->post('/api/admin/bookhall',[
            'date'=>date("Y/m/d"),
            'time'=>'morning',
            'lecturer'=>$this->lecturer->name,
            'batchid'=>1,
            'department'=>Department::find($this->lecturer->departments_id)->title,
            'floornum'=>$this->resource->floor_number,
            'roomnum'=>$this->resource->room_no,
            'day'=>'monday',
            'onetime'=>0
            ]);

            $response=$this->post('/api/admin/bookhall',[
                'date'=>date("Y/m/d"),
                'time'=>'morning',
                'lecturer'=>$this->lecturer->name,
                'batchid'=>1,
                'department'=>Department::find($this->lecturer->departments_id)->title,
                'floornum'=>$this->resource->floor_number,
                'roomnum'=>$this->resource->room_no,
                'day'=>'monday',
                'onetime'=>0
                ]);
        $response->assertStatus(404);

        Schedule::where('lecturer_id',$this->lecturer->id,'and')
        ->where('department_id',$this->lecturer->departments_id,'and')
        ->where('resource_id',$this->resource->id,'and')
        ->where('day','monday','and')
        ->where('onetime',0,'and')
        ->where('batch_id',$this->batch->id)->first()->delete();
        $this->lecturer->delete();
        $this->batch->delete();
        Department::where('title','testdepartment')->first()->delete();
        $this->resource->delete();

    }

    public function tearDown():void{
        parent::tearDown();
      

    }

   
}
