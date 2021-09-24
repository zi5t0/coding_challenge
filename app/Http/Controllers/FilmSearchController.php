<?php

namespace App\Http\Controllers;

use App\Repositories\FilmRepository;
use App\Services\ApiConnectorService;
use App\Services\UrlService;
use App\Filters\FilmFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FilmSearchController extends Controller
{
    private $repository;
    private $api_connector_service;
    private $film_filter;


    public function __construct(FilmRepository $film_repository, ApiConnectorService $api_connector_service, FilmFilter $film_filter) {
        $this->repository               = $film_repository;
        $this->api_connector_service    = $api_connector_service;
        $this->film_filter              = $film_filter;
    }


    public function search(Request $request) {

        if ($this->film_filter->filter($request) == false) {
            // Refactor this with appropiate response
            return response()->json(['error' => 'Incorrect URL, please use ?q=* format'], 404);              
        }
        
        $film_name = $request->get('q');
        $local_film = $this->repository->search($film_name);

        if ($local_film != null) {
            return $local_film;
        } else {
            $remote_film = $this->api_connector_service->getFilmResponse($film_name);
            if ($remote_film != null) {
                $this->repository->create($remote_film);
                return $remote_film;
            } else {
                return response()->json(['error' => 'Film not found.'], 204);        
            }
        }
    }
}
