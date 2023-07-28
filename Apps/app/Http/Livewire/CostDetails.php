<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CostDetails extends Component
{
    public $costDetails = [];
    public $nama = '';
    public $biaya = '0' ;

    public $cost_details = "";

    public $total_biaya = 0 ;
    public $ada_rincian = false;

    public function mount()
    {
        $details = [];
        if(!is_array($this->costDetails) && !empty($this->costDetails)){
            foreach (json_decode($this->costDetails) as $item) {
                $details[] = ["nama" => $item->nama,"biaya"=>$item->biaya];
                $this->total_biaya += $item->biaya;
            }
            $this->costDetails = $details;
        }else{
            $this->costDetails = [];
        }

        if(count($this->costDetails)>0)
            $this->ada_rincian = true;

        $this->refreshCostDetailString();
    }

    public function render()
    {

        if($this->ada_rincian)
            $this->emit('adaRincian',["rincian" => $this->ada_rincian, "total_biaya"=>$this->total_biaya]);


        $this->emit('reinit');
        return view('livewire.cost-details');
    }

    public function updatedAdaRincian($value)
    {
        $this->emit('adaRincian',["rincian" => $value, "total_biaya"=>$this->total_biaya]);
    }

    public function addDetail()
    {
        $this->costDetails[] = [
            "nama" => $this->nama,
            "biaya" => str_replace(",","",$this->biaya),
        ];

        $this->total_biaya += str_replace(",","",$this->biaya)  ;

        $this->refreshCostDetailString();
    }

    public function deleteDetail($id)
    {
        $this->total_biaya -= $this->costDetails[$id]['biaya'];
        unset($this->costDetails[$id]);
        $this->costDetails = array_values($this->costDetails);

        $this->refreshCostDetailString();
    }

    public function refreshCostDetailString()
    {
        $this->cost_details = "";
        $this->nama = "";
        $this->biaya = '0';
        if(count($this->costDetails)>0 && $this->ada_rincian==true )
            $this->cost_details = json_encode($this->costDetails);


    }

}
