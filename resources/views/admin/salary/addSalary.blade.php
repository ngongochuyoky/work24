@extends('layout_admin')
@section('content_addSalary')
	<?php  $name_salary = Session::get('name_salary');
			$addted_salary = Session::get('addted_salary');
	 ?>
	<main>
		<div class="container">
			@if(isset($name_salary))
			 	<div class="row">
		                <div class="col-md-12 text-right">
		                    <div class="notify">
		                        <div class="alert alert-danger alert-dismissible nofication" role="alert">
		                            <strong>{{$name_salary}}</strong>
		                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                                <span aria-hidden="true">&times;</span>
		                                <span class="sr-only">Close</span>
		                            </button>
		                        </div>
		                    </div>
		                </div>
		            </div>

		            {{Session::put('name_salary', null)}}
			 @endif
			 @if(isset($addted_salary))
			 	<div class="row">
		                <div class="col-md-12 text-right">
		                    <div class="notify">
		                        <div class="alert alert-info alert-dismissible nofication" role="alert">
		                            <strong>{{$addted_salary}}</strong>
		                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                                <span aria-hidden="true">&times;</span>
		                                <span class="sr-only">Close</span>
		                            </button>
		                        </div>
		                    </div>
		                </div>
		            </div>
		            {{Session::put('addted_salary', null)}}
			 @endif
			<div class="row">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb mb-0" style="background: transparent;">
				    <li class="breadcrumb-item"><a href="{{route('admin-work24')}}">dashboard</a></li>
				    <li class="breadcrumb-item active" aria-current="page">Thêm mới lương</li>
				  </ol>
				</nav>

			</div>
			<div class="row">
				<div class="col-md-6">
					<form action="{{route('postAddSalary')}}" method="post">
						 <div class="form-group">
						    <label for="">Lương tối thiểu</label>
						    <input type="text" class="form-control" name="salary_min" >
						  </div>
						  <div class="form-group">
						    <label for="">Lương tối đa</label>
						    <input type="text" class="form-control" name="salary_max" >
						  </div>

						  <input type="submit" value="Thêm mới" class="btn btn-outline-info">
					</form>
				</div>
			</div>

			
		</div>
	</main>
@endsection