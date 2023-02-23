@extends('layout_admin')
@section('content_allSalary')
<style>
	.contentLeft {
		height: auto;
	}
	
</style>
<?php $deleted_salary = Session::get('deleted_salary'); ?>
	<main>
		<div class="container">
			@if(isset($deleted_salary))
			 	<div class="row">
		                <div class="col-md-12 text-right">
		                    <div class="notify">
		                        <div class="alert alert-danger alert-dismissible nofication" role="alert">
		                            <strong>{{$deleted_salary}}</strong>
		                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                                <span aria-hidden="true">&times;</span>
		                                <span class="sr-only">Close</span>
		                            </button>
		                        </div>
		                    </div>
		                </div>
		            </div>

		            {{Session::put('deleted_salary', null)}}
			 @endif
			<div class="row">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb mb-0" style="background: transparent;">
				    <li class="breadcrumb-item"><a href="{{route('admin-work24')}}">dashboard</a></li>
				    <li class="breadcrumb-item active" aria-current="page">Quản lý lương</li>
				  </ol>
				</nav>

			</div>
			<div class="row">
				<table class="table">
				  <thead class="thead-dark">
				    <tr>
				      <th scope="col">Stt</th>
				      <th scope="col">lương tối thiểu</th>
				      <th scope="col">lương tối đa</th>
				      <th scope="col">created_at</th>
				      <th scope="col">Hành động</th>
				    </tr>
				  </thead>
				  <tbody>
				  	@if(isset($salary) && count($salary) > 0)
				  		@foreach($salary as $value)
					 		<tr>
						      <th scope="row">{{$value['id']}}</th>
						      <td >{{$value['salary_min']}}</td>
						      <td >{{$value['salary_max']}}</td>
						      <td >{{$value['created_at']}}</td>
						      <td>
						      
						      	<a href="{{route('updateSalary',[$value['id']])}}" class="fa fa-edit btn btn-outline-info">
						      	</a>
						      		<a href="{{route('deleteSalary',[$value['id']])}}" class="fa fa-trash btn btn-danger">
						      	</a>
						      </td>
						    </tr>
				  		@endforeach
				  		@else
				  			<p>K có dữ liệu</p>
				  	@endif

				  </tbody>

				</table>
				 <?php echo($salary) ?>
			</div>

			
		</div>
	</main>
@endsection