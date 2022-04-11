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
                                <div class="card-title">All Categories</div>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-success pull-right" wire:click.prevent="addNew('{{ url()->full() }}' )"><i class="fa fa-plus-circle mr-2"></i>Add New</button>
                            </div>
                        </div>                        
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered  table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category Name</th>
                                    <th>Slug</th>
                                    <th class="col-sm-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <th scope="row">{{$category->id}}</th>
                                        <td>{{$category->name}}</td>
                                        <td>{{$category->slug}}</td>
                                        <td class="col-sm-2">
                                        <button wire:click.prevent="edit({{ $category }},'{{ url()->full() }}' )" class="btn btn-primary btn-sm"><i class="fa fa-edit mr-2"></i>Edit</button>
                                        <button wire:click="deleteConfirmation({{ $category->id }},'{{url()->full()}}')" class="btn btn-danger btn-sm"><i class="fa fa-trash mr-2"></i>Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-6">
                            <caption>Total : <Strong>{{ $categoriesTotal}}</Strong></caption>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="pull-right">
                                {{ $categories->onEachSide(2)->links() }}
                                </div>
                            </div>

                            <!-- ------ -->
                            

                            <!------- Modal Add / Edit Start ------->
                                <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
                                <div class="modal-dialog" role="document">
                                    <form  autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'update' : 'store'}}">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                @if($showEditModal)    
                                                    <span>Edit Category</span>
                                                @else
                                                    <span>Add New Cateogry</span>
                                                @endif
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click.prevent="cancel">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            
                                                <div class="form-group"> 
                                                        <label for="" class="col-form-label">Category Name</label>
                                                        <input type="text" placeholder="Category New Category" class="form-control @error('name') is-invalid @enderror " wire:model.defer="state.name">
                                                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                                                <h5>Delete Category</h5>
                                            </div>
                                            <div class="modal-body">                                                
                                                <span>Are you sure you want to delete this Category?</span>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" wire:click.prevent="cancel('{{$urlCategory}}')" data-dismiss="modal"><i class="fa fa-times mr-2"></i>Close</button>
                                            <button type="button" wire:click.prevent="deleteCategory" class="btn btn-danger"><i class="fa fa-trash mr-2"></i> Delete Category</button>
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
