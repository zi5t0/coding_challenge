<?php

namespace App\Repositories;

use App\Models\Film;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EloquentFilmRepository implements FilmRepository
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
        if (null == $film = $this->model->where("name", "=", $name)) {
            throw new ModelNotFoundException("Film not found");
        }

        return $film;
    }
}