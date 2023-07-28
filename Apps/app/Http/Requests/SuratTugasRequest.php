<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuratTugasRequest extends FormRequest
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
            "nomor" => ["required","string"],
            "tanggal" => ["required","date_format:d-m-Y"],
            "keterangan" => ["required","string"],
            "pemberi_tugas" => ["required","string"],
            "tgl_berangkat" => ["required","date_format:d-m-Y"],
            "tgl_kembali" => ["required","date_format:d-m-Y"],
            "lama_hari" => ["required","numeric"],
            "tempat_berangkat" => ["required","string"],
            "tempat_tujuan" => ["required","string"],
        ];
    }
}
