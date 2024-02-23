<x-layouts.main title="Create Movie">
    <a href="{{ route( 'movies.index') }}">Back to Index</a>
    <hr>
    <form action="{{ route( 'movies.store' ) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <x-input label="Movie Title" name="title" />
        <x-input type="file" label="Image" name="image" />

        <button>
            Create Movie
        </button>
    </form>
</x-layouts.main>
