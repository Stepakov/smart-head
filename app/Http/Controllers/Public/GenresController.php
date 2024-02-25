<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenresController extends Controller
{
    public function index()
    {
        $genres = Genre::all();

        return view( 'public.genres.index', compact( 'genres' ) );
    }

    public function show( Genre $genre )
    {
        return view( 'public.genres.show', compact( 'genre' ) );
    }
}
