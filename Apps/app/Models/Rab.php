<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Rab extends Model
{
    use HasFactory, HasRelationships;

    protected $guarded = [];


    public function rab_details()
    {
        return $this->hasMany(RabDetail::class,'rab_id');
    }

    public function type()
    {
        return $this->belongsTo(Type::class,'type_id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class,'position_id');
    }

    public function surat_tugas_detail()
    {
        return $this->belongsTo(SuratTugasDetail::class,'surat_tugas_detail_id');
    }


    public function realisasi()
    {
        return $this->hasOne(RabRealisasi::class,'rab_id');
    }

    public function scopeThisYear($query)
    {
        return $query->whereYear('created_at',now()->year);
    }
}
