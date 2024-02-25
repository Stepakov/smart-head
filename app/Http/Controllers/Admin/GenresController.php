<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Genre\StoreRequest;
use App\Http\Requests\Genre\UpdateRequest;
use App\Models\Genre;

class GenresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        dd( trans( 'notifications.genres.created' ) );
        $genres = Genre::orderBy( 'title' )->get();

        return view( 'admin.genres.index', compact( 'genres' ) );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view( 'admin.genres.create' );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $fields = $request->validated();
        Genre::create( $fields );

        return redirect()
            ->route('genres.index')
            ->with( 'notification', trans( 'notifications.genres.created' ) );
    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre)
    {
        return view( 'admin.genres.show', compact( 'genre' ) );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genre $genre)
    {
        return view( 'admin.genres.edit', compact( 'genre' ) );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Genre $genre)
    {
        $genre->update( $request->validated() );

        return redirect()
            ->route('genres.index')
            ->with( 'notification', trans( 'notifications.genres.edited' ) );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();

        return redirect()
            ->route('genres.index')
            ->with( 'notification', trans( 'notifications.genres.deleted' ) );
    }

    public function trashed()
    {
        $genres = Genre::onlyTrashed()->orderByDesc( 'created_at' )->get();
        return view( 'admin.genres.trashed', compact( 'genres') );
    }

    public function restore( Genre $genre)
    {
        if( Genre::where( 'title', $genre->title )->exists() )
        {
            return redirect()
                ->back()
                ->with( 'notification', trans( 'notifications.genres.restore-fail-with-same-title', [ 'title' => $genre->title ] ) );
        }

        $genre->restore();

        return redirect()
            ->route('genres.index')
            ->with( 'notification', trans( 'notifications.genres.restored' ) );
    }

    public function forcedelete( Genre $genre)
    {
        $genre->forceDelete();

        return redirect()
            ->route('genres.index')
            ->with( 'notification', trans( 'notifications.genres.forcedelete' ) );
    }
}
