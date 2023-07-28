<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SppdRequest extends FormRequest
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
            "surat_tugas_id" => ["required","exists:surat_tugas,id"],
            "nomor" => ["required","string","unique:sppd,nomor,".($this->sppd->id??'')],
            "tgl_berangkat" => ["required","date_format:d-m-Y"],
            "tgl_kembali" => ["required","date_format:d-m-Y"],
            "lama_hari" => ["required","numeric"],
            "maksud" => ["required","string"],
            "tempat_berangkat" => ["required","string"],
            "tempat_tujuan" => ["required","string"],
            "beban_instansi" => ["required","string"],
            "beban_kode_akun" => ["required","string"],
            "alat_angkutan" => ["required","string"],
            "keterangan_lain" => ["required","string"],
            "catatan" => ["nullable","string"],
            "perhatian" => ["nullable","string"],
            "ada_pengikut" => ["nullable"],
            "pengikut" => ["required_if:ada_pengikut,ok"],
            "rute" => ["required","string"],
            "pemberi_tugas" => ["required","string"],

        ];
    }
}
