<?php

namespace App\Http\Requests\Movie;

use App\Models\Movie;
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

//    public function messages()
//    {
//        return [
//            'title.required' => 'Нужно заполнить поле с :title.',
//            'title.min' => 'Заголовок должен содержать не менее 3 символов.',
//        ];
//    }
//
    public function attributes()
    {
        return [
            'title' => 'Заголовок',
            'image' => 'Картинка'
        ];
    }

    protected function titleUniqueRule()
    {
        return Rule::unique( Movie::class, 'title' )->whereNull( 'deleted_at' );
    }


}
