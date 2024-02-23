<?php

namespace App\Http\Requests\Movie;

use App\Models\Movie;
use Illuminate\Validation\Rule;

class UpdateRequest extends StoreRequest
{
    protected function titleUniqueRule()
    {
        return parent::titleUniqueRule()->ignore( $this->movie );
    }
}
