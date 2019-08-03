<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SeeScheduleTest extends TestCase
{
    public function test_whether_we_can_get_shcedule_records(){
        $response=$this->post(route('seeschedule'),[
            'floornumber'=>1,
            'roomnumber'=>1
        ]);
      
        $response->assertJson([
            ["batch_id"=>117,"id"=>94,"date"=>"2019-01-03","title"=>"testdepartment","name"=>"Kip Huels","day"=>"Thursday","onetime"=>0,"time"=>"Morning"]
        ]);
        $response->assertStatus(200);
    }
    
}
