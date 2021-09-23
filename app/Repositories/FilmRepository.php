<?php

namespace App\Repositories;

use App\Models\Film;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class FilmRepository
{
    protected $model;

    public function __construct(Film $film)
    {
        $this->model = $film;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }


    public function search($name)
    {
        $film = $this->model->where("name", "=", $name)->get(['name','language', 'genres', 'runtime', 'summary'])->first();
        return $film;
    }
}
