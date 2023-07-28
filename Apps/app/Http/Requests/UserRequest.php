<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
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
            "pegawai" => ["required","string"],
            "username" => ["required","string",Rule::unique('users')->ignore($this->user->id??'')],
            "password" => ["required",'string',Password::min(4)],
            "role" => ["required",'string'],
            "selectedMenus" => ["required",'string'],
        ];
    }
}
