<?php

namespace Tests\Acceptance;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetsFilmCorrectlyTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_if_existing_film_returns_film_with_correct_json_structure()
    {

        $response = $this->getJson('?q=fbi');

        $response->assertStatus(200)
            ->assertJsonStructure([
                "name",
                "type",
                "language",
                "runtime",
                "summary",
                "genres"
            ]);
    }


    public function test_if_fake_film_returs_204_code()
    {
        $response = $this->get('?q=trolens');

        $response->assertStatus(204);
    }
}
