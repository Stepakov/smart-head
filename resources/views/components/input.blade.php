@props([
    'type' => 'text',
    'label',
    'name',
    'defaultValue' => ''
    ])

<div class="mb-3 mt-3">

    <inpu type="file">

    <label for="formFile" class="form-label">{{ $label }} :</label>
    <input class="form-control"
           id="formFile"
           type="{{ $type }}"
           name="{{ $name }}"
           value="{{ old( $name, $defaultValue ) }}" >
    <br>
    @error( $name )
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror
</div>
