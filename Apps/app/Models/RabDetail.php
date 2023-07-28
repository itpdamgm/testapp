<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RabDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function rab()
    {
        return $this->belongsTo(Rab::class,'rab_id');
    }

    public function cost()
    {
        return $this->belongsTo(Cost::class,'cost_id');
    }


    public function sppd()
    {
        return $this->belongsTo(Rab::class,'rab_id');
    }
}
