@extends('layout_admin')
@section('content_updateQuyMo')
	<main>
		<?php $name_quy_mo = Session::get('name_quy_mo'); 
			$updated_quy_mo = Session::get('updated_quy_mo'); 
		?>
		<div class="container">
			@if(isset($name_quy_mo))
			 	<div class="row">
		                <div class="col-md-12 text-right">
		                    <div class="notify">
		                        <div class="alert alert-danger alert-dismissible nofication" role="alert">
		                            <strong>{{$name_quy_mo}}</strong>
		                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                                <span aria-hidden="true">&times;</span>
		                                <span class="sr-only">Close</span>
		                            </button>
		                        </div>
		                    </div>
		                </div>
		            </div>

		            {{Session::put('name_quy_mo', null)}}
			 @endif
			 @if(isset($updated_quy_mo))
			 	<div class="row">
		                <div class="col-md-12 text-right">
		                    <div class="notify">
		                        <div class="alert alert-info alert-dismissible nofication" role="alert">
		                            <strong>{{$updated_quy_mo}}</strong>
		                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                                <span aria-hidden="true">&times;</span>
		                                <span class="sr-only">Close</span>
		                            </button>
		                        </div>
		                    </div>
		                </div>
		            </div>
		            {{Session::put('updated_quy_mo', null)}}
			 @endif
			<div class="row">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb mb-0" style="background: transparent;">
				    <li class="breadcrumb-item"><a href="{{route('admin-work24')}}">dashboard</a></li>
				    <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa quy mô</li>
				  </ol>
				</nav>

			</div>
			<div class="row">
				<div class="col-md-6">
					<form action="{{route('postUpdateQuyMo')}}" method="post">
						@if(isset($quy_mo))
							<div class="form-group">
							    <label for="">Tên quy mô</label>
							    <input type="text" hidden value="{{$quy_mo->id}}" name="id">
							    <input type="text" class="form-control" id="" name="name_quy_mo" value="{{$quy_mo->name_quy_mo}}" required="">
							 </div>
						@endif
						 

						  <input type="submit" value="cập nhật" class="btn btn-outline-info">
					</form>
				</div>
			</div>

			
		</div>
	</main>
@endsection