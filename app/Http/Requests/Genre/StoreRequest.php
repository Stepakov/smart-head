<?php

namespace App\Http\Requests\Genre;

use App\Models\Genre;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => [ 'required', 'string', 'max:255', 'min:3', $this->titleUniqueRule() ],
        ];
    }
    public function attributes()
    {
        return [
            'title' => 'Заголовок',
        ];
    }

    protected function titleUniqueRule()
    {
        return Rule::unique( Genre::class, 'title' )->whereNull( 'deleted_at' );
    }


}
