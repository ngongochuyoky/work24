<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>dashboard</title>
	<link data-n-head="true" rel="icon" type="image/x-icon" href="{{asset('frontend/images/favicon.ico')}}"/>

	<!-- library -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />

	<link rel="stylesheet" href="{{asset("frontend/css/style-dashboard.css")}}">


	<!-- style -->
	<style>
		.contentLeft {
    		height: 100vh;
		}
	</style>
</head>
<body>
	<?php 
		$userName = Session::get('user_name');
		 $id_user = Session::get('id_user');
	 ?>
	<div id="wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-3 contentLeft">
					<div class="logo"></div>
					<div class="info">
							@foreach($userAvatar as $value)
								@if($value['id'] === $id_user)
									@if($value['avatar'] === '') 
										<div class="avatar">
											<img src="https://cdn1.mywork.com.vn/default-image/avatar/male_avatar.jpg" alt="avatar">
										</div>
									@else 
										<div class="avatar">
                                            <img src="{{$value['avatar']}}" alt="avatar">
										</div>
										
									@endif
									
								@endif
							@endforeach
						
						@if(isset($userName))
							<h4 class="name">{{$userName}}</h4>
						@endif
					</div>
					<div class="menu">
						<ul class="contact">
							<li class="item <?php if(isset($active1)) {echo $active1; } ?>">
								<a href="{{URL::to('trang-ca-nhan')}}" >
									<i class="fa fa-cubes"></i>
									<span>Quản lý chung</span>
								</a>
							</li>
							<li class="item <?php if(isset($active2)) {echo $active2; } ?>">
								<a href="{{URL::to('quan-ly-ho-so')}}">
									<i class="fa fa-info-circle"></i>
									<span>Quản lý hồ sơ</span>
								</a>
							</li>
							<li id="item_click">
								<i class="fa fa-asterisk"></i>
								<span>Quản lý việc làm</span>
								<ul id="contact_con">
									<li class="item <?php if(isset($active3)) {echo $active3; } ?>">
										<a href="{{route('getJobs')}}">Việc làm đã lưu</a>
									</li>
									<li class="item <?php if(isset($active4)) {echo $active4; } ?>">
										<a href="{{route('getJobs_apply')}}">Việc làm đã ứng tuyển</a>
									</li>
								</ul>
							</li>
							<li class="item <?php if(isset($active5)) {echo $active5; } ?>">
								<a href="{{URL::to('doi-mat-khau')}}">
									<i class="fa fa-unlock"></i>
									<span>Đổi mật khẩu</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-9">
					<header>
						<div class="lien-he">
							<p>Số điện thoại hỗ trợ, tư vấn dành cho người tìm việc</p>
						<p><strong>Miền Bắc: (024) 710 88988 </strong> <strong>Miền Nam: (028) 710 88988</strong></p>
						</div>
						<nav>
							<a href="{{URL::to('/')}}" class="link" target="_blank">
								<i class="fa fa-home"></i>
								<span>Trang chủ</span>
							</a>
							<a href="{{URL::to('tuyen-dung')}}" class="link" target="_blank">
								<i class="fa fa-briefcase"></i>
								<span>Tuyển dụng</span>
							</a>
							<a href="{{route('ung-vien')}}" class="link" target="_blank">
								<i class="fa fa-briefcase user"></i>
								
								<span>Ứng viên</span>
							</a>
							<a href="{{route('company')}}" class="link" target="_blank">
								<i class="fa fa-home"></i>
								<span>Công ty</span>
							</a>
							<a href="{{URL::to('logout')}}" class="link">
								<i class="far fa-share-square"></i>
								<span>Thoát</span>
							</a>
						</nav>
					</header>
					@yield('content_trang_ca_nhan')
					@yield('content_index')
					@yield('content_updateInfo')
					@yield('content_infoProfile')
					@yield('content_skill')
					@yield('content_jobs_save')
					@yield('content_jobs_apply')
					@yield('content_change_pass')
					
				</div>
			</div>
		</div>
	
	</div>
	
	
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="js/jquery.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

	<script src='https://kit.fontawesome.com/a076d05399.js'></script>

	<!-- style js -->
	<script src="{{asset('frontend/js/style.js')}}"></script>

	<!-- library js -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<script>
		$(document).ready(function(){
		  $("#item_click").click(function(){
		    $("#contact_con").slideToggle("slow");
		  });
		});

	</script>
</body>
</html>