<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\DefaultRequest;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends DefaultRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rule =[
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|unique:users|max:255',
            'password'  => 'required|string|min:6'
        ];
        return $rule;
    }
}
