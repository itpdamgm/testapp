<?php

namespace App\Http\Livewire;

use App\Models\Rab;
use App\Models\RabDetail;
use Livewire\Component;

class RealisasiRab extends Component
{
    public $rab_id = null;
    public $rab;

    public function mount()
    {
        if(!is_null($this->rab_id))
            $this->rab = Rab::with(['rab_details.cost.cost_type','surat_tugas_detail'])->where('id',$this->rab_id)->first();
    }

    public function render()
    {
        $this->emit('reinit',$this->rab);
        return view('livewire.realisasi-rab');
    }

    public function updatedRabId($value)
    {
        $this->rab = Rab::with(['rab_details.cost.cost_type','surat_tugas_detail'])->where('id',$value)->first();

    }
}
