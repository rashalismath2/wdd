<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Operator;

class LoginTests extends TestCase
{
   public function testAdminLogin(){
       
    $this->withoutExceptionHandling();
       $response=$this->post('admin/login',[
           'email'=>'admin@admin.com',
           'password'=>'password'
       ]);
       $response->assertStatus(302);
       $response->assertRedirect(route('admin-dashboard'));
   }
   
   public function testOperatorLogin(){
       $this->withoutExceptionHandling();

       $operator=factory(Operator::class)->create();
       $response=$this->post('operator/login',[
           'email'=>$operator->email,
           'password'=>'password'
       ]);

       $response->assertStatus(302);
       $response->assertRedirect(route('operator-dashboard'));
       Operator::find($operator->id)->delete();
   }

   public function testOperatorLoginWithWrongInformation(){
       $this->withoutExceptionHandling();

       $operator=factory(Operator::class)->create();
       $response=$this->post('operator/login',[
           'email'=>$operator->email,
           'password'=>'passworda'
       ]);

       $response->assertStatus(302);
       $response->assertRedirect(route('operator-login-show'));

       Operator::find($operator->id)->delete();
   }

}
