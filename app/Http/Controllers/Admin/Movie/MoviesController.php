<?php

namespace App\Http\Controllers\Admin\Movie;

use App\Enums\Movies\Status;
use App\Http\Requests\Movie\StoreRequest;
use App\Http\Requests\Movie\UpdateRequest;
use App\Models\Genre;
use App\Models\Movie;

class MoviesController extends MovieBaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $movies = Movie
            ::with( 'genres' )
            ->orderByDesc( 'created_at' )
            ->get();

        return view( 'admin.movies.index', compact( 'movies' ) );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::allGenres();
        return view( 'admin.movies.create', compact( 'genres' ) );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $this->service->store( $request );

        return redirect()
            ->route('movies.index')
            ->with( 'notification', trans( 'notifications.movies.created' ) );
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        return view( 'admin.movies.show', compact( 'movie' ) );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        $genres = Genre::allGenres();
        return view( 'admin.movies.edit', compact( 'movie', 'genres' ) );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Movie $movie)
    {
        $this->service->update( $request, $movie );

        return redirect()
            ->route('movies.index')
            ->with( 'notification', trans( 'notifications.movies.edited' ) );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();

        return redirect()
            ->route('movies.index')
            ->with( 'notification', trans( 'notifications.movies.deleted' ) );
    }

    public function trashed()
    {
        $movies = Movie::onlyTrashed()->orderByDesc( 'created_at' )->get();
        return view( 'admin.movies.trashed', compact( 'movies') );
    }

    public function restore( Movie $movie)
    {
        if( $movie->isSameTitle )
        {
            return redirect()
                ->back()
                ->with( 'notification', trans( 'notifications.movies.restore-fail-with-same-title', [ 'title' => $movie->title ] ) );
        }

        $movie->restore();

        return redirect()
            ->route('movies.index')
            ->with( 'notification', trans( 'notifications.movies.restored' ) );
    }

    public function forcedelete( Movie $movie)
    {
        $movie->forceDelete();

        return redirect()
            ->route('movies.index')
            ->with( 'notification', trans( 'notifications.movies.forcedelete' ) );
    }

    public function status( Movie $movie, string $status )
    {
        $movie->status = Status::valueOf($status);
        $movie->save();

        return redirect()->back();
    }
}
