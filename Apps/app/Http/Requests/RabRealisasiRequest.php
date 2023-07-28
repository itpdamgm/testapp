<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RabRealisasiRequest extends FormRequest
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
            "rab_id" => ["required","exists:rabs,id"],
            "maskapai" => ["nullable","string"],
            "no_boarding_pass" => ["nullable","string"],
            "boarding_pass" => ["nullable","string"],
            "no_tiket" => ["nullable","string"],
            "tiket" => ["nullable","string"],
            "nama_hotel" => ["required","string"],
            "invoice" => ["nullable","string"],
            "swab" => ["nullable","string"],
            "sewa_kendaraan" => ["nullable","string"],
            "bahan_bakar" => ["nullable","string"],
            "signature1" => ["nullable","string"],
            "signature2" => ["nullable","string"],
            "details" => ['array','required'],
            "bukti" => ['array','nullable'],
            "diakui" => ['array','required'],
            "ket_diakui" => ['array','required']
        ];
    }
}
