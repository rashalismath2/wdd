<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Operator;
use App\Admin;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RedirectTest extends TestCase
{
 
    public function test_whether_we_get_redirected_to_admin_login()
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/admin/login');
    }

    public function test_whether_we_get_redirected_to_operator_login()
    {
        $response = $this->get('/operator');
        $response->assertRedirect('/operator/login');
    }

    public function test_operator_login(){
        
        $this->actingAs(factory(Operator::class)->create());
        $response = $this->get('/operator');
        $response->assertStatus(302);
    }
    public function test_admin_login(){
        // $this->withoutExceptionHandling();

        $this->actingAs(factory(Admin::class)->create());
        $response = $this->get('/admin');
        $response->assertStatus(200);
    }
}
