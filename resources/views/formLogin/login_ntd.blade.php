<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Đăng nhập</title>
	<!-- library -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<link rel="stylesheet" href={{asset("frontend/css/dang-nhap.css")}}>
</head>
<body>
	<?php 
		$message_err = Session::get('message_err'); 
		$message_success = Session::get('message_success'); 
	?>
	
	<div id="wrapper">
		<div class="container">
			 @if(isset($message_err))
			 	<div class="row">
		                <div class="col-md-12 text-right">
		                    <div class="notify">
		                        <div class="alert alert-danger alert-dismissible nofication" role="alert">
		                            <strong>{{$message_err}}</strong>
		                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                                <span aria-hidden="true">&times;</span>
		                                <span class="sr-only">Close</span>
		                            </button>
		                        </div>
		                    </div>
		                </div>
		            </div>

		            {{Session::put('message_err', null)}}
			 @endif
			 @if(isset($message_success))
				<div class="row">
					<div class="col-md-12 text-right">
						<div class="notify">
							<div class="alert alert-info alert-dismissible nofication" role="alert">
								<strong>{{$message_success}}</strong>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									<span class="sr-only">Close</span>
								</button>
							</div>
						</div>
					</div>
				</div>
			{{Session::put('message_success', null)}}
			@endif
			<div class="row">
				<div class="col-lg-6 box-img">
					<h1><strong>Nhà Tuyển Dụng</strong> </h1>
					<p>Form đăng nhập dành cho nhà tuyển dụng </p>
				</div>
				<div class="col-lg-6 formRight">
					<form action="{{url('login_ntd')}}" method="post"> 
						
						
						<div class="form-group">
							<label for="email">
								<i class="fa fa-envelope"></i>
								<strong>Email</strong>
							</label>
							<input type="text" class="form-control" name="email" id="email">
							@if($errors->has('email'))
								<p style="color: red; font-size: 14px">
									{{$errors->first('email')}}
								</p>
							@endif
						</div>
						<div class="form-group">
							<label for="pass"> <i class="fa fa-lock"></i><strong>Password</strong></label>
							<input type="password" name="password" class="form-control" id="pass">
							@if($errors->has('password'))
								<p style="color: red; font-size: 14px">
									{{$errors->first('password')}}
								</p>
							@endif
						</div>
						<input type="submit" class="btn btn-primary" value="Đăng nhập">
					{!! csrf_field() !!}
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