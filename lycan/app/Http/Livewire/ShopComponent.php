<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;
use App\Models\Product;
use App\Models\Category;
use Cart;

class ShopComponent extends Component
{
    public $sorting;

    public function mount()
    {
        $this->sorting = "default";
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
        if($this->sorting=='dateNew')
        {
            $products = Product::orderBy('created_at','DESC')->paginate(12);
        }
        else if($this->sorting=='dateOld')
        {
            $products = Product::orderBy('created_at','ASC')->paginate(12);
        }
        else if($this->sorting=='nameASC')
        {
            $products = Product::orderBy('name','ASC')->paginate(12);
        }
        else if($this->sorting=='nameDESC')
        {
            $products = Product::orderBy('name','DESC')->paginate(12);
        }
        else if($this->sorting=='priceL')
        {
            $products = Product::orderBy('regular_price','ASC')->paginate(12);
        }
        else if($this->sorting=='priceH')
        {
            $products = Product::orderBy('regular_price','DESC')->paginate(12);
        }
        else
        {
            $products = Product::paginate(12);
        }

        $categories = Category::all();
        
        return view('livewire.shop-component',['products'=>$products,'categories'=>$categories])->layout('layouts.base');
    }
}
