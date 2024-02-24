<x-layouts.main title="Trashed Movies" h1="Trashed Movies">
    <a href="{{ route( 'movies.index') }}">Back to Index</a>

    @forelse ($movies as $movie)
        <div class="movie">
            <a href="{{ route( 'movies.show', $movie->id ) }}">
                <h2>{{ $movie->title }}</h2>
            </a>
            <img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }}" width="400" height="200">
        </div>
        <div>
            <x-form method="PUT" action="{{ route( 'movies.restore', $movie->id ) }}">
                <button class="btn btn-success">
                    Restore
                </button>
            </x-form>
        </div>
        <div>
            <x-form method="DELETE" action="{{ route( 'movies.forcedelete', $movie->id ) }}">
                <button class="btn btn-danger">
                    Force Delete
                </button>
            </x-form>
        </div>
        <hr>
    @empty
        <p>No movies found.</p>
    @endforelse

</x-layouts.main>
