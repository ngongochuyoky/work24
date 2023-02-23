
	<?php 
	   $user_name = Session::get('user_name');

	   function checkLogin($user_name) {
	   		if($user_name === null) { 
				return Redirect::to('login_ntv');
			 }
	   }
	   checkLogin($user_name);

	 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Quản lý</title>
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
    		background: #2f3b4c !important;
    		overflow-x: hidden;
    		height: 100vh;
		}
		.contentLeft .info h4.name {
			color: white;
		}
	</style>
</head>
<body>
	<?php $user_name = Session::get('user_name'); ?>
	<div id="wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-3 contentLeft">
					<div class="logo"></div>
					<div class="info">
						<div class="avatar">
							<img src="{{asset('frontend/images/no-logo.png')}}" alt="avatar" style="height: 150px;">
						</div>
						@if(isset($user_name))
							<h4 class="name">{{$user_name}}</h4>
						@endif
					</div>
					<div class="menu">
						<ul class="contact">
							<li class="item <?php if(isset($active1)) {echo $active1; } ?>">
								<a href="{{URL::to('nha-tuyen-dung')}}">
									<i class="fa fa-cubes"></i>
									<span>Quản lý chung</span>
								</a>
							</li>
							
							<li id="item_click">
								<i class="fa fa-flash"></i>
								<span>Tuyển dụng</span>
								<ul id="contact_con">
									<li class="item <?php if(isset($active3)) {echo $active3; } ?>">
										<a href="{{route('postJob')}}">Đăng tuyển dụng mới</a>
									</li>
									<li class="item <?php if(isset($active4)) {echo $active4; } ?>">
										<a href="{{route('allPost')}}">Tất cả tuyển dụng</a>
									</li>
								</ul>
							</li>
							<li id="item_click1">
								<i class="fa fa-address-book"></i>
								<span>Quản lý hồ sơ</span>
								<ul id="contact_con1">
									<li class="item <?php if(isset($active5)) {echo $active5; } ?>">
										<a href="{{route('all_profile_save')}}">Hồ sơ đã lưu</a>
									</li>
									<li class="item <?php if(isset($active6)) {echo $active6; } ?>">
										<a href="{{route('profile_apply')}}">Hồ sơ ứng tuyển</a>
									</li>
								</ul>
							</li>
							<li id="item_click2">
								<i class="fa fa-info-circle"></i>
								<span>Thông tin công ty</span>
								<ul id="contact_con2">
									<li class="item <?php if(isset($active5)) {echo $active5; } ?>">
										<a href="{{route('updateCompany')}}">Cập nhật thông tin</a>
									</li>
									<li class="item <?php if(isset($active6)) {echo $active6; } ?>">
										<a href="{{route('get_change_pass_employer')}}">Đổi mật khẩu</a>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-9">
					<header>
						<div class="lien-he">
							<p>	Chuyên viên hỗ trợ, tư vấn dành cho nhà tuyển dụng.</p>
						<p><strong>Ngô Ngọc Huy </strong> <i class="fa fa-phone ml-3"></i> <strong class="mr-3">0972 198 526</strong> <i class="fa fa-envelope"></i> <strong> huyhuy@gmail</strong></p>
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
							<a href="{{URL::to('logout')}}" class="link">
								<i class="far fa-share-square"></i>
								<span>Thoát</span>
							</a>
						</nav>
					</header>
					@yield('contentHome')
					@yield('content_postJob')
					@yield('content_allPost')
					@yield('content_editPostJob')
					@yield('content_updateCompany')
					@yield('content_profile_save')
					@yield('content_profile_apply')
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

		$(document).ready(function(){
		  $("#item_click1").click(function(){
		    $("#contact_con1").slideToggle("slow");
		  });
		});

		$(document).ready(function(){
		  $("#item_click2").click(function(){
		    $("#contact_con2").slideToggle("slow");
		  });
		});


	</script>
</body>
</html>