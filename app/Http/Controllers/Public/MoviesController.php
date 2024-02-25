<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function index()
    {
        $movies = Movie::active()->orderByDesc( 'created_at' )->get();
        return view( 'public.movies.index', compact( 'movies' ) );
    }

    public function show( Movie $movie )
    {
        return view( 'public.movies.show', compact( 'movie' ) );
    }
}
