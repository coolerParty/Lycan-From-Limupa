<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\HomeSlider;
use Carbon\Carbon;
use Livewire\WithFileUploads;

class AdminAddHomeSliderComponent extends Component
{
    use WithFileUploads;
    public $title;
    public $hTitleLeft;
    public $hTitleCenter;
    public $hTitleRight;
    public $subtitleLeft;
    public $subtitleCenter;
    public $subtitleRight;
    public $link;
    public $image;
    public $position;
    public $status;

    public function mount()
    {
        $this->status = 0;
        $this->position = 1;
    }

    public function store()
    {
        $this->validate([
            
        ]);
        $homeslider = new HomeSlider();
        $homeslider->title = $this->title;
        $homeslider->hTitleLeft = $this->hTitleLeft;
        $homeslider->hTitleCenter = $this->hTitleCenter;
        $homeslider->hTitleRight = $this->hTitleRight;
        $homeslider->subtitleLeft = $this->subtitleLeft;
        $homeslider->subtitleCenter = $this->subtitleCenter;
        $homeslider->subtitleRight = $this->subtitleRight;
        $homeslider->link = $this->link;
        $imagename = Carbon::now()->timestamp.'.'.$this->image->extension();
        $this->image->storeAs('slider',$imagename);
        $homeslider->image = $imagename;
        $homeslider->position = $this->position;
        $homeslider->status = $this->status;
        $homeslider->save();
        session()->flash('message','Slider has been created successfully');


    }

    public function render()
    {
        return view('livewire.admin.admin-add-home-slider-component')->layout('layouts.base');
    }
}
