@extends('layout_admin')
@section('content_allChucVu')
<style>
	.contentLeft {
		height: auto;
	}
	
</style>
<?php $deleted_chuc_vu = Session::get('deleted_chuc_vu'); ?>
	<main>
		<div class="container">
			@if(isset($deleted_chuc_vu))
			 	<div class="row">
		                <div class="col-md-12 text-right">
		                    <div class="notify">
		                        <div class="alert alert-danger alert-dismissible nofication" role="alert">
		                            <strong>{{$deleted_chuc_vu}}</strong>
		                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                                <span aria-hidden="true">&times;</span>
		                                <span class="sr-only">Close</span>
		                            </button>
		                        </div>
		                    </div>
		                </div>
		            </div>

		            {{Session::put('deleted_chuc_vu', null)}}
			 @endif
			<div class="row">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb mb-0" style="background: transparent;">
				    <li class="breadcrumb-item"><a href="{{route('admin-work24')}}">dashboard</a></li>
				    <li class="breadcrumb-item active" aria-current="page">Quản lý ngành nghề</li>
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
				  	@if(isset($chuc_vu) && count($chuc_vu) > 0)
				  		@foreach($chuc_vu as $value)
					 		<tr>
						      <th scope="row">{{$value['id']}}</th>
						      <td >{{$value['name_chuc_vu']}}</td>
						      <td >{{$value['created_at']}}</td>
						      <td>
						      
						      	<a href="{{route('updateChucVu',[$value['id']])}}" class="fa fa-edit btn btn-outline-info">
						      	</a>
						      		<a href="{{route('deletechuc_vu',[$value['id']])}}" class="fa fa-trash btn btn-danger">
						      	</a>
						      </td>
						    </tr>
				  		@endforeach
				  		@else
				  			<p>K có dữ liệu</p>
				  	@endif


				   
				   
				  </tbody>

				</table>
				 <?php echo($chuc_vu) ?>
			</div>

			
		</div>
	</main>
@endsection