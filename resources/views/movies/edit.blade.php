<x-layouts.main title="Edit Movie">

<hr>
<a href="{{ route( 'movies.index') }}">Back to Index</a>
<hr>
<form action="{{ route( 'movies.update', $movie->id ) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method( 'PUT' )

    <x-input label="Movie Title" name="title" :defaultValue="$movie->title" />
    <x-input type="file" label="Image" name="image" />

{{--    <input type="text" name="title" value="{{ old('title', $movie->title) }}"> <br>--}}
{{--    @if ($errors->has('title'))--}}
{{--        <div>--}}
{{--            {{ $errors->first('title') }}--}}
{{--        </div>--}}
{{--    @endif--}}
{{--    <input type="file" name="image" > <br>--}}
    <img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }}" width="400" height="200">
    <br>
    <button>
        Update
    </button>
</form>
</x-layouts.main>
