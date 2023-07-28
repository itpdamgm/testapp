<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RabRealisasi extends Model
{
    use HasFactory;
    protected $table = 'rab_realisasi';
    protected $guarded = [];


    public function rab()
    {
        return $this->belongsTo(Rab::class,'rab_id');
    }

    public function rab_details()
    {
        return $this->hasMany(RabDetail::class,'rab_id','rab_id');
    }

}
