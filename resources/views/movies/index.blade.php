<h1>Movies</h1>
<hr>
<a href="{{ route( 'movies.create' ) }}">Create Movie</a>


@forelse ($movies as $movie)
    <div class="movie">
        <a href="{{ route( 'movies.show', $movie->id ) }}">
            <h2>{{ $movie->title }}</h2>
        </a>
            <img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }}" width="400" height="200">
    </div>
    <div>
        <a href="{{ route( 'movies.edit', $movie->id ) }}">
            Edit
        </a>
    </div>
    <div>
        <form action="{{ route( 'movies.destroy', $movie->id ) }}" method="POST">
            @csrf
            @method("DELETE")

            <button>
                DELETE
            </button>
        </form>
    </div>
    <hr>
@empty
    <p>No movies found.</p>
@endforelse
