<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Đăng ký</title>
	<!-- library -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<link rel="stylesheet" href={{asset("frontend/css/dang-ky.css")}}>
</head>
<body>

	<?php

		$message_email = Session::get('message_email');
		$message_pass = Session::get('message_pass');

	 ?>
	<div id="wrapper">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 box-img">
					<h1><strong>Nhà Tuyển Dụng</strong> </h1>
					<p>Form đăng ký dành cho nhà tuyển dụng</p>
				</div>
				<div class="col-lg-6 formRight">
					<form action="{{route('register_ntd')}}" method="post">
						<div class="form-group">
							<label for="name">
								<i class="fa fa-user"></i>
								<strong>Họ tên</strong>
							</label>
							<input type="text" class="form-control" name="name_employer" id="name" required>
						</div>
						  <div class="form-group">
						    <label for="email"><i class="fa fa-envelope"></i><strong>Email</strong></label>
						    <input type="email" class="form-control" id="email" name="email" />
						    @if($errors->has('email'))
								<p style="color: red; font-size: 14px">
									{{$errors->first('email')}}
								</p>
							@endif
							@if(isset($message_email))
								<p style="color: red; font-size: 14px">
									{{$message_email}}
									{{Session::put('message_email', null)}}
								</p>
							@endif
					  </div>

					  
					  <div class="form-group">
					    <label for="sdt"><i class="fa fa-phone"></i> <strong>Điện Thoại</strong></label>
					    <input type="text" class="form-control" id="sdt"  name="tel" max="11" required placeholder="VD:08972637817" />
					     @if($errors->has('tel'))
								<p style="color: red; font-size: 14px">
									{{$errors->first('tel')}}
								</p>
							@endif
					  </div>
					   <div class="form-group">
						    <label for="email"><i class="fa fa-user-secret"></i><strong>Tên Công Ty</strong></label>
						    <input type="" class="form-control" id="" name="name_company" required />

					  </div>
					  <div class="form-group">
					    <label for="address"> <i class="fa fa-map-marker"></i><strong>Địa Chỉ</strong></label>
				    	<select name="cities" id="" required>
				    		<option value="" selected >Chọn địa điểm</option>
				    		@if(isset($cities))
				    			@foreach($cities as $value)
				    				<option value="{{$value['id']}}">{{$value['name_cities']}}</option>
				    			@endforeach
				    		@endif
					    </select>
					  </div>
					   
					  <div class="form-row">
					    <div class="form-group col-md-6">
					      <label for="pass"> <i class="fa fa-lock"></i><strong>Mật Khẩu</strong></label>
					      <input type="password" class="form-control" id="pass" name="password" />
					       @if($errors->has('password'))
								<p style="color: red; font-size: 14px">
									{{$errors->first('password')}}
								</p>
							@endif
					    </div>
					    <div class="form-group col-md-6">
					      <label for="confirm_pass"><i class="fa fa-lock"></i> <strong>Xác Nhận Mật Khẩu</strong></label>
					      <input type="password" class="form-control" id="confirm_pass" name="confirm_pass" />
					     
					      @if(isset($message_pass))
								<p style="color: red; font-size: 14px">
									{{$message_pass}}
									{{Session::put('message_pass', null)}}
								</p>
							@endif
					    </div>
					  </div>
					 
					  <button type="submit" class="btn btn-primary" >Đăng Ký</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>