<x-layouts.main title="Edit Genre">

<hr>
<a href="{{ route( 'genres.index') }}">Back to Index</a>
<hr>
    <x-form action="{{ route( 'genres.update', $genre->id ) }}"
            enctype="multipart/form-data"
            method="PUT">
        @bind( $genre )
        @include( 'genres.form' )
        @endbind

        <button class="btn btn-success mt-3 mb-3">Edit Genre</button>
    </x-form>
</x-layouts.main>
