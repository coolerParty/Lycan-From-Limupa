<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\HomeSlider;

class HomeComponent extends Component
{
    public function render()
    {
        $homeSliders = HomeSlider::all();
        return view('livewire.home-component',['homeSliders'=>$homeSliders])->layout('layouts.base');
    }
}
