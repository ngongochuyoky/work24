@extends('layout_admin')
@section('content_addFormOfWork')
	<?php  $name_form_of_work = Session::get('name_form_of_work');
			$addted_form_of_work = Session::get('addted_form_of_work');
	 ?>
	<main>
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
			 @if(isset($addted_form_of_work))
			 	<div class="row">
		                <div class="col-md-12 text-right">
		                    <div class="notify">
		                        <div class="alert alert-info alert-dismissible nofication" role="alert">
		                            <strong>{{$addted_form_of_work}}</strong>
		                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                                <span aria-hidden="true">&times;</span>
		                                <span class="sr-only">Close</span>
		                            </button>
		                        </div>
		                    </div>
		                </div>
		            </div>
		            {{Session::put('addted_form_of_work', null)}}
			 @endif
			<div class="row">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb mb-0" style="background: transparent;">
				    <li class="breadcrumb-item"><a href="{{route('admin-work24')}}">dashboard</a></li>
				    <li class="breadcrumb-item active" aria-current="page">Thêm hình thức việc làm</li>
				  </ol>
				</nav>

			</div>
			<div class="row">
				<div class="col-md-6">
					<form action="{{route('postAddFormOfWork')}}" method="post">
						 <div class="form-group">
						    <label for="">Tên bằng cấp</label>
						    <input type="text" class="form-control" id="exampleInputEmail1" name="name_form_of_work" >
						  </div>

						  <input type="submit" value="Thêm mới" class="btn btn-outline-info">
					</form>
				</div>
			</div>

			
		</div>
	</main>
@endsection