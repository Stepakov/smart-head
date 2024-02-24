<x-layouts.main title="Movies" h1="The Movies">
    <a href="{{ route( 'movies.create' ) }}">Create Movie</a> |
    <a href="{{ route( 'movies.trashed' ) }}">Archive</a>


    @forelse ($movies as $movie)
        <div class="movie">
            <a href="{{ route( 'movies.show', $movie->id ) }}">
                <h2>{{ $movie->title }}</h2>
            </a>
            <img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }}" width="400" height="200">
        </div>
        <div>
            <a class="btn btn-primary my-3" href="{{ route( 'movies.edit', $movie->id ) }}">
                Edit
            </a>
        </div>
        <div>
{{--            <form action="{{ route( 'movies.destroy', $movie->id ) }}" method="POST">--}}
{{--                @csrf--}}
{{--                @method("DELETE")--}}

{{--                <button>--}}
{{--                    DELETE--}}
{{--                </button>--}}
{{--            </form>--}}
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
