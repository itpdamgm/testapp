<?php

namespace App\Http\Livewire;

use App\Models\Cost;
use Livewire\Component;

class RincianBiayaSppd extends Component
{
    public $type_id;
    public $position_id;
    public $rabDetails = [];
    public $biaya = 0;
    public $rab_details = '';

    public $cost_id = null;
    public $nama = '';
    public $satuan = '';
    public $qty = 0;
    public $harga = 0;

    public $total_biaya = '0';

    public $defaultSelect2 = [["id"=>"","text"=>"-- Pilih Biaya --"]];
    public $select2Data = [];

    public $is_edit = false;


    public function mount()
    {
        $details = [];
        if(!is_array($this->rabDetails) && !empty($this->rabDetails)){
            foreach (json_decode($this->rabDetails) as $item) {

                $details[] = [
                    "cost_id" => $item->cost_id,
                    "nama" => $item->nama_biaya??$item->nama,
                    "satuan" => $item->satuan,
                    "qty" => $item->qty,
                    "biaya" => str_replace(",","",$item->biaya),
                    "sub_total" => str_replace(",","",$item->biaya)*$item->qty
                ];
            }
            $this->rabDetails = $details;

            $costs = Cost::query()
                ->selectRaw('id,nama text')
                ->where('type_id',$this->type_id)
                ->where('position_id',$this->position_id)
                ->get();

            if(count($costs)>0)
                $this->select2Data = $costs->toArray();



        }else{
            $this->rabDetails = [];
        }

        $this->refreshRabDetailString();
    }

    public function render()
    {

        return view('livewire.rincian-biaya-sppd');
    }

    public function updatedTypeId($value)
    {

        $costs = Cost::query()
            ->selectRaw('id,nama text')
            ->where('type_id',$value)
            ->where('position_id',$this->position_id)
            ->get();

        $this->select2Data = $this->defaultSelect2;
        if(count($costs)>0)
            $this->select2Data = array_merge($this->defaultSelect2,$costs->toArray());

        $this->emit('reinit');
    }

    public function updatedPositionId($value)
    {
        $costs = Cost::query()
            ->selectRaw('id,nama text')
            ->where('type_id',$this->type_id)
            ->where('position_id',$value)
            ->get();

        $this->select2Data = $this->defaultSelect2;
        if(count($costs)>0)
            $this->select2Data = array_merge($this->defaultSelect2,$costs->toArray());

        $this->emit('reinit');
    }

    public function updatedCostId($value)
    {
        $cost = Cost::find($value);
        $this->biaya = $cost->pagu??0;
        $this->nama = $cost->nama??'';
        $this->emit('selectedCost',[$value,$cost->pagu??0]);
    }

    public function addDetail()
    {


        $this->rabDetails[] = [
            "cost_id" => !empty($this->cost_id) ? $this->cost_id : null,
            "nama" => $this->nama,
            "satuan" => $this->satuan,
            "qty" => $this->qty,
            "biaya" => str_replace(",","",$this->biaya),
            "sub_total" => str_replace(",","",$this->biaya)*$this->qty,
        ];


        $this->refreshRabDetailString();
        $this->emit('refreshElement');

    }

    public function deleteDetail($id)
    {

        $this->total_biaya = number_format(str_replace(",","",$this->total_biaya)-($this->rabDetails[$id]['biaya']*$this->rabDetails[$id]['qty']));
        unset($this->rabDetails[$id]);
        $this->rabDetails = array_values($this->rabDetails);

        $this->refreshRabDetailString();
    }

    public function refreshRabDetailString()
    {
        $this->rab_details = "";
        $this->qty = 0;
        $this->satuan = '';
        $this->biaya = '0';
        $this->cost_id = "";
        $this->total_biaya = '0';

        if(count($this->rabDetails)>0){
            $this->rab_details = json_encode($this->rabDetails);
            $this->total_biaya = number_format(collect($this->rabDetails)->sum('sub_total'));
        }


    }

}
