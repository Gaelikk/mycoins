<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nickname' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required|max:255',
            'name' => 'max:255',
            'surname' => 'max:255',
            'avatar' => '',
            'country' => 'required',
        ];
    }
}
