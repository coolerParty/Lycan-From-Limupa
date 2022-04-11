<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;
use App\Models\Product;
use App\Models\Category;
use Cart;

class SearchComponent extends Component
{
    public $sorting;

    public $search;
    public $product_cat;

    public function mount()
    {
        $this->sorting = "default";
        $this->fill(request()->only('search','product_cat'));
    }

    public function boot()
    {
        Paginator::useBootstrap();
    }    
    
    public function store($product_id,$product_name,$product_price)
    {
        Cart::add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        //Cart::instance('cart')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        session()->flash('success_message','Item added in Cart');
        return redirect()->route('product.cart');
    }

    // use WithPagination;
    
    public function render()
    {
        

        if($this->product_cat)
        {
            $cat_slug = Category::where('slug',$this->product_cat)->first();

            if($this->sorting=='dateNew')
            {
                $products = Product::where('name','like','%'.$this->search. '%')->where('category_id',$cat_slug->id)->orderBy('created_at','DESC')->paginate(12);
            }
            else if($this->sorting=='dateOld')
            {
                $products = Product::where('name','like','%'.$this->search . '%')->where('category_id',$cat_slug->id)->orderBy('created_at','ASC')->paginate(12);
            }
            else if($this->sorting=='nameASC')
            {
                $products = Product::where('name','like','%'.$this->search . '%')->where('category_id',$cat_slug->id)->orderBy('name','ASC')->paginate(12);
            }
            else if($this->sorting=='nameDESC')
            {
                $products = Product::where('name','like','%'.$this->search . '%')->where('category_id',$cat_slug->id)->orderBy('name','DESC')->paginate(12);
            }
            else if($this->sorting=='priceL')
            {
                $products = Product::where('name','like','%'.$this->search . '%')->where('category_id',$cat_slug->id)->orderBy('regular_price','ASC')->paginate(12);
            }
            else if($this->sorting=='priceH')
            {
                $products = Product::where('name','like','%'.$this->search . '%')->where('category_id',$cat_slug->id)->orderBy('regular_price','DESC')->paginate(12);
            }
            else
            {
                $products = Product::where('name', 'like','%'.$this->search.'%')->where('category_id',$cat_slug->id)->paginate(12);         
            }
        }
        else
        {
            if($this->sorting=='dateNew')
            {
                $products = Product::where('name','like','%'.$this->search. '%')->orderBy('created_at','DESC')->paginate(12);
            }
            else if($this->sorting=='dateOld')
            {
                $products = Product::where('name','like','%'.$this->search . '%')->orderBy('created_at','ASC')->paginate(12);
            }
            else if($this->sorting=='nameASC')
            {
                $products = Product::where('name','like','%'.$this->search . '%')->orderBy('name','ASC')->paginate(12);
            }
            else if($this->sorting=='nameDESC')
            {
                $products = Product::where('name','like','%'.$this->search . '%')->orderBy('name','DESC')->paginate(12);
            }
            else if($this->sorting=='priceL')
            {
                $products = Product::where('name','like','%'.$this->search . '%')->orderBy('regular_price','ASC')->paginate(12);
            }
            else if($this->sorting=='priceH')
            {
                $products = Product::where('name','like','%'.$this->search . '%')->orderBy('regular_price','DESC')->paginate(12);
            }
            else
            {
                $products = Product::where('name', 'like','%'.$this->search.'%')->paginate(12);         
            }

        }

        $categories = Category::all();
        
        return view('livewire.search-component',['products'=>$products,'categories'=>$categories])->layout('layouts.base');
    }
}
