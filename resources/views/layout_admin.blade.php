<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Tim Viec</title>
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
    		background: black
		}
	</style>
</head>
<body>
	<?php $id_admin = Session::get('id_admin'); ?>
	
	<div id="wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-3 contentLeft">
					<div class="logo"></div>
					<div class="info">
						<div class="avatar">
							<img src="{{asset('frontend/images/no-logo.png')}}" alt="avatar">
						</div>
						
						<h4 class="name" style="color: white">Ngô - Đỗ</h4>
					</div>
					<div class="menu">
						<ul class="contact">
							<li class="item <?php if(isset($active1)) {echo $active1; } ?>">
								<a href="{{URL::to('admin-work24')}}" >
									<i class="fa fa-cubes"></i>
									<span> Quản lý chung</span>
								</a>
							</li>
							<li class="item <?php if(isset($active2)) {echo $active2; } ?>">
								<a href="{{URL::to('admin-work24/all-job')}}" >
									<i class="fa fa-cubes"></i>
									<span> Quản lý việc làm</span>
								</a>
							</li>
							
							<li id="item_click">
								<i class="fa fa-asterisk"></i>
								<span>Quản lý ngành nghề</span>
								<ul id="contact_con">
									<li class="item <?php if(isset($active3)) {echo $active3; } ?>">
										<a href="{{route('allCategory')}}">Danh sách ngành nghề</a>
									</li>
									<li class="item <?php if(isset($active4)) {echo $active4; } ?>">
										<a href="{{route('addCategory')}}">Thêm ngành nghề</a>
									</li>
								</ul>
							</li>
							<li id="item_click_cv">
								<i class="fa fa-asterisk"></i>
								<span>Quản lý chức vụ</span>
								<ul id="contact_con_cv">
									<li class="item <?php if(isset($active3)) {echo $active3; } ?>">
										<a href="{{route('allChucVu')}}">Danh sách chức vụ</a>
									</li>
									<li class="item <?php if(isset($active4)) {echo $active4; } ?>">
										<a href="{{route('addChucVu')}}">Thêm chức vụ</a>
									</li>
								</ul>
							</li>
							<li id="item_click_tp">
								<i class="fa fa-asterisk"></i>
								<span>Quản lý thành phố</span>
								<ul id="contact_con_tp">
									<li class="item <?php if(isset($active3)) {echo $active3; } ?>">
										<a href="{{route('allCities')}}">Danh sách thành phố</a>
									</li>
									<li class="item <?php if(isset($active4)) {echo $active4; } ?>">
										<a href="{{route('addCities')}}">Thêm mới thành phố</a>
									</li>
								</ul>
							</li>
							<li id="item_click_bc">
								<i class="fa fa-asterisk"></i>
								<span>Quản lý bằng cấp</span>
								<ul id="contact_con_bc">
									<li class="item <?php if(isset($active3)) {echo $active3; } ?>">
										<a href="{{route('allDegree')}}">Danh sách bằng cấp</a>
									</li>
									<li class="item <?php if(isset($active4)) {echo $active4; } ?>">
										<a href="{{route('addDegree')}}">Thêm mới bằng cấp</a>
									</li>
								</ul>
							</li>
							<li id="item_click_htvl">
								<i class="fa fa-asterisk"></i>
								<span>Quản lý hình thức việc làm</span>
								<ul id="contact_con_htvl">
									<li class="item <?php if(isset($active3)) {echo $active3; } ?>">
										<a href="{{route('allFormOfWork')}}">Danh sách hình thức việc làm</a>
									</li>
									<li class="item <?php if(isset($active4)) {echo $active4; } ?>">
										<a href="{{route('addFormOfWork')}}">Thêm mới hình thức việc làm</a>
									</li>
								</ul>
							</li>
							<li id="item_click_qm">
								<i class="fa fa-asterisk"></i>
								<span>Quản lý quy mô</span>
								<ul id="contact_con_qm">
									<li class="item <?php if(isset($active3)) {echo $active3; } ?>">
										<a href="{{route('allQuyMo')}}">Danh sách quy mô</a>
									</li>
									<li class="item <?php if(isset($active4)) {echo $active4; } ?>">
										<a href="{{route('addQuyMo')}}">Thêm mới quy mô</a>
									</li>
								</ul>
							</li>
							<li id="item_click_l">
								<i class="fa fa-asterisk"></i>
								<span>Quản lý lương</span>
								<ul id="contact_con_l">
									<li class="item <?php if(isset($active3)) {echo $active3; } ?>">
										<a href="{{route('allSalary')}}">Danh sách lương</a>
									</li>
									<li class="item <?php if(isset($active4)) {echo $active4; } ?>">
										<a href="{{route('addSalary')}}">Thêm mới lương</a>
									</li>
								</ul>
							</li>

							<li id="item_click2">
								<i class="fa fa-group"></i>
								<span>Quản lý người dùng</span>
								<ul id="contact_con2">
									<li class="item <?php if(isset($active3)) {echo $active3; } ?>">
										<a href="{{route('allUser')}}">Quản lý người tìm việc</a>
									</li>
									<li class="item <?php if(isset($active4)) {echo $active4; } ?>">
										<a href="{{route('allEmployer')}}">Quản lý nhà tuyển dụng</a>
									</li>
								</ul>
							</li>

							<li class="item <?php if(isset($active5)) {echo $active5; } ?>">
								<a href="{{URL::to('doi-mat-khau-admin')}}">
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
							<p>Số điện thoại hỗ trợ, tư vấn</p>
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

					@yield('content_home')
					@yield('content_allUser')
					@yield('content_allEmployer')
					@yield('content_allCategory')
					@yield('content_addCategory')
					@yield('content_updateCategory')
					@yield('content_allChucVu')
					@yield('content_addChucVu')
					@yield('content_updateChucVu')
					@yield('content_cities')
					@yield('content_addCities')
					@yield('content_updateCities')
					@yield('content_allDegree')
					@yield('content_addDegree')
					@yield('content_updateDegree')
					@yield('content_addFormOfWork')
					@yield('content_allFormOfWork')
					@yield('content_updateFormOfWork')
					@yield('content_addQuyMo')
					@yield('content_allQuyMo')
					@yield('content_updateQuyMo')
					@yield('content_addSalary')
					@yield('content_allSalary')
					@yield('content_updateSalary')
					@yield('content_all_job')
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
		  $("#item_click2").click(function(){
		    $("#contact_con2").slideToggle("slow");
		  });
		});
		$(document).ready(function(){
		  $("#item_click_cv").click(function(){
		    $("#contact_con_cv").slideToggle("slow");
		  });
		});
		$(document).ready(function(){
		  $("#item_click_tp").click(function(){
		    $("#contact_con_tp").slideToggle("slow");
		  });
		});
		$(document).ready(function(){
		  $("#item_click_bc").click(function(){
		    $("#contact_con_bc").slideToggle("slow");
		  });
		});
		$(document).ready(function(){
		  $("#item_click_htvl").click(function(){
		    $("#contact_con_htvl").slideToggle("slow");
		  });
		});
		$(document).ready(function(){
		  $("#item_click_qm").click(function(){
		    $("#contact_con_qm").slideToggle("slow");
		  });
		});
		$(document).ready(function(){
		  $("#item_click_l").click(function(){
		    $("#contact_con_l").slideToggle("slow");
		  });
		});



	</script>
</body>
</html>