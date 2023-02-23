@extends('layout_dashboard')
@section('content_index')
	<main>

		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
		    <li class="breadcrumb-item active" aria-current="page">Quản lý hồ sơ</li>
		  </ol>
		</nav>
		<?php 
		$created_at = Session::get('created_at');
		$updated_at = Session::get('updated_at');

		$message_b3 = Session::get('message_b3');
		$updated = Session::get('updated');


		?> 

		@if(isset($message_b3))
			<div class="row">
				<div class="col-md-12 text-right">
					<div class="notify">
						<div class="alert alert-info alert-dismissible nofication" role="alert">
							<strong>{{$message_b3}}</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								<span class="sr-only">Close</span>
							</button>
						</div>
					</div>
				</div>
			</div>
			{{Session::put('message_b3', null)}}
			
		@endif
		@if(isset($position) && $position[0]['name_position'] !== '')
				<section class="cv-online">
					<div class="container">
						<div class="row">
							<div class="card col-md-6" style="width: 18rem;">
							  <div class="card-body">
							    <h5 class="card-title">Hồ sơ online work24</h5>
							    
							   <div class="text-img">
							   	<div class="">
							   		<p><strong style="color: blue">
							   				{{$position[0]['name_position']}}
							   		</strong></p>
							   	<p><strong>Ngày tạo: </strong><span>
							   				{{$position[0]['created_at']}}
							   	</span></p>
							   	<p>	<strong>Ngày cập nhật: </strong><span>
							   				{{$position[0]['updated_at']}}
							   	</span></p>
							   	</div>
							   	
							   
							   	 <img src="https://mywork.com.vn/cv-online-gray.svg" alt="">
							   </div>
							    <a href="{{route('getUpdateInfo')}}" class="btn btn-outline-primary"><i class="fa fa-edit"></i><span>Chỉnh sửa</span></a>
							  </div>
							</div>
						</div>
					</div>
				</section>
				@else
				<section class="cv-online">
					<div class="container">
						<div class="row">
							<div class="card col-md-6" style="width: 18rem;">
							  <div class="card-body">
							    <h5 class="card-title">Hồ sơ online work24</h5>
							    
							   <div class="text-img">
							   	 <p class="card-text">Phù hợp với các hồ sơ không có file đính kèm, muốn nhập chi tiết thông tin hồ sơ của mình để hiển thị trên work24.</p>
							   	 <img src="https://mywork.com.vn/cv-online-gray.svg" alt="">
							   </div>
							    <a href="{{route('getUpdateInfo')}}" class="btn btn-primary card-link"><i class="fa fa-edit"></i><span>Làm hồ sơ</span></a>
							  </div>
							</div>
						</div>
					</div>
				</section>
				

			@endif


		
		
	</main>
@endsection()