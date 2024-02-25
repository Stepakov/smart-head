<x-layouts.main title="Trashed Genres" h1="Trashed Genres">
    <a href="{{ route( 'genres.index') }}">Back to Index</a>

    @forelse ($genres as $genre)
        <div class="genre">
            <a href="{{ route( 'genres.show', $genre->id ) }}">
                <h2>{{ $genre->title }}</h2>
            </a>
        </div>
        <div>
            <x-form method="PUT" action="{{ route( 'genres.restore', $genre->id ) }}">
                <button class="btn btn-success">
                    Restore
                </button>
            </x-form>
        </div>
        <div>
            <x-form method="DELETE" action="{{ route( 'genres.forcedelete', $genre->id ) }}">
                <button class="btn btn-danger">
                    Force Delete
                </button>
            </x-form>
        </div>
        <hr>
    @empty
        <p>No genres found.</p>
    @endforelse

</x-layouts.main>
