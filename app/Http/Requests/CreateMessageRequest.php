<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMessageRequest extends FormRequest
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
            'title'         => 'required|unique:messages|max:255',
            'description'   => 'required',
            'gender'        => 'required',
            'minimum_age'   => ['numeric', 'min:13']
        ];
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return [
            'name.required' => 'Name is required.',
            'name.string' => 'Name must be a string.',
            'description.required' => 'Description is required.',
            'description.string' => 'Description must be a string.',
            'user_id.required' => 'User is required',
            'user_id.numeric' => 'User must be an integer.',
        ];
    }
}
