@props([
    'status',
    'movie'
])
@if( $status->name === "DRAFT" )
    <x-form
        class="d-inline"
        method="POST"
        :action="route( 'movies.status', [ 'movie' => $movie->id, 'status' => \App\Enums\Movies\Status::PUBLISHED->name ] )"
    >
        <button class="btn btn-primary">Public</button>
    </x-form>
    <x-form
        class="d-inline"
        method="POST"
        :action="route( 'movies.status', [ 'movie' => $movie->id, 'status' => \App\Enums\Movies\Status::BANNED->name ] )"
    >
        <button class="btn btn-danger">Ban</button>
    </x-form>
    @elseif( $status->name === "PUBLISHED" )
    <x-form
        class="d-inline"
        method="POST"
        :action="route( 'movies.status', [ 'movie' => $movie->id, 'status' => \App\Enums\Movies\Status::DRAFT->name ] )"
    >
        <button class="btn btn-warning">Draft</button>
    </x-form>
    <x-form
        class="d-inline"
        method="POST"
        :action="route( 'movies.status', [ 'movie' => $movie->id, 'status' => \App\Enums\Movies\Status::BANNED->name ] )"
    >
        <button class="btn btn-danger">Ban</button>
    </x-form>
    @elseif( $status->name === "BANNED" )
    <x-form
        class="d-inline"
        method="POST"
        :action="route( 'movies.status', [ 'movie' => $movie->id, 'status' => \App\Enums\Movies\Status::DRAFT->name ] )"
    >
        <button class="btn btn-warning">Draft</button>
    </x-form>
    <x-form
        class="d-inline"
        method="POST"
        :action="route( 'movies.status', [ 'movie' => $movie->id, 'status' => \App\Enums\Movies\Status::PUBLISHED->name ] )"
    >
        <button class="btn btn-primary">Public</button>
    </x-form>
@endif

