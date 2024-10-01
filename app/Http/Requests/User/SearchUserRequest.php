<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SearchUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'field' => ['required', Rule::in(User::getSearchableFields())],
            'value' => ['required']
        ];
    }
}
