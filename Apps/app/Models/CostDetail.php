<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function cost()
    {
        return $this->belongsTo(Cost::class,'cost_id');
    }
}
