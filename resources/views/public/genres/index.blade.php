<x-layouts.public title="Genres" h1="The Genres">

    @forelse ($genres as $genre)
        <div class="genre">
            <a href="{{ route( 'public.genres.show', $genre->id ) }}">
                <h2>{{ $genre->title }}</h2>
            </a>
        </div>

        <hr>
    @empty
        <p>No genres found.</p>
    @endforelse

</x-layouts.public>
