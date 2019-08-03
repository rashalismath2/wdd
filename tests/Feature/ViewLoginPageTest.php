<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewLoginPageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_whether_admin_login_window_get_rendered(){
        $response=$this->get('/admin/login');
        $response->assertStatus(200);
        $response->assertSee('Admin-Login');
    }
    public function test_whether_operator_login_window_get_rendered(){
        $response=$this->get('/operator/login');
        $response->assertStatus(200);
        $response->assertSee('Operator-Login');
        $response->assertViewHas('data');
    }
}
