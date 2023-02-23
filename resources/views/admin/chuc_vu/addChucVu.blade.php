@extends('layout_admin')
@section('content_addChucVu')
	<?php  $name_chuc_vu = Session::get('name_chuc_vu');
			$addted_chuc_vu = Session::get('addted_chuc_vu');
	 ?>
	<main>
		<div class="container">
			@if(isset($name_chuc_vu))
			 	<div class="row">
		                <div class="col-md-12 text-right">
		                    <div class="notify">
		                        <div class="alert alert-danger alert-dismissible nofication" role="alert">
		                            <strong>{{$name_chuc_vu}}</strong>
		                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                                <span aria-hidden="true">&times;</span>
		                                <span class="sr-only">Close</span>
		                            </button>
		                        </div>
		                    </div>
		                </div>
		            </div>

		            {{Session::put('name_chuc_vu', null)}}
			 @endif
			 @if(isset($addted_chuc_vu))
			 	<div class="row">
		                <div class="col-md-12 text-right">
		                    <div class="notify">
		                        <div class="alert alert-info alert-dismissible nofication" role="alert">
		                            <strong>{{$addted_chuc_vu}}</strong>
		                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                                <span aria-hidden="true">&times;</span>
		                                <span class="sr-only">Close</span>
		                            </button>
		                        </div>
		                    </div>
		                </div>
		            </div>
		            {{Session::put('addted_chuc_vu', null)}}
			 @endif
			<div class="row">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb mb-0" style="background: transparent;">
				    <li class="breadcrumb-item"><a href="{{route('admin-work24')}}">dashboard</a></li>
				    <li class="breadcrumb-item active" aria-current="page">Thêm chức vụ</li>
				  </ol>
				</nav>

			</div>
			<div class="row">
				<div class="col-md-6">
					<form action="{{route('postAddChucVu')}}" method="post">
						 <div class="form-group">
						    <label for="">Tên chức vụ</label>
						    <input type="text" class="form-control" id="exampleInputEmail1" name="name_chuc_vu" >
						  </div>

						  <input type="submit" value="Thêm mới" class="btn btn-outline-info">
					</form>
				</div>
			</div>
		</div>
	</main>
@endsection