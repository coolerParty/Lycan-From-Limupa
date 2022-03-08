<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\HomeSlider;

class AdminHomeSliderComponent extends Component
{
    public function destroy($slider_id)
    {
        $slider = HomeSlider::find($slider_id);
        $slider->delete();
        session()->flash('message','Slider has been deleted successfully!');
    }

    public function render()
    {
        $homesliders = HomeSlider::all();
        return view('livewire.admin.admin-home-slider-component',['homesliders'=>$homesliders])->layout('layouts.base');
    }
}
