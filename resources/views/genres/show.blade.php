<x-layouts.main :title="'Genre: ' . $genre->title" :h1="$genre->title">
<hr>
<a href="{{ route( 'genres.index') }}">Back to Index</a>

</x-layouts.main>
