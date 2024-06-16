<?php

namespace App\Http\Requests\Comment;

use App\Http\Requests\DefaultRequest;
use Illuminate\Foundation\Http\FormRequest;

class CommentUpdateRequest extends DefaultRequest
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
        $result = [
            'title' => 'required|string|min:2|max:250',
            'user_id' =>'required|integer|min:0',
            'post_id' =>'required|integer|min:0',
            'like_id' =>'required|integer|min:0',
        ];
        return $result;
    }
}
