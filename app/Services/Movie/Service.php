<?php

namespace App\Services\Movie;

use App\Http\Requests\Movie\StoreRequest;
use App\Http\Requests\Movie\UpdateRequest;
use App\Models\Movie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Service
{
    public function store( StoreRequest $request ) : void
    {
        $fields = $request->validated();

        DB::transaction( function() use ( $request, $fields ) {
            $imagePath = $this->storeImage( $request );

            $movie = Movie::create([
                'title' => $request->title,
                'image' => $imagePath,
            ]);

            $movie->genres()->attach( $fields[ 'genres' ] );
        });
    }

    public function update( UpdateRequest $request, Movie $movie ) : void
    {
        $fields = $request->validated();
        $movie->title = $fields[ 'title' ];

        DB::transaction( function() use ( $request, $movie, $fields ) {
            $movie = $this->updateImage( $request, $movie );

            $movie->save();

            $movie->genres()->sync( $fields[ 'genres' ] );
        });
    }

    protected function storeImage( StoreRequest $request ) : string
    {
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
        } else {
            $imagePath = 'uploads/default.png';
        }

        return $imagePath;
    }

    protected function updateImage( UpdateRequest $request, Movie $movie ) : Movie
    {
        if ($request->hasFile('image')) {
            if ($movie->image && $movie->image !== 'uploads/default.png' ) {
                Storage::disk('public')->delete($movie->image);
            }

            $imagePath = $request->file('image')->store('uploads', 'public');
            $movie->image = $imagePath;
        }

        return $movie;
    }
}
