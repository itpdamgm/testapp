<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RabRequest extends FormRequest
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
            "surat_tugas_detail_id" => ["required","exists:surat_tugas_details,id"],
            "nomor" => ["required","string",'unique:rabs,id,'.($this->rab->id??'')],
            "position_id" => ["required","exists:positions,id"],
            "type_id" => ["required","exists:types,id"],
            "rab_details" => ["nullable","string"],
            "disetujui" => ["required","string"],
            "diperiksa" => ["required","string"],
            "pembuat" => ["required","string"],
            "menyerahkan" => ["required","string"],
        ];
    }
}
