<?php


namespace App\Services;


use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SuratTugasServices
{
    public static function makeDetailsData($details)
    {
        if(!isset($details))
            throw new NotFoundHttpException('Data pegawai tidak ditemukan');

        $pegawai = json_decode($details);
        $data = collect([]);
        foreach ($pegawai as $peg){
            $data->push([
                "nip" => $peg->nip,
                "nama" => $peg->nama,
                "jabatan" => $peg->jabatan,
                "golongan" => $peg->golongan,
                "is_internal" => $peg->is_internal,
                "position_id" => $peg->position_id
            ]);
        }
        return  $data->toArray();
    }
}
