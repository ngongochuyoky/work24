@extends('layout_admin')
@section('content_updateCategory')
	<main>
		<?php $name_category = Session::get('name_category'); 
			$updated_category = Session::get('updated_category'); 
		?>
		<div class="container">
			@if(isset($name_category))
			 	<div class="row">
		                <div class="col-md-12 text-right">
		                    <div class="notify">
		                        <div class="alert alert-danger alert-dismissible nofication" role="alert">
		                            <strong>{{$name_category}}</strong>
		                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                                <span aria-hidden="true">&times;</span>
		                                <span class="sr-only">Close</span>
		                            </button>
		                        </div>
		                    </div>
		                </div>
		            </div>

		            {{Session::put('name_category', null)}}
			 @endif
			 @if(isset($updated_category))
			 	<div class="row">
		                <div class="col-md-12 text-right">
		                    <div class="notify">
		                        <div class="alert alert-info alert-dismissible nofication" role="alert">
		                            <strong>{{$updated_category}}</strong>
		                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                                <span aria-hidden="true">&times;</span>
		                                <span class="sr-only">Close</span>
		                            </button>
		                        </div>
		                    </div>
		                </div>
		            </div>
		            {{Session::put('updated_category', null)}}
			 @endif
			<div class="row">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb mb-0" style="background: transparent;">
				    <li class="breadcrumb-item"><a href="{{route('admin-work24')}}">dashboard</a></li>
				    <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa ngành nghề</li>
				  </ol>
				</nav>

			</div>
			<div class="row">
				<div class="col-md-6">
					<form action="{{route('postUpdateCategory')}}" method="post">
						@if(isset($category))
							<div class="form-group">
							    <label for="">Tên ngành nghề</label>
							    <input type="text" hidden value="{{$category->id}}" name="id">
							    <input type="text" class="form-control" id="" name="name_category" value="{{$category->name_category}}" required="">
							 </div>
						@endif
						 

						  <input type="submit" value="cập nhật" class="btn btn-outline-info">
					</form>
				</div>
			</div>

			
		</div>
	</main>
@endsection