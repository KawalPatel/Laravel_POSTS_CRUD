<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostsValidationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'body' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'title.*' => 'title cannot be blank.',
            'body.*' => 'body cannot be blank.',
        ];
    }
}
