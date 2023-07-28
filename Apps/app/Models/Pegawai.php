<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $connection = 'personalia';
    protected $table = 'vw_pegawai';
    public $timestamps = false;

    public function scopeAktif($query)
    {
        return $query->where('kd_status','<>','07');
    }

}
