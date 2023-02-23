@extends('layout_admin')
@section('content_updateFormOfWork')
	<main>
		<?php $name_form_of_work = Session::get('name_form_of_work'); 
			$updated_form_of_work = Session::get('updated_form_of_work'); 
		?>
		<div class="container">
			@if(isset($name_form_of_work))
			 	<div class="row">
		                <div class="col-md-12 text-right">
		                    <div class="notify">
		                        <div class="alert alert-danger alert-dismissible nofication" role="alert">
		                            <strong>{{$name_form_of_work}}</strong>
		                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                                <span aria-hidden="true">&times;</span>
		                                <span class="sr-only">Close</span>
		                            </button>
		                        </div>
		                    </div>
		                </div>
		            </div>

		            {{Session::put('name_form_of_work', null)}}
			 @endif
			 @if(isset($updated_form_of_work))
			 	<div class="row">
		                <div class="col-md-12 text-right">
		                    <div class="notify">
		                        <div class="alert alert-info alert-dismissible nofication" role="alert">
		                            <strong>{{$updated_form_of_work}}</strong>
		                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                                <span aria-hidden="true">&times;</span>
		                                <span class="sr-only">Close</span>
		                            </button>
		                        </div>
		                    </div>
		                </div>
		            </div>
		            {{Session::put('updated_form_of_work', null)}}
			 @endif
			<div class="row">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb mb-0" style="background: transparent;">
				    <li class="breadcrumb-item"><a href="{{route('admin-work24')}}">dashboard</a></li>
				    <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa hình thức việc làm</li>
				  </ol>
				</nav>

			</div>
			<div class="row">
				<div class="col-md-6">
					<form action="{{route('postUpdateFormOfWork')}}" method="post">
						@if(isset($form_of_work))
							<div class="form-group">
							    <label for="">Tên hình thức việc làm</label>
							    <input type="text" hidden value="{{$form_of_work->id}}" name="id">
							    <input type="text" class="form-control" id="" name="name_form_of_work" value="{{$form_of_work->name_form_of_work}}" required="">
							 </div>
						@endif
						 

						  <input type="submit" value="cập nhật" class="btn btn-outline-info">
					</form>
				</div>
			</div>

			
		</div>
	</main>
@endsection