<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;
use App\Models\Category;
use Illuminate\Support\Facades\URL;

class AdminCategoryComponent extends Component
{
    public $category,$urlCategory;
    public $state = [];
    public $showEditModal = false;
    public $catIdBeingRemoved = null;
    
    public function boot()
    {
        Paginator::useBootstrap();
    }
    
    public function addNew($urlCategory)
    {
        $this->state = [];
        $this->urlCategory = $urlCategory;
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    public function store()
    {
        $validatedDate = Validator::make($this->state, [
            'name' => 'required|unique:categories',
        ])->validate();
        
        $category = new Category();
        $category->name = $validatedDate['name'];
        $category->slug = Str::slug($validatedDate['name']);
        $category->save();
        
        session()->flash('message','Category has been created successfully!');
        $this->dispatchBrowserEvent('hide-form');    
        return redirect()->to($this->urlCategory);
    }   
    
    public function edit(Category $category,$urlCategory)
    {
        $this->state = [];
        $this->urlCategory = $urlCategory;
        $this->showEditModal = true;
        $this->category = $category;
        $this->state = $category->toArray();
        $this->dispatchBrowserEvent('show-form');
    }

    public function update()
    {
        $validatedDate = Validator::make($this->state, [
            'name' => 'required|unique:categories,name,'.$this->category->id,
        ])->validate();

        $this->category->update([
                'name' => $validatedDate['name'],
                'slug' => Str::slug($validatedDate['name']),
            ]);        

        session()->flash('message','Category has been updated successfully!');
        $this->dispatchBrowserEvent('hide-form');    
        return redirect()->to($this->urlCategory);
    }

    public function cancel()
    {     
        return redirect()->to($this->urlCategory);
    }

    public function deleteConfirmation($cat_Id,$urlCategory)
    {
        $this->urlCategory = $urlCategory;
        $this->catIdBeingRemoved = $cat_Id;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteCategory()
    {
        $category = Category::findOrFail($this->catIdBeingRemoved);
        $category->delete();
        session()->flash('message','Category has been deleted successfully!');
        $this->dispatchBrowserEvent('hide-delete-modal');
        return redirect()->to($this->urlCategory);
    }

    public function render()
    {
        $categories = Category::paginate(12);
        $categoriesTotal = Category::count();
        return view('livewire.admin.admin-category-component',['categories'=>$categories,'categoriesTotal'=>$categoriesTotal])->layout('layouts.base');
    }
}
