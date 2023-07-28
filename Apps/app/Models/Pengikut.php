<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengikut extends Model
{
    use HasFactory;

    protected $table = 'pengikut';
    protected $guarded = [];

    public function sppd()
    {
        return $this->belongsTo(Sppd::class,'sppd_id');
    }
}
