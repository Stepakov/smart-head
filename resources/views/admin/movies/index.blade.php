<x-layouts.main title="Movies" h1="The Movies">
    <a href="{{ route( 'movies.create' ) }}">Create Movie</a> |
    <a href="{{ route( 'movies.trashed' ) }}">Archive</a>


    @forelse ($movies as $movie)
        <div class="movie">
            <a href="{{ route( 'movies.show', $movie->id ) }}">
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
            <div>
                Status: {{ $movie->status->text() }}
                <x-status-buttons :movie="$movie" :status="$movie->status"/>

            </div>
        </div>
        <div>
            <a class="btn btn-primary my-3" href="{{ route( 'movies.edit', $movie->id ) }}">
                Edit
            </a>
        </div>
        <div>
            <x-form method="DELETE" :action="route( 'movies.destroy', $movie->id )">
                <button class="btn btn-danger">
                    Delete
                </button>
            </x-form>
        </div>
        <hr>
    @empty
        <p>No movies found.</p>
    @endforelse

</x-layouts.main>
