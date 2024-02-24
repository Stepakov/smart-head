<?php

namespace App\Http\Controllers;

use App\Enums\Movies\Status;
use App\Http\Requests\Movie\StoreRequest;
use App\Http\Requests\Movie\UpdateRequest;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $movies = Movie::with( 'genres' )
//            ->where( 'status', Status::PUBLISHED )
            ->orderByDesc( 'created_at' )
            ->get();

        return view( 'movies.index', compact( 'movies' ) );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::orderBy( 'title' )->get()->pluck( 'title', 'id' );
        return view( 'movies.create', compact( 'genres' ) );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $fields = $request->validated();

        DB::transaction( function() use ( $request, $fields ) {
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('uploads', 'public');
            } else {
                $imagePath = 'uploads/default.png';
            }

            $movie = Movie::create([
                'title' => $request->title,
                'image' => $imagePath,
            ]);

            $movie->genres()->attach( $fields[ 'genres' ] );
        });

        return redirect()
            ->route('movies.index')
            ->with( 'notification', trans( 'notifications.movies.created' ) );
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
//        dd( $movie->isSameTitle );
        return view( 'movies.show', compact( 'movie' ) );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        $genres = Genre::orderBy( 'title' )->get()->pluck( 'title', 'id' );
        return view( 'movies.edit', compact( 'movie', 'genres' ) );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Movie $movie)
    {
        $fields = $request->validated();
        $movie->title = $fields[ 'title' ];

        DB::transaction( function() use ( $request, $movie, $fields ) {
            if ($request->hasFile('image')) {
                if ($movie->image && $movie->image !== 'uploads/default.png' ) {
                    Storage::disk('public')->delete($movie->image);
                }

                $imagePath = $request->file('image')->store('uploads', 'public');
                $movie->image = $imagePath;
            }

            $movie->save();

            $movie->genres()->sync( $fields[ 'genres' ] );
        });

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
}
