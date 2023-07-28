<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratTugasDetail extends Model
{
    use HasFactory;

    protected $table = 'surat_tugas_details';
    protected $guarded = [];

    public function surat_tugas()
    {
        return $this->belongsTo(SuratTugas::class,'surat_tugas_id');
    }

    public function rab()
    {
        return $this->hasOne(Rab::class,'surat_tugas_detail_id');
    }
}
