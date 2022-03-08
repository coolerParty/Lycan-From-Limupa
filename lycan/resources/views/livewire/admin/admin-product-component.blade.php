<div>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                        @if(Session::has('message'))
                            <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                        @endif
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-title">All Products</div>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-success pull-right" wire:click.prevent="addNew('{{ url()->full() }}' )"><i class="fa fa-plus-circle mr-2"></i>Add New</button>
                            </div>
                        </div>                        
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered  table-striped table-hover table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>stock</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Date</th>
                                    <th class="col-sm-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <th scope="row">{{$product->id}}</th>
                                        <td><img src="{{ asset('images/product/small-size')}}/{{$product->image}}" width="60"></td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->stock_status}}</td>
                                        <td>{{$product->regular_price}}</td>
                                        <td>{{$product->category->name}}</td>
                                        <td>{{$product->created_at}}</td>
                                        <td class="col-sm-2">
                                        <button wire:click.prevent="edit({{ $product }},'{{ url()->full() }}' )" class="btn btn-primary btn-sm"><i class="fa fa-edit mr-2"></i>Edit</button>
                                        <button wire:click="deleteConfirmation({{ $product->id }},'{{url()->full()}}')" class="btn btn-danger btn-sm"><i class="fa fa-trash mr-2"></i>Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-6">
                                <caption>Total : <Strong>{{ $productsTotal}}</Strong></caption>                                
                            </div>
                            <div class="col-md-6">
                                <div class="pull-right">
                                {{ $products->onEachSide(2)->links() }}
                                </div>
                            </div>

                            <!------- Modal Add / Edit Start ------->
                            <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
                                <div class="modal-dialog" role="document">
                                    <form  autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'update' : 'store'}}">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    @if($showEditModal)    
                                                        <span>Edit Product</span>
                                                    @else
                                                        <span>Add New Product</span>
                                                    @endif
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click.prevent="cancel">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                
                                                    <div class="form-group"> 
                                                            <label for="" class="col-form-label">Name</label>
                                                            <input type="text" placeholder="Product Name" class="form-control @error('name') is-invalid @enderror " wire:model.defer="name">
                                                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    </div>

                                                    <div class="form-group"> 
                                                            <label for="" class="col-form-label">Description</label>
                                                            <input type="text" placeholder="Enter Product Description" class="form-control @error('description') is-invalid @enderror " wire:model.defer="description">
                                                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    </div>

                                                    <div class="form-group"> 
                                                            <label for="" class="col-form-label">Reference</label>
                                                            <input type="text" placeholder="Enter Reference" class="form-control @error('reference') is-invalid @enderror " wire:model.defer="reference">
                                                            @error('reference')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    </div>

                                                    <div class="form-group"> 
                                                            <label for="" class="col-form-label">Price</label>
                                                            <input type="text" placeholder="Enter Price" class="form-control @error('regular_price') is-invalid @enderror " wire:model.defer="regular_price">
                                                            @error('regular_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    </div>

                                                    <div class="form-group"> 
                                                            <label for="" class="col-form-label">Sale Price</label>
                                                            <input type="text" placeholder="Enter Sale Price" class="form-control @error('sale') is-invalid @enderror " wire:model.defer="sale">
                                                            @error('sale')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    </div>

                                                    <div class="form-group"> 
                                                            <label for="" class="col-form-label">SKU</label>
                                                            <input type="text" placeholder="Enter SKU" class="form-control @error('SKU') is-invalid @enderror " wire:model.defer="SKU">
                                                            @error('SKU')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    </div>

                                                    <div class="form-group"> 
                                                            <label for="" class="col-form-label">Stock Status</label>
                                                            <select class="form-control @error('stock_status') is-invalid @enderror" wire:model.defer="stock_status">
                                                                <option value="instock" selected="selected">InStock</option>
                                                                <option value="outofstock">Out of Stock</option>
                                                            </select>
                                                            @error('stock_status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    </div>

                                                    <div class="form-group"> 
                                                            <label for="" class="col-form-label">Featured Products</label>
                                                            <select class="form-control @error('featured') is-invalid @enderror" wire:model.defer="featured">
                                                                <option value="0" selected="selected">No</option>
                                                                <option value="1">Yes</option>
                                                            </select>
                                                            @error('featured')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    </div>

                                                    <div class="form-group"> 
                                                            <label for="" class="col-form-label">Quantity</label>
                                                            <input type="text" placeholder="Enter Quantity" class="form-control @error('quantity') is-invalid @enderror " wire:model.defer="quantity">
                                                            @error('quantity')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    </div>

                                                    <div class="form-group"> 
                                                            <label for="" class="col-form-label">Image</label>
                                                            <!-- <input type="file" class="input-file form-control @error('image') is-invalid @enderror " wire:model.defer="image"> -->
                                                            

                                                            <div class="custom-file">
                                                                @if($showEditModal)
                                                                    <input type="file" class="custom-file-input form-control @error('newimage') is-invalid @enderror" id="inputGroupFile04" wire:model.defer="newimage">
                                                                    <label class="custom-file-label" for="inputGroupFile04">Choose file</label>                                                                
                                                                    @if($newimage)
                                                                        <img src="{{ $newimage->temporaryUrl() }}" width="120">
                                                                    @else
                                                                        <img src="{{ asset('images/product/large-size') }}/{{$image}}" width="120">
                                                                    @endif 
                                                                    @error('newimage')<div class="invalid-feedback">{{ $message }}</div>@enderror

                                                                @else
                                                                    <input type="file" class="custom-file-input form-control @error('image') is-invalid @enderror" id="inputGroupFile04" wire:model.defer="image">
                                                                    <label class="custom-file-label" for="inputGroupFile04">Choose file</label> 
                                                                    @if($image)
                                                                        <img src="{{ $image->temporaryUrl() }}" width="120">
                                                                    @endif 
                                                                    @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                                @endif
                                                                
                                                            </div>
                                                            
                                                    </div>

                                                    

                                                    <div class="form-group"> 
                                                            <label for="" class="col-form-label">Category</label>
                                                            <select class="form-control @error('category_id') is-invalid @enderror" wire:model.defer="category_id">
                                                                <option value="">Select Category</option>
                                                                @foreach($categories as $category)
                                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" wire:click.prevent="cancel" data-dismiss="modal"><i class="fa fa-times mr-2"></i>Close</button>
                                                <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-2"></i>
                                                    @if($showEditModal)
                                                        <span>Save Changes</span>
                                                    @else
                                                        <span>Save</span>
                                                    @endif
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                </div>
                            <!------- Modal Add / Edit End ------->
                            

                            
                            <!------- Modal Delete Start ------->
                            <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
                                <div class="modal-dialog" role="document">
                                    <form  autocomplete="off" >
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5>Delete Product</h5>
                                            </div>
                                            <div class="modal-body">                                                
                                                <span>Are you sure you want to delete this Product?</span>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" wire:click.prevent="cancel" data-dismiss="modal"><i class="fa fa-times mr-2"></i>Close</button>
                                            <button type="button" wire:click.prevent="destroy" class="btn btn-danger"><i class="fa fa-trash mr-2"></i> Delete Product</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!------- Modal Delete End ------->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
