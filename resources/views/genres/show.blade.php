<x-layouts.main :title="'Genre: ' . $genre->title" :h1="$genre->title">
<hr>
<a href="{{ route( 'genres.index') }}">Back to Index</a>
    <hr>
    {!!  $genre->movies->map(function($movie) {
                    return '<a href="' . route('movies.show', $movie->id) . '">' . $movie->title . '</a>';
                })->implode(', ')  !!}
</x-layouts.main>
