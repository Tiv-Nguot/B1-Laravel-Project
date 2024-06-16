<?php

namespace App\Http\Requests\Friend;

use App\Http\Requests\DefaultRequest;
use Illuminate\Foundation\Http\FormRequest;

class AcceptFriendRequest extends DefaultRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'requester_id' => 'required|integer|exists:friend_requests,requester_id|exists:users,id',
            'status_id' => 'required|integer|in:2,3'
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
            'requester_id.exists' => 'The friend request does not exist or the table.',
            'status_id.in' => 'The status must be either 2 (accepted) or 3 (canceled).'
        ];
    }
}
