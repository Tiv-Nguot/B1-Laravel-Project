<?php

namespace App\Http\Requests\Friend;

use App\Http\Requests\DefaultRequest;
use Illuminate\Foundation\Http\FormRequest;

class RemoveFriendRequest extends DefaultRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'friend_id' => 'required|integer|exists:users,id'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'friend_id.exists' => 'The selected friend does not exist in our records.'
        ];
    }
}
