<?php

namespace App\Http\Requests\Genre;

use App\Models\Movie;
use Illuminate\Validation\Rule;

class UpdateRequest extends StoreRequest
{
    protected function titleUniqueRule()
    {
        return parent::titleUniqueRule()->ignore( $this->genre->id );
    }
}
