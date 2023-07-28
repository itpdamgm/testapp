<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sppd extends Model
{
    use HasFactory;

    protected $table = 'sppd';
    protected $dates = ['tgl_berangkat','tgl_kembali'];
    protected $guarded = [];


    public function surat_tugas()
    {
        return $this->belongsTo(SuratTugas::class,'surat_tugas_id');
    }

    public function sppd_details()
    {
        return $this->hasMany(SppdDetail::class,'sppd_id');
    }

    public function pengikut()
    {
        return $this->hasMany(Pengikut::class,'sppd_id');
    }

    public function scopeThisYear($query)
    {
        return $query->whereYear('created_at',now()->year);
    }

}
