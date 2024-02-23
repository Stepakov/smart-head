@props([
    'type' => 'text',
    'label',
    'name',
    'defaultValue' => ''
    ])

<div>
    {{ $label }} :
    <input type="{{ $type }}" name="{{ $name }}" value="{{ old( $name, $defaultValue ) }}" > <br>
    @error( $name )
        <div style="color:red">
            {{ $message }}
        </div>
    @enderror
</div>
