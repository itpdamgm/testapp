<?php

namespace App\Http\Livewire;

use Livewire\Component;


class UserMenu extends Component
{

    public $selectedMenus;

    public function mount()
    {
        if(!is_array($this->selectedMenus))
            $this->selectedMenus = explode(",",$this->selectedMenus);
    }

    public function render()
    {
        return view('livewire.user-menu');
    }

//    public function updatedSelectedMenus()
//    {
//        dd($this->selectedMenus);
//    }


}
