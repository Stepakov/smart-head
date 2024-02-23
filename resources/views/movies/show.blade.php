<h1>{{ $movie->title }}</h1>
<hr>
<a href="{{ route( 'movies.index') }}">Back to Index</a>
<hr>
<img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }}" width="700" height="500">
