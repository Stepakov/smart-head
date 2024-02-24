<x-layouts.main title="Edit Movie">

<hr>
<a href="{{ route( 'movies.index') }}">Back to Index</a>
<hr>
    <x-form action="{{ route( 'movies.update', $movie->id ) }}"
            enctype="multipart/form-data"
            method="PUT">
        @bind( $movie )
        @include( 'movies.form' )
        @endbind
        <x-input type="file" label="Image" name="image" />
        <img src="{{ asset('storage/' . $movie->image) }}"
             alt="{{ $movie->title }}"
             width="400"
             height="200">
        <br>

        <x-form-select label="Жанры"
                       name="genres[]"
                       :options="$genres"
                       placeholder="Выберите жанр"
                       multiple />

        <button class="btn btn-success mt-3 mb-3">Edit Movie</button>
    </x-form>
</x-layouts.main>
