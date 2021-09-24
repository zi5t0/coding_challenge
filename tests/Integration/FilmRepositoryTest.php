<?php

namespace Tests\Integration;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Film;
use GuzzleHttp\Client;
use App\Services\ApiConnectorService;

use App\Repositories\FilmRepository;

class FilmRepositoryTest extends TestCase
{

    public function test_if_respository_saves_film()
    {

        $client = new Client();
        $api_service = new ApiConnectorService($client);
        $film = $api_service->getFilmResponse("Foundation");

        $film_model = new Film();
        $film_repository = new FilmRepository($film_model);
        $created = $film_repository->create($film);

        $this->assertNotNull($created);

    }


    public function test_if_respository_search_film_and_returns()
    {

        $client = new Client();

        $film_model = new Film();
        $film_repository = new FilmRepository($film_model);
        $film = $film_repository->search("fbi");

        $this->assertNotNull($film);

    }
}
