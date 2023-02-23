@extends('layout_admin')
@section('content_updateCities')
	<main>
		<?php $name_cities = Session::get('name_cities'); 
			$updated_cities = Session::get('updated_cities'); 
		?>
		<div class="container">
			@if(isset($name_cities))
			 	<div class="row">
		                <div class="col-md-12 text-right">
		                    <div class="notify">
		                        <div class="alert alert-danger alert-dismissible nofication" role="alert">
		                            <strong>{{$name_cities}}</strong>
		                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                                <span aria-hidden="true">&times;</span>
		                                <span class="sr-only">Close</span>
		                            </button>
		                        </div>
		                    </div>
		                </div>
		            </div>

		            {{Session::put('name_cities', null)}}
			 @endif
			 @if(isset($updated_cities))
			 	<div class="row">
		                <div class="col-md-12 text-right">
		                    <div class="notify">
		                        <div class="alert alert-info alert-dismissible nofication" role="alert">
		                            <strong>{{$updated_cities}}</strong>
		                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                                <span aria-hidden="true">&times;</span>
		                                <span class="sr-only">Close</span>
		                            </button>
		                        </div>
		                    </div>
		                </div>
		            </div>
		            {{Session::put('updated_cities', null)}}
			 @endif
			<div class="row">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb mb-0" style="background: transparent;">
				    <li class="breadcrumb-item"><a href="{{route('admin-work24')}}">dashboard</a></li>
				    <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa thành phố</li>
				  </ol>
				</nav>

			</div>
			<div class="row">
				<div class="col-md-6">
					<form action="{{route('postUpdateCities')}}" method="post">
						@if(isset($cities))
							<div class="form-group">
							    <label for="">Tên thành phố</label>
							    <input type="text" hidden value="{{$cities->id}}" name="id">
							    <input type="text" class="form-control" id="" name="name_cities" value="{{$cities->name_cities}}" required="">
							 </div>
						@endif
						 

						  <input type="submit" value="cập nhật" class="btn btn-outline-info">
					</form>
				</div>
			</div>

			
		</div>
	</main>
@endsection