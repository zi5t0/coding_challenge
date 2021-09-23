<?php

namespace App\Filters;

class FilmFilter
{
    public function filter($url)
    {
        return preg_match('/\?q\=.*/', $url) ? true : false;
    }
}