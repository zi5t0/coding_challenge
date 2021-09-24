<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HealcheckTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_base_api_url_returns_200_code()
    {
        $response = $this->get('?q=h');

        $response->assertStatus(200);
    }

    public function test_incorrect_base_url_returns_404_code()
    {
        $response = $this->get('/');

        $response->assertStatus(404);
    }

    
    public function test_whatever_segment_returns_404_code()
    {
        $response = $this->get('/whatever');

        $response->assertStatus(404);
    }
}
