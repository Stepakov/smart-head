<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\MoviesResource;
use App\Models\Movie;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = 1;
        $perPage = 3;

        $movies = Movie::
            with( 'genres' )
            ->active()
            ->orderByDesc( 'created_at' )
            ->paginate( $perPage, [ '*' ], 'page', $page );

        return MoviesResource::collection( $movies )->resolve();
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        return MoviesResource::make( $movie )->resolve();
    }

}
