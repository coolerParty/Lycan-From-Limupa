<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\HomeSlider;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class AdminEditHomeSliderComponent extends Component
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
    public $newimage;
    public $slider_id;

    public function mount($slider_id)
    {
        $slider = HomeSlider::find($slider_id);
        $this->title = $slider->title;
        $this->hTitleLeft = $slider->hTitleLeft;
        $this->hTitleCenter = $slider->hTitleCenter;
        $this->hTitleRight = $slider->hTitleRight;
        $this->subtitleLeft = $slider->subtitleLeft;
        $this->subtitleCenter = $slider->subtitleCenter;
        $this->subtitleRight = $slider->subtitleRight;
        $this->link = $slider->link;
        $this->image = $slider->image;
        $this->position = $slider->position;
        $this->status = $slider->status;
        $this->slider_id = $slider->id;
    }

    public function update()
    {
        $slider = HomeSlider::find($this->slider_id);
        $slider->title = $this->title;
        $slider->hTitleLeft = $this->hTitleLeft;
        $slider->hTitleCenter = $this->hTitleCenter;
        $slider->hTitleRight = $this->hTitleRight;
        $slider->subtitleLeft = $this->subtitleLeft;
        $slider->subtitleCenter = $this->subtitleCenter;
        $slider->subtitleRight = $this->subtitleRight;
        $slider->link = $this->link;
        if($this->newimage)
        {
            $imagename = Carbon::now()->timestamp.'.'.$this->newimage->extension();
            $this->newimage->storeAs('slider',$imagename);
            $slider->image = $imagename;
        }
        $slider->position = $this->position;
        $slider->status = $this->status;
        $slider->save();

        session()->flash('message','Slide has been updated successfully!');
    }

    public function render()
    {
        return view('livewire.admin.admin-edit-home-slider-component')->layout('layouts.base');
    }
}
