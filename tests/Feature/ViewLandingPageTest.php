<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewLandingPageTest extends TestCase
{
    public function testIf_We_Get_The_Landing_Page()
    {
        $response = $this->get('/');
        $response->assertSee('Admin','Operator');
        $response->assertStatus(200);
    }
}
