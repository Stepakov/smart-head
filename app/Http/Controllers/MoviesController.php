<?php

namespace App\Http\Controllers;

use App\Http\Requests\Movie\StoreRequest;
use App\Http\Requests\Movie\UpdateRequest;
use App\Models\Movie;
use Illuminate\Support\Facades\Storage;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        dd( trans( 'notifications.movies.created' ) );
        $movies = Movie::all();

        return view( 'movies.index', compact( 'movies' ) );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view( 'movies.create' );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
//        $fields = $request->validated();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
        } else {
            $imagePath = 'uploads/default.png';
        }

        Movie::create([
            'title' => $request->title,
            'image' => $imagePath,
        ]);

        return redirect()
            ->route('movies.index')
            ->with( 'notification', trans( 'notifications.movies.created' ) );
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        return view( 'movies.show', compact( 'movie' ) );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        return view( 'movies.edit', compact( 'movie' ) );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Movie $movie)
    {
        $fields = $request->validated();
        $movie->title = $fields[ 'title' ];

        if ($request->hasFile('image')) {
            if ($movie->image && $movie->image !== 'uploads/default.png' ) {
                Storage::disk('public')->delete($movie->image);
            }

            $imagePath = $request->file('image')->store('uploads', 'public');
            $movie->image = $imagePath;
        }

        $movie->save();

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
        return view( 'movies.trashed', compact( 'movies') );
    }

    public function restore( Movie $movie)
    {
        if( Movie::where( 'title', $movie->title )->exists() )
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
}
