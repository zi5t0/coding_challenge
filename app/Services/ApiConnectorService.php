<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\True_;

final class ApiConnectorService
{
    protected $url;
    protected $http;
    protected $headers;

    public function __construct(Client $client=null)
    {
        $client = new Client();
        $this->url = 'https://api.tvmaze.com/search/shows?q=';
        $this->http = $client;
        $this->headers = [
            'cache-control' => 'no-cache',
            'content-type' => 'application/x-www-form-urlencoded',
        ];
    }


    public function getFilmResponse(String $name = null)
    {
        $full_path = $this->url;
        $full_path .= $name;

        $request = $this->http->get($full_path, [
            'headers'         => $this->headers,
            'timeout'         => 30,
            'connect_timeout' => true,
            'http_errors'     => true,
        ]);

        $response = $request ? $request->getBody()->getContents() : null;
        $status = $request ? $request->getStatusCode() : 500;

        if ($response && $status === 200 && $response !== 'null') {

            $film_name = Str::lower(json_decode($response)[0]->show->name);
            $name = Str::lower($name);

            if ($film_name == $name) {
                $genres = implode(",", json_decode($response)[0]->show->genres);
                $film_collection = collect(json_decode($response)[0]->show)->only(['name', 'type', 'language', 'runtime', 'summary']);
                $film_collection['genres'] = $genres;

                return $film_collection->all();
            }
        }

        return null;
    }
}
