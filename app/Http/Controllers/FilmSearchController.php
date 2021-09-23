<?php

namespace App\Http\Controllers;

use App\Repositories\FilmRepository;
use App\Services\ApiConnectorService;
use App\Services\UrlService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FilmSearchController extends Controller
{
    private $repository;
    private $api_connector_service;


    public function __construct(FilmRepository $film_repository, ApiConnectorService $api_connector_service) {
        $this->repository               = $film_repository;
        $this->api_connector_service    = $api_connector_service;
    }


    public function search(Request $request) {

        // TO-DO: Refactor this
        $film_name = ($request->has('q') && $request->get('q') != null) ? $request->get('q') : null;
        $local_film = $this->repository->search($film_name);

        // TO-DO: Check to refactor or not
        if ($local_film != null) {
            return $local_film;
        } else {
            $remote_film = $this->api_connector_service->getFilmResponse($film_name);
            $this->repository->create($remote_film);
            return $remote_film;
        }
    }
}
