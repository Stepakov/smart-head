<x-layouts.main :title="'Movie: ' . $movie->title" :h1="$movie->title">
<hr>
<a href="{{ route( 'movies.index') }}">Back to Index</a>
<hr>
<img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }}" width="700" height="500">
</x-layouts.main>
