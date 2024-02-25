<x-layouts.public :title="'Movie: ' . $movie->title" :h1="$movie->title">
    <hr>
    <a href="{{ route( 'public.movies.index') }}">Back to Index</a>
    <hr>
    @if( preg_match("/^http/", $movie->image ) )
        <img src="{{ asset( $movie->image) }}" alt="{{ $movie->title }}" width="400" height="200">
    @else
        <img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }}" width="400" height="200">
    @endif
    <hr>
    Жанры:  {!!  $movie->genres->map(function($genre) {
                    return '<a href="' . route('public.genres.show', $genre->id) . '">' . $genre->title . '</a>';
                })->implode(', ')  !!}
</x-layouts.public>
