<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class SuratTugas extends Model
{
    use HasFactory;

    protected $table = 'surat_tugas';
    protected $dates = ['tanggal','tgl_berangkat','tgl_kembali'];
    protected $guarded = [];

    public function surat_tugas_details()
    {
        return $this->hasMany(SuratTugasDetail::class,'surat_tugas_id')->orderByRaw('position_id, id');
    }

    public function sppd()
    {
        return $this->hasOne(Sppd::class,'surat_tugas_id');
    }


    public function rab()
    {
        return $this->hasManyThrough(Rab::class,SuratTugasDetail::class,'surat_tugas_id','surat_tugas_detail_id');
    }

    public function setTanggalAttribute($value)
    {
        $this->attributes['tanggal'] = Carbon::createFromFormat('d-m-Y',$value)->format('Y-m-d');
    }

    public function setTglBerangkatAttribute($value)
    {
        $this->attributes['tgl_berangkat'] = Carbon::createFromFormat('d-m-Y',$value)->format('Y-m-d');
    }

    public function setTglKembaliAttribute($value)
    {
        $this->attributes['tgl_kembali'] = Carbon::createFromFormat('d-m-Y',$value)->format('Y-m-d');
    }
}
