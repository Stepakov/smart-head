<x-layouts.main title="Create Genre">
    <a href="{{ route( 'genres.index') }}">Back to Index</a>
    <hr>
    <x-form action="{{ route( 'genres.store' ) }}"
            enctype="multipart/form-data"
            method="POST">

        @include( 'admin.genres.form' )

        <button class="btn btn-success mt-3 mb-3">Create Genre</button>
    </x-form>
</x-layouts.main>
