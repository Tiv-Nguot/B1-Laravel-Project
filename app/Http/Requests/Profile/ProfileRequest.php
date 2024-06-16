<?php

namespace App\Http\Requests\Profile;

use App\Http\Requests\DefaultRequest;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends DefaultRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image_profile' => 'required|image|mimes:jpeg,png,jpg,gif',
        ];
    }
}
