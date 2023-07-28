<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
class UploadFile extends Component
{

    use WithFileUploads;

    public $uploaded ;
    public $type;
    public $name;
    public $filename;
    public $file;
    public $folder;
    public $key;
    public $required = true;
    public $acceptExtension = '';
    public $mimes = '';

    public function mount()
    {
        $typeUpload = $this->typeExtension($this->type);
        $this->acceptExtension = $typeUpload['accept'];
        $this->mimes = $typeUpload['mimes'];
    }

    public function render()
    {
        return view('livewire.upload-file');
    }

    public function updatedFile()
    {
        $this->validate([
            'file' => "mimes:".$this->mimes."|max:51200", // 5MB Max
        ]);
        $this->filename = time().'_'.$this->name.'.'.$this->file->getClientOriginalExtension();
        $this->uploaded = $this->file->storeAs($this->folder.'/'.(isset($this->key) ? $this->key."/" : ""),$this->filename,'public');
    }

    public function delete()
    {

        $path = $this->folder.'/'.$this->key.'/'.$this->filename;

        Storage::disk('public')->delete($path);
        $this->uploaded = null;
        $this->filename = '';
        $this->key = null;
        $this->folder = 'tmp';
    }

    public function typeExtension($type):array
    {
        $accept_mimes = [];

        if($type=='document')
            $accept_mimes = ["accept"=>'.pdf',"mimes"=>'pdf'];

        if($type=='image')
            $accept_mimes = ["accept"=>'.jpg,.png,.jpeg',"mimes"=>'jpg,png,jpeg'];

        return $accept_mimes;
    }
}
