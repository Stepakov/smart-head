<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\GenresResource;
use App\Http\Resources\MoviesResource;
use App\Models\Genre;

class GenresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = Genre::all();

        return GenresResource::collection( $genres )->resolve();
    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre)
    {
        $page = 1;
        $perPage = 3;

        $movies = $genre
            ->movies()
            ->paginate( $perPage, [ '*' ], 'page', $page );

        return MoviesResource::collection( $movies )->resolve();
    }

}
