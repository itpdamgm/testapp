<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SppdDetail extends Model
{
    use HasFactory;
    protected $table = 'sppd_details';
    protected $dates = ['tgl_tiba','tgl_berangkat'];
    protected $guarded = [];

    public function sppd()
    {
        return $this->belongsTo(Sppd::class,'sppd_id');
    }


}
