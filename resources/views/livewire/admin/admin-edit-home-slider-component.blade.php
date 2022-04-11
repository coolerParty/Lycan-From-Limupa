<div>
		<div class="container" style="padding: 30px 0;">
			<div class="row">
				<div class="col-md-6" style="margin: 0 auto;">
					<div class="card" >
						<div class="card-header">
							<div class="row">
								<div class="col-md-6">
									<div class="card-title">
										Edit Slider
									</div>
								</div>                                    
								<div class="col-md-6">
									<a href="{{ route('admin.homeslider') }}" class="btn btn-success pull-right">All Sliders</a>
								</div>
							</div>                        
						</div>
						<div class="card-body">
							@if(Session::has('message'))
								<div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
							@endif
							<form  wire:submit.prevent="update">
								<div class="form-group"> 
										<label for="" class="col-form-label">Title</label>
										<input type="text" placeholder="Enter Title" class="form-control" wire:model="title">
								</div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">                                
                                            <label for="" class="col-form-label">Offers Left</label>
                                            <input type="text" placeholder="Short Left" class="form-control" wire:model="hTitleLeft">
                                    </div>                                
                                    <div class="form-group col-md-4">                                
                                            <label for="" class="col-form-label">Center</label>
                                            <input type="text" placeholder="Short Center" class="form-control" wire:model="hTitleCenter">
                                    </div>
                                    <div class="form-group col-md-4">                                
                                            <label for="" class="col-form-label">Right</label>
                                            <input type="text" placeholder="Short Right" class="form-control" wire:model="hTitleRight">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">                                
                                            <label for="" class="col-form-label">Subtitle Left</label>
                                            <input type="text" placeholder="Short Left" class="form-control" wire:model="subtitleLeft">
                                    </div>
                                    <div class="form-group col-md-4">                                
                                            <label for="" class="col-form-label">Center</label>
                                            <input type="text" placeholder="Short Center" class="form-control" wire:model="subtitleCenter">
                                    </div>
                                    <div class="form-group col-md-4">                                
                                            <label for="" class="col-form-label">Right</label>
                                            <input type="text" placeholder="Short Right" class="form-control" wire:model="subtitleRight">
                                    </div>
                                </div>
                                <div class="form-group">                                
										<label for="" class="col-form-label">Link</label>
										<input type="text" placeholder="link" class="form-control" wire:model="link">
								</div>
                                <div class="form-group">                                
										<label for="" class="col-form-label">Image</label>
										<div class="custom-file">                                            
                                            <input type="file" class="custom-file-input form-control @error('image') is-invalid @enderror" wire:model="newimage">
                                            <label class="custom-file-label" for="inputGroupFile04">Choose file</label> 
                                            @if($newimage)
                                                <img src="{{ $newimage->temporaryUrl() }}" width="120">
                                            @else
                                                <img src="{{ asset('images/slider')}}/{{$image}}" width="120">
                                            @endif 
                                            @error('newimage')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
								</div>
                                <div class="form-row">
                                    <div class="form-group  col-md-6">                                
                                            <label for="" class="col-form-label">Position</label>
                                            <select class="form-control @error('position') is-invalid @enderror" wire:model="position">
                                                <option value="1">Right</option>
                                                <option value="2">Center</option>
                                                <option value="3">Left</option>
                                            </select>
                                    </div>
                                    <div class="form-group  col-md-6">                                
                                            <label for="" class="col-form-label">Status</label>
                                            <select class="form-control @error('status') is-invalid @enderror" wire:model="status">
                                                <option value="0">Inactive</option>
                                                <option value="1">Active</option>
                                            </select>
                                    </div>
                                </div>
								<div class="form-group">
										<label for="" class="col-form-label"></label>
										<button type="submit"  class="btn btn-primary pull-right">Update</button>                               
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>