<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Pengikut extends Component
{

    public $arrPengikut = [];
    public $nama = '';
    public $umur = 0 ;
    public $keterangan = '' ;
    public $pengikut = "";

    public $ada_pengikut = false;

    public function mount()
    {
        $details = [];
        if(!is_array($this->arrPengikut) && !empty($this->arrPengikut)){
            foreach (json_decode($this->arrPengikut) as $item) {
                $details[] = ["nama" => $item->nama,"umur"=>$item->umur,'keterangan'=>$item->ket];
            }
            $this->arrPengikut = $details;
        }else{
            $this->arrPengikut = [];
        }

        if(count($this->arrPengikut)>0)
            $this->ada_pengikut = true;

        $this->refreshDetailToString();
    }

    public function render()
    {

        return view('livewire.pengikut');
    }


    public function add()
    {
        $this->arrPengikut[] = [
            "nama" => $this->nama,
            "umur" => $this->umur,
            "keterangan" => $this->keterangan
        ];

        $this->refreshDetailToString();
    }

    public function delete($id)
    {
        unset($this->arrPengikut[$id]);
        $this->arrPengikut = array_values($this->arrPengikut);

        $this->refreshDetailToString();
    }

    public function refreshDetailToString()
    {
        $this->pengikut = "";
        $this->nama = "";
        $this->umur = 0;
        $this->keterangan = '';
        if(count($this->arrPengikut)>0 && $this->ada_pengikut==true )
            $this->pengikut = json_encode($this->arrPengikut);


    }
}
