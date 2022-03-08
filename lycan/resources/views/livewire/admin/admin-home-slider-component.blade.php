<div>
					<div class="container" style="padding: 30px 0;">
						<div class="row">
							<div class="col-md-12">
								<div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card-title">HomeSlider</div>
                                        </div>
                                        <div class="col-md-6">
                                            <a class="btn btn-success pull-right" href="{{ route('admin.addhomeslider') }}"><i class="fa fa-plus-circle mr-2"></i>Add New</a>
                                        </div>
                                    </div>                        
                                </div>
									<div class="card-body">
									@if(Session::has('message'))
										<div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
									@endif
										<table class="table table-bordered table-striped table-hover">
											<thead>
												<tr>
													<th>Id</th>
                                                    <th>Image</th>
                                                    <th>Title</th>
													<th>Offers</th>
													<th>Subtitle</th>
                                                    <th>Link</th>
                                                    <th>Position</th>
                                                    <th>Status</th>
													<th>Date</th>
													<th class="col-sm-1">Action</th>
												</tr>
											</thead>
											<tbody>
												@foreach($homesliders as $homeslider)
													<tr>
														<td>{{$homeslider->id}}</td>
                                                        <td><img src="{{ asset('images/slider')}}/{{$homeslider->image}}" width="60"></td>
														<td>{{$homeslider->title}}</td>
                                                        <td>{{$homeslider->hTitleLeft}} <strong>{{$homeslider->hTitleCenter}}</strong> {{$homeslider->hTitleRight}}</td>
                                                        <td>{{$homeslider->subtitleLeft}} <strong>{{$homeslider->subtitleCenter}}</strong> {{$homeslider->subtitleRight}}</td>
                                                        <td>{{$homeslider->link}}</td>                                                        
														<td>
                                                            @if( $homeslider->position  == '3')
                                                                <span>Left</span>
                                                            @elseif( $homeslider->position == '2')
                                                                <span>Center</span>
                                                            @elseif( $homeslider->position == '1')
                                                                <span>Right</span>
                                                            @endif
                                                        </td>
                                                        <td>{{$homeslider->status == 1 ? 'Active':'Inactive'}}</td>
														<td>{{$homeslider->created_at}}</td>  
														<td>
															<a class="btn btn-primary btn-sm" href="{{ route('admin.edithomeslider',['slider_id'=>$homeslider->id]) }}"><i class="fa fa-edit mr-2"></i>Edit</a>
															<button class="btn btn-danger btn-sm" wire:click.prevent="destroy({{$homeslider->id}})"><i class="fa fa-trash mr-2"></i>Delete</button>
														</td>
													</tr>
												@endforeach
											</tbody>
										</table>
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>