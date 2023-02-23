@extends('layout_admin')
@section('content_allQuyMo')
<style>
	.contentLeft {
		height: auto;
	}
	
</style>
<?php $deleted_quy_mo = Session::get('deleted_quy_mo'); ?>
	<main>
		<div class="container">
			@if(isset($deleted_quy_mo))
			 	<div class="row">
		                <div class="col-md-12 text-right">
		                    <div class="notify">
		                        <div class="alert alert-danger alert-dismissible nofication" role="alert">
		                            <strong>{{$deleted_quy_mo}}</strong>
		                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                                <span aria-hidden="true">&times;</span>
		                                <span class="sr-only">Close</span>
		                            </button>
		                        </div>
		                    </div>
		                </div>
		            </div>

		            {{Session::put('deleted_quy_mo', null)}}
			 @endif
			<div class="row">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb mb-0" style="background: transparent;">
				    <li class="breadcrumb-item"><a href="{{route('admin-work24')}}">dashboard</a></li>
				    <li class="breadcrumb-item active" aria-current="page">Quản lý quy mô</li>
				  </ol>
				</nav>

			</div>
			<div class="row">
				<table class="table">
				  <thead class="thead-dark">
				    <tr>
				      <th scope="col">Stt</th>
				      <th scope="col">name</th>
				      <th scope="col">created_at</th>
				      <th scope="col">Hành động</th>
				    </tr>
				  </thead>
				  <tbody>
				  	@if(isset($quy_mo) && count($quy_mo) > 0)
				  		@foreach($quy_mo as $value)
					 		<tr>
						      <th scope="row">{{$value['id']}}</th>
						      <td >{{$value['name_quy_mo']}}</td>
						      <td >{{$value['created_at']}}</td>
						      <td>
						      
						      	<a href="{{route('updateQuyMo',[$value['id']])}}" class="fa fa-edit btn btn-outline-info">
						      	</a>
						      		<a href="{{route('deleteQuyMo',[$value['id']])}}" class="fa fa-trash btn btn-danger">
						      	</a>
						      </td>
						    </tr>
				  		@endforeach
				  		@else
				  			<p>K có dữ liệu</p>
				  	@endif

				  </tbody>

				</table>
				 <?php echo($quy_mo) ?>
			</div>

			
		</div>
	</main>
@endsection