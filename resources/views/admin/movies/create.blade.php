<x-layouts.main title="Create Movie">
    <a href="{{ route( 'movies.index') }}">Back to Index</a>
    <hr>
    <x-form action="{{ route( 'movies.store' ) }}"
            enctype="multipart/form-data"
            method="POST">


        @include( 'admin.movies.form' )

        <x-input type="file" label="Image" name="image" />

        <x-form-select label="Жанры"
                       name="genres[]"
                       :options="$genres"
                       placeholder="Выберите жанр"
                       multiple />

        @error( 'genres.*' )
        <div class="text text-danger">
            {{ $message }}
        </div>
        @enderror

        <button class="btn btn-success mt-3 mb-3">Create Movie</button>
    </x-form>
</x-layouts.main>
