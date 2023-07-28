<?php

namespace App\Http\Livewire;

use App\Models\Pegawai;
use App\Models\Position;
use App\Models\SuratTugasDetail;
use Livewire\Component;

class SuratTugasDetails extends Component
{
    public $nip = '';
    public $nama = '' ;
    public $jabatan = '' ;
    public $golongan = '' ;
    public $position_id = '' ;
    public $internal = true ;

    public $pegawai ;
    public $positions;
    public $suratTugas;


    public function mount()
    {
        $this->pegawai = Pegawai::query()
            ->aktif()
            ->get();

        $this->positions = Position::all();
    }

    public function render()
    {
        return view('livewire.surat-tugas-details',
            [
                "suratTugasDetail" => SuratTugasDetail::where('surat_tugas_id',$this->suratTugas->id)->get()
            ]);
    }

    public function updatedInternal($value)
    {
        if(!$value){
            $this->reset('nip','nama','jabatan','golongan','position_id');
        }

    }

    public function getPegawai($id)
    {
        $selected = $this->pegawai->where('id',$id)->first();

        if(isset($selected)){
            $this->nip = $selected->nip;
            $this->nama = $selected->nm_pegawai;
            $this->jabatan = $selected->nm_jab;
            $this->golongan = $selected->kd_golongan.'/'.$selected->nm_golongan;
            $this->position_id = '';
        }

    }

    public function addData()
    {
        $validateData = $this->validate([
            "nip" => "required|string",
            "nama" => "required|string",
            "jabatan" => "required|string",
            "golongan" => "required|string",
            "position_id" => "required",
        ]);

        try {
            $this->suratTugas->surat_tugas_details()->create($validateData);

            $this->reset('nip','nama','jabatan','golongan','internal','position_id');
        }catch (\Exception $e){
            $this->addError('save',$e->getMessage());
        }
    }

    public function delete($id)
    {

        try {
            $details = SuratTugasDetail::findOrFail($id);
            $details->delete();
            $this->reset('nip','nama','jabatan','golongan','internal','position_id');
        }catch (\Exception $e){
            $this->addError('delete',$e->getMessage());
        }
    }

}
