<x-layouts.main :title="'Movie: ' . $movie->title" :h1="$movie->title">
    <hr>
    <a href="{{ route( 'movies.index') }}">Back to Index</a>
    <hr>
    @if( preg_match("/^http/", $movie->image ) )
        <img src="{{ asset( $movie->image) }}" alt="{{ $movie->title }}" width="400" height="200">
    @else
        <img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }}" width="400" height="200">
    @endif
    <hr>
    {{ $movie->genres()->implode( 'title', ', ') }}
</x-layouts.main>
