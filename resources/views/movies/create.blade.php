<x-layouts.main title="Create Movie">
    <a href="{{ route( 'movies.index') }}">Back to Index</a>
    <hr>
    <x-form action="{{ route( 'movies.store' ) }}"
            enctype="multipart/form-data"
            method="POST">


        @include( 'movies.form' )

        <x-input type="file" label="Image" name="image" />

        <x-form-select label="Жанры"
                       name="genres"
                       :options="[ 'Комедии', 'Детективы', 'Ужастики' ]"
                       placeholder="Выберите жанр"
                       multiple />

        <button class="btn btn-success mt-3 mb-3">Create Movie</button>
    </x-form>
{{--    <form action="{{ route( 'movies.store' ) }}" method="POST" enctype="multipart/form-data">--}}
{{--        @csrf--}}

{{--        <x-input label="Movie Title" name="title" />--}}
{{--        <x-input type="file" label="Image" name="image" />--}}

{{--        <button>--}}
{{--            Create Movie--}}
{{--        </button>--}}
{{--    </form>--}}
</x-layouts.main>
