<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    use HasFactory;
    protected $casts = ['is_active' => 'boolean'];

    protected $guarded = [];

    public function position()
    {
        return $this->belongsTo(Position::class,'position_id');
    }

    public function type()
    {
        return $this->belongsTo(Type::class,'type_id');
    }

    public function cost_type()
    {
        return $this->belongsTo(CostType::class,'cost_type_id');
    }

    public function details()
    {
        return $this->hasMany(CostDetail::class,'cost_id');
    }

    public function setPaguAttribute($value)
    {
        return $this->attributes['pagu'] = str_replace(",","",$value);
    }
}
