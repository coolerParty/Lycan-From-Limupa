<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Livewire\WithFileUploads;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Validation\Rule;

class AdminProductComponent extends Component
{
    use WithFileUploads;
    public $product,$urlProduct;

    public $name;
    public $description;
    public $reference;
    public $regular_price;
    public $sale;
    public $SKU;
    public $stock_status;
    public $featured;
    public $quantity;
    public $image;
    public $category_id;
    public $newimage;

    public $showEditModal = false;
    public $prodIdBeingRemoved = null;

    public function mount()
    {
        $this->stock_status = 'instock';
        $this->featured = 0;
    }

    public function boot()
    {
        Paginator::useBootstrap();
    }

    public function addNew($urlProduct)
    {
        $this->product = null;
        $this->urlProduct = null;

        $this->name = null;
        $this->description = null;
        $this->reference = null;
        $this->regular_price = null;
        $this->sale = null;
        $this->SKU = null;
        $this->stock_status = 'instock';
        $this->featured = 0;
        $this->quantity = null;
        $this->image = null;
        $this->category_id = null;
        $this->newimage = null;
        // $this->state = [];
        $this->urlProduct = $urlProduct;
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'name' => [
                'required',
                Rule::unique('categories')->ignore($this->category_id)
            ],
            'description' => 'required',
            'reference' => 'required',
            'regular_price' => 'required|numeric',
            'sale' => 'numeric',
            'SKU' => 'required',
            'stock_status' => 'required',
            'featured' => 'required',
            'quantity' => 'required|numeric',
            'image' => 'required|mimes:jpeg,png',
            'category_id' => 'required',
        ]);
    }

    public function store()
    {
        $this->validate([
            'name' => [
                'required',
                Rule::unique('categories')->ignore($this->category_id)
            ],
             'description' => 'required',
             'reference' => 'required',
             'regular_price' => 'required|numeric',
             'sale' => 'numeric',
             'SKU' => 'required',
             'stock_status' => 'required',             
             'featured' => 'required',
             'quantity' => 'required|numeric',
             'image' => 'required|mimes:jpeg,png',
             'category_id' => 'required',
        ]);

        $product = new Product();
        $product->name = $this->name;
        $product->slug = Str::slug($this->name);
        $product->description = $this->description;
        $product->reference = $this->reference;
        $product->regular_price = $this->regular_price;
        $product->sale = $this->sale;
        $product->SKU = $this->SKU;
        $product->stock_status = $this->stock_status;
        $product->featured = $this->featured;
        $product->quantity = $this->quantity;        
        $imageName = Carbon::now()->timestamp. '.' . $this->image->extension();
        $this->image->storeAs('product/large-size',$imageName);
        $product->image = $imageName;
        $product->category_id = $this->category_id;
        $product->save();
        
        session()->flash('message','Product has been created successfully!');
        $this->dispatchBrowserEvent('hide-form');    
        return redirect()->to($this->urlProduct);
    }   

    public function edit(Product $product,$urlProduct)
    {
        $this->product = $product;       
        $this->urlProduct = $urlProduct;
        $this->showEditModal = true;

        $this->name = $product->name;        
        $this->description = $product->description;
        $this->reference = $product->reference;
        $this->regular_price = $product->regular_price;
        $this->sale = $product->sale;
        $this->SKU = $product->SKU;
        $this->stock_status = $product->stock_status;
        $this->featured = $product->featured;
        $this->quantity = $product->quantity; 
        $this->image = $product->image; 
        $this->category_id = $product->category_id; 
        $this->dispatchBrowserEvent('show-form');
    }

    public function update()
    {        
        $this->validate([
            'name' => [
                'required',
                Rule::unique('categories')->ignore($this->category_id)
            ],
            'description' => 'required',
            'reference' => 'required',
            'regular_price' => 'required|numeric',
            'sale' => 'numeric',
            'SKU' => 'required',
            'stock_status' => 'required',             
            'featured' => 'required',
            'quantity' => 'required|numeric',
            'newimage' => 'mimes:jpeg,png',
            'category_id' => 'required',
       ]);
        $this->product->name = $this->name;
        $this->product->slug = Str::slug($this->name);                
        $this->product->description = $this->description;
        $this->product->reference = $this->reference;
        $this->product->regular_price = $this->regular_price;
        $this->product->sale = $this->sale;
        $this->product->SKU = $this->SKU;
        $this->product->stock_status = $this->stock_status;
        $this->product->featured = $this->featured;
        $this->product->quantity = $this->quantity;
        if($this->newimage)
        {
            $imageName = Carbon::now()->timestamp. '.' . $this->newimage->extension();
            $this->newimage->storeAs('product/large-size',$imageName);
            $this->product->image = $imageName;
        }        
        $this->product->category_id = $this->category_id;     
        $this->product->save();              

        session()->flash('message','Product has been updated successfully!');
        $this->dispatchBrowserEvent('hide-form');    
        return redirect()->to($this->urlProduct);
    }

    public function deleteConfirmation($prod_id,$urlProduct)
    {
        $this->urlProduct = $urlProduct;
        $this->prodIdBeingRemoved = $prod_id;
        $this->dispatchBrowserEvent('show-delete-modal');
    }


    public function destroy()
    {
        $product = Product::findOrFail($this->prodIdBeingRemoved);
        $product->delete();
        session()->flash('message','Product has been deleted successfully!');
        $this->dispatchBrowserEvent('hide-delete-modal');
        return redirect()->to($this->urlProduct);
    }

    public function cancel()
    {     
        return redirect()->to($this->urlProduct);
    }

    public function render()
    {
        $products = Product::paginate(10);
        $productsTotal = Product::count();
        $categories = Category::all();        
        return view('livewire.admin.admin-product-component',['products'=>$products,'categories'=>$categories,'productsTotal'=>$productsTotal])->layout('layouts.base');
    }
    
}
