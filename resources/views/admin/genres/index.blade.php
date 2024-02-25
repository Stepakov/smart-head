<x-layouts.main title="Genres" h1="The Genres">
    <a href="{{ route( 'genres.create' ) }}">Create Genre</a> |
    <a href="{{ route( 'genres.trashed' ) }}">Archive</a>

    @forelse ($genres as $genre)
        <div class="genre">
            <a href="{{ route( 'genres.show', $genre->id ) }}">
                <h2>{{ $genre->title }}</h2>
            </a>
        </div>
        <div>
            <a class="btn btn-primary my-3" href="{{ route( 'genres.edit', $genre->id ) }}">
                Edit
            </a>
        </div>
        <div>
            <x-form method="DELETE" :action="route( 'genres.destroy', $genre->id )">
                <button class="btn btn-danger">
                    Delete
                </button>
            </x-form>
        </div>

        <hr>
    @empty
        <p>No genres found.</p>
    @endforelse

</x-layouts.main>
