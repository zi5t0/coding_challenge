<?php

namespace App\Repositories;

interface FilmRepository
{
    public function create(array  $data);

    public function search($name);

}