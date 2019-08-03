<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Operator;
use App\Admin;
use App\Department;
use App\Lecturer;
use Faker\Generator as Faker;

class CreateUserPostTest extends TestCase
{
  public function test_create_user_as_operator(){
    $this->withoutExceptionHandling();

    $this->actingAs(factory(Operator::class)->make());

      $response=$this->post('/api/admin/user',[
        'name' => 'testoperator',
        'email' => 'testoperator@testoperator.com',
        'password' => 'password', // password
        'phone' => '07541070001',
        'usertype'=>'Operator'
      ]);
      $response->assertStatus(404);
  
  }
  public function test_create_user_as_admin(){
    $this->withoutExceptionHandling();

    $delete=Lecturer::where('name','testlecturer')->first();
    if($delete){
      $delete->delete();
    }
    $this->actingAs(factory(Admin::class)->make());
    
    $department=factory(Department::class)->create();
   
      $response=$this->post('/api/admin/user',[
        'name' => 'testlecturer',
        'email' => 'testlecturer@testlecturer.com',
        'password' => 'password', // password
        'phone' => '07541070001',
        'usertype'=>'Lecturer',
        'Department_id'=>$department->id
      ]);
      $response->assertStatus(200);

      $created=Lecturer::where('name','testlecturer')->first();
      // $response->assertStatus(200);
      $this->assertEquals($created->name,'testlecturer');

      $delete=Lecturer::where('name','testlecturer')->first();
      $delete->delete();
      $department->delete();

  }
}
