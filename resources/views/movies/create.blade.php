<h1>Create Movie</h1>
<hr>
<a href="{{ route( 'movies.index') }}">Back to Index</a>
<hr>
<form action="{{ route( 'movies.store' ) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="text" name="title" value="{{ old('title') }}"> <br>
    @if ($errors->has('title'))
        <div>
            {{ $errors->first('title') }}
        </div>
    @endif
    <input type="file" name="image" > <br>

    <button>
        Create
    </button>
</form>
