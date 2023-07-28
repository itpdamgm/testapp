<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaguRequest extends FormRequest
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
            "nama" => ["required","string"],
            "sk_tahun" => ["required","numeric"],
            "pagu" => ["required","string"],
            "cost_type_id" => ["required","exists:cost_types,id"],
            "position_id" => ["required","exists:positions,id"],
            "type_id" => ["required","exists:types,id"],
            "ada_rincian" => ["nullable"],
            "cost_details" => ["nullable","string"],

        ];
    }
}
