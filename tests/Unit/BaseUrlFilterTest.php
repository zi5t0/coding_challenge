<?php

namespace Tests\Unit;

use App\Filters\FilmFilter;
use PHPUnit\Framework\TestCase;

class BaseUrlFilterTest extends TestCase
{
    public function test_base_url_filter_matches()
    {
        $film_filter = new FilmFilter();
        $filter_response = $film_filter->filter('?q=4h5uoog3o');

        $this->assertTrue($filter_response);
    }

    public function test_base_url_filter_doesnt_matches()
    {
        $film_filter = new FilmFilter();
        $filter_response = $film_filter->filter('trq=\'5&·\'e.fhpr');

        $this->assertFalse($filter_response);
    }
}
