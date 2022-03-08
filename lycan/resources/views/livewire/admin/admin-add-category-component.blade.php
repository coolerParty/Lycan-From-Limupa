<div>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-6" style="margin: 0 auto;">
                <div class="card" >
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-title">
                                    Add New Category
                                </div>
                            </div>                                    
                            <div class="col-md-6">
                                <a href="{{ route('admin.categories') }}" class="btn btn-success pull-right">All Category</a>
                            </div>
                        </div>                        
                    </div>
                    <div class="card-body">
                        @if(Session::has('message'))
                            <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                        @endif
                        <form  wire:submit.prevent="storeCategory">
                            <div class="form-group"> 
                                    <label for="" class="col-form-label">Category Name</label>
                                    <input type="text" placeholder="Category Name" class="form-control" wire:model="name" wire:keyup="generateslug">
                            </div>
                            <div class="form-group">                                
                                    <label for="" class="col-form-label">Category Slug</label>
                                    <input type="text" placeholder="Category Slug" class="form-control" wire:model="slug">
                            </div>
                            <div class="form-group">
                                    <label for="" class="col-form-label"></label>
                                    <button type="submit"  class="btn btn-primary pull-right">Submit</button>                               
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
