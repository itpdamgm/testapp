<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostType extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function costs()
    {
        return $this->hasMany(Cost::class,'cost_type_id');
    }
}
