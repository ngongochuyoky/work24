@extends('layout_admin')
@section('content_updateSalary')
	<main>
		<?php $name_salary = Session::get('name_salary'); 
			$updated_salary = Session::get('updated_salary'); 
		?>
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
			 @if(isset($updated_salary))
			 	<div class="row">
		                <div class="col-md-12 text-right">
		                    <div class="notify">
		                        <div class="alert alert-info alert-dismissible nofication" role="alert">
		                            <strong>{{$updated_salary}}</strong>
		                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                                <span aria-hidden="true">&times;</span>
		                                <span class="sr-only">Close</span>
		                            </button>
		                        </div>
		                    </div>
		                </div>
		            </div>
		            {{Session::put('updated_salary', null)}}
			 @endif
			<div class="row">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb mb-0" style="background: transparent;">
				    <li class="breadcrumb-item"><a href="{{route('admin-work24')}}">dashboard</a></li>
				    <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa lương</li>
				  </ol>
				</nav>

			</div>
			<div class="row">
				<div class="col-md-6">
					<form action="{{route('postUpdateSalary')}}" method="post">
						@if(isset($salary))
						 	<input type="text" hidden value="{{$salary->id}}" name="id">
							<div class="form-group">
							    <label for="">Lương tối thiểu</label>
							    <input type="text" class="form-control" id="" name="salary_min" value="{{$salary->salary_min}}" required="">
							 </div>

							 <div class="form-group">
							    <label for="">Lương tối đa</label>
							     <input type="text" class="form-control" id="" name="salary_max" value="{{$salary->salary_max}}" required="">
							 </div>
						@endif
						 

						  <input type="submit" value="cập nhật" class="btn btn-outline-info">
					</form>
				</div>
			</div>

			
		</div>
	</main>
@endsection