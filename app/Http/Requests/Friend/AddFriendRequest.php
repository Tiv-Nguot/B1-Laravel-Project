<?php

namespace App\Http\Requests\Friend;

use App\Http\Requests\DefaultRequest;
use Illuminate\Foundation\Http\FormRequest;

class AddFriendRequest extends DefaultRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules= [
             'receiver_id' => 'required|exists:users,id'
        ];
        return $rules;
    }
        /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'receiver_id.exists' => 'The selected user does not exist in our records.'
        ];
    }

}
