<x-layouts.public :title="'Genre: ' . $genre->title" h1="Жанр: {{ $genre->title }}">
<hr>
<a href="{{ route( 'genres.index') }}">Back to Index</a>
    <hr>
    Фильмы этого жанра: {!! $genre->movies->filter(function($movie) {
        return $movie->status === \App\Enums\Movies\Status::PUBLISHED;
    })->map(function($movie) {
        return '<a href="' . route('public.movies.show', $movie->id) . '">' . $movie->title . '</a>';
    })->implode(', ') !!}
</x-layouts.public>
