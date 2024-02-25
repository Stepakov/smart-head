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
        $movies = $genre->movies()->get();

        return MoviesResource::collection( $movies )->resolve();
    }

}
