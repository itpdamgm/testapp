<?php

namespace App\Http\Livewire;

use Illuminate\Support\Carbon;
use Livewire\Component;

class RuteSppd extends Component
{
    public $arrRute = [];
    public $tiba_di = '';
    public $tgl_tiba = '' ;
    public $berangkat_dari = '' ;
    public $tujuan = "";
    public $tgl_berangkat = "";

    public $rute = "";

    public $rules = [
        "tiba_di" => ['required'],
        "tgl_tiba" => ['required'],
        "berangkat_dari" => ['required'],
        "tujuan" => ['required'],
        "tgl_berangkat" => ['required'],
    ];

    public function mount()
    {
        $details = [];
        if(!is_array($this->arrRute) && !empty($this->arrRute)){
            foreach (json_decode($this->arrRute) as $item) {
                $details[] = [
                    "tiba_di" => $item->tiba_di,
                    "tgl_tiba" => Carbon::parse($item->tgl_tiba)->format('d-m-Y'),
                    "berangkat_dari" => $item->berangkat_dari,
                    "tujuan" => $item->tujuan,
                    "tgl_berangkat" => Carbon::parse($item->tgl_berangkat)->format('d-m-Y'),
                ];
            }
            $this->arrRute = $details;
        }else{
            $this->arrRute = [];
        }

        $this->refreshDetailToString();
    }

    public function render()
    {

        return view('livewire.rute-sppd');
    }


    public function add()
    {
        $this->validate();

        $this->arrRute[] = [
            "tiba_di" => $this->tiba_di,
            "tgl_tiba" => $this->tgl_tiba,
            "berangkat_dari" => $this->berangkat_dari,
            "tujuan" => $this->tujuan,
            "tgl_berangkat" => $this->tgl_berangkat,
        ];

        $this->refreshDetailToString();
    }

    public function delete($id)
    {
        unset($this->arrRute[$id]);
        $this->arrRute = array_values($this->arrRute);

        $this->refreshDetailToString();
    }

    public function refreshDetailToString()
    {
        $this->tiba_di = '';
        $this->tgl_tiba = '' ;
        $this->berangkat_dari = '' ;
        $this->tujuan = "";
        $this->tgl_berangkat = "";
        if(count($this->arrRute)>0 )
            $this->rute = json_encode($this->arrRute);


    }
}
