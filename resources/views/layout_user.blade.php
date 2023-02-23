
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Tìm việc làm nhanh</title>
	<link data-n-head="true" rel="icon" type="image/x-icon" href="{{asset('frontend/images/favicon.ico')}}"/>

	<!-- library -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i&display=swap" rel="stylesheet">


	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="{{asset("frontend/css/owl.carousel.min.css")}}">
	<link rel="stylesheet" href="{{asset("frontend/css/owl.theme.default.min.css")}}">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />


	<!-- style -->
	<link rel="stylesheet" href="{{asset("frontend/css/style.css")}}">
	<link rel="stylesheet" href="{{asset("frontend/css/all-work.css")}}">
	<link rel="stylesheet" href="{{asset("frontend/css/tuyen-dung.css")}}">
	<link rel="stylesheet" href="{{asset("frontend/css/chi-tiet-viec-lam.css")}}">
	<link rel="stylesheet" href="{{asset("frontend/css/cong-ty.css")}}">
</head>
<body>
	<div id="wrapper">
		<header>
			<div class="row_content_970">
				<a href="{{URL::to('')}}" class="logo">
					<img src="{{asset("frontend/images/logo.png")}}" alt="logo">
				</a>
				<div class="login">
					<?php 
						$userName = Session::get('user_name');
						$roles = Session::get('roles');


						//dd(gettype($roles));

 					?>
					@if(isset($userName) && isset($roles))
						@if($roles === -1)
							<div class="dropdown">
							  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							  	<i class="fa fa-user"></i>
							   <span>{{$userName}}</span>
							  </button>
							  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							    <a class="dropdown-item" href="{{route('trang-ca-nhan')}}">Quản lý tài khoản</a>
							    <a class="dropdown-item" href="{{route('quan-ly-ho-so')}}">Quản lý hồ sơ</a>
							    <a class="dropdown-item" href="{{URL::to('logout')}}">Đăng xuất</a>
							  </div>
							</div>
						@else
							@if($roles === 1) 
								<div class="dropdown">
								  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								  	<i class="fa fa-user"></i>
								   <span>{{$userName}}</span>
								  </button>
								  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								    <a class="dropdown-item" href="{{route('nha-tuyen-dung')}}">Quản lý tài khoản</a>
								    <a class="dropdown-item" href="{{route('allPost')}}">Quản lý tuyển dụng</a>
								    <a class="dropdown-item" href="{{route('updateCompany')}}">Quản lý thông tin</a>
								    <a class="dropdown-item" href="{{URL::to('logout')}}">Đăng xuất</a>
								  </div>
								</div>
							@endif
						@endif
						@else 
							<a href="" id="dn" data-toggle="modal" data-target="#formLogin">
								<i class="fa fa-user"></i>
								<span>Đăng nhập</span>
							</a>
							<a href="" id="dk" data-toggle="modal" data-target="#formRegister">
								<i class="fa fa-user-plus"></i>
								<span>Đăng ký</span>
							</a>
					@endif
					
				</div>
			</div>
		</header>
		<nav>
			<div class="row_content_970">
				<ul class="job_search">
					<li>
						<a href="{{URL::to('/')}}">
							<i class="fa fa-home"></i>
							<span>Trang Chủ</span>
						</a>
					</li>
					<li>
						<a href="{{URL::to('tuyen-dung')}}">
							<i class="fa fa-asterisk"></i>
							<span>Tất Cả Việc Làm</span>
						</a>
					</li>
					<li>
						<a href="{{URL::to('cong-ty')}}">
							<i class="fa fa-home"></i>
							<span>Công Ty</span>
						</a>
					</li>
					<li>
						<a href="{{URL::to('ung-vien')}}">
							<i class="fa fa-mortar-board"></i>
							<span>Ứng viên</span>
						</a>
					</li>
				</ul>
				{{-- <ul class="recruiment">
					<li>
						<a href="#">
							<i class="fa fa-search-plus"></i>
							<span>Tuyển dụng</span>
						</a>
					</li>
				</ul> --}}
			</div>
		</nav>
		{{-- content user --}}
		@yield('content_home')
		@yield('content_tuyendung')
		@yield('content_job')
		@yield('content_detailCompany')
		@yield('content_company')
		@yield('content_ungvien')
		@yield('content_profile')
		<footer>
			<div class="container">
				<div class="row">
					<h2 class="col-md-12 text-center">
						<strong>HỆ SINH THÁI TUYỂN DỤNG HÀNG ĐẦU</strong>
					</h2>
					<p class="col-md-12 text-center mb-30">work24h - Tìm việc làm, tìm việc nhanh, tuyển dụng uy tín và hiệu quả! </p>
				</div>
				<h5>
					<strong>Công Ty Cổ phần work24h Việt Nam</strong>
				</h5>
				<div class="row">
					<div class="col-md-6">
						<ul class="contact">
							<li class="item mb-10">
								<i class="fa fa-phone"></i>
								<p>
									<strong>Điện thoại: </strong> 
									<span>(+84) 898 162 560</span>
								</p>
							</li>
							<li class="item mb-10">
								<i class="fa fa-envelope-o"></i>
								<p>
									<strong>Email: </strong> 
									<span>Dungsky482@gmail.com</span>
								</p>
							</li>
							<li class="item ">
								<i class="fa fa-home"></i>
								<p>
									<strong>Trụ sở chính: </strong> 
									<span>Số 16, Trần Đại Nghĩa, Hòa Hải, Quận Ngũ Hành Sơn, Thành Phố Đà Nẵng</span>
								</p>
								
							</li>
						</ul>
					</div>
					<div class="col-md-6">
						<ul class="contact">
							<li class="item mb-10">
								<i class="fa fa-home"></i>
								<p>
									<strong>Địa chỉ giao dịch:</strong> 
									<span>Tầng 12A, Tòa nhà Center Building, Số 1 Nguyễn Huy Tưởng, Quận Thanh Xuân, Hà Nội.</span>
								</p>
								
							</li>
							<li class="item">
								<i class="fa fa-map-marker"></i>
								<p>
									<strong> Văn phòng Miền Nam: </strong> 
									<span> Tòa nhà Siêu Việt, 23 Trần Cao Vân, Phường Đa Kao, Quận 1, TP. Hồ Chí Minh.</span>
								</p>
								
							</li>
						</ul>
					</div>
				</div>
			</div>
		</footer>
		<div class="form_check">
			<div class="modal fade" id="formRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Đăng Ký</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <a href="{{URL::to('register_ntd')}}">Nhà Tuyển Dụng Đăng Ký</a>
			        <a href="{{URL::to('register_ntv')}}">Người Tìm Việc Đăng Ký</a>
			      </div>
			    </div>
			  </div>
			</div>

			<div class="modal fade" id="formLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Đăng Nhập</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <a href="{{URL::to('login_ntd')}}">Nhà Tuyển Dụng Đăng Nhập</a>
			        <a href="{{URL::to('login_ntv')}}">Người Tìm Việc Đăng Nhập</a>
			      </div>
			    </div>
			  </div>
			</div>
		</div>
	</div>
	
	<!-- library js -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	
	<script src="{{asset("frontend/js/jquery.min.js")}}"></script>
	<script src="{{asset("frontend/js/owl.carousel.min.js")}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
	{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> --}}


	<script src='https://kit.fontawesome.com/a076d05399.js'></script>

	<!-- style js -->
	<script src="{{asset("frontend/js/style.js")}}"></script>
</body>
</html>