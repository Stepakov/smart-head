<x-layouts.public title="Movies" h1="The Movies">

    @forelse ($movies as $movie)
        <div class="movie">
            <a href="{{ route( 'public.movies.show', $movie->id ) }}">
                <h2>{{ $movie->title }}</h2>
            </a>
            @if( preg_match("/^http/", $movie->image ) )
                <img src="{{ asset( $movie->image) }}" alt="{{ $movie->title }}" width="400" height="200">
            @else
                <img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }}" width="400" height="200">
            @endif
            <div>
                Жанры:
{{--                {{ $movie->genres->implode( 'title', ', ') }}--}}
                {!!  $movie->genres->map(function($genre) {
                    return '<a href="' . route('genres.show', $genre->id) . '">' . $genre->title . '</a>';
                })->implode(', ')  !!}
            </div>

        </div>

        <hr>
    @empty
        <p>No movies found.</p>
    @endforelse

</x-layouts.public>
