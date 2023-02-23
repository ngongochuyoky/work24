@extends('layout_dashboard')
@section('content_change_pass')
	<style>
		.change_pass {
			background: white;
		    padding: 50px;
		    margin-top: 30px;
		}
		.change_pass h2 {
			    font-size: 22px;
			    padding-bottom: 12px;
			    border-bottom: 3px solid #318cda;
			    margin-bottom: 40px;
		}
		.change_pass form {
			width: 50%;
		}
		.change_pass span {
			color: red;
		}
		.change_pass label {
			font-size: 15px;
    		font-weight: 500;
		}
		.change_pass p.err_s {
			font-size: 13px; 
			color: tomato; 
			margin-top: 5px;
		}
	</style>
	<main>
		<?php 
			$change_success = Session::get('change_success');
			$err_pass_new = Session::get('err_pass_new');
			$err_pass_old = Session::get('err_pass_old');
			$err_eight = Session::get('err_eight');
		 ?>
		 @if(isset($change_success))
			<div class="row">
				<div class="col-md-12 text-right">
					<div class="notify">
						<div class="alert alert-info alert-dismissible nofication" role="alert">
							<strong>{{$change_success}}</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								<span class="sr-only">Close</span>
							</button>
						</div>
					</div>
				</div>
			</div>
		{{Session::put('change_success', null)}}
		@endif
		<div class="container">
			<div class="change_pass">
				<div class="row">
					<h2>Đổi mật khẩu</h2>
				</div>
				<div class="row">
					<form action="{{route('change_pass')}}" method="post">
						<div class="form-group">
							<span>*</span>
						    <label for="">Mật khẩu cũ</label>
						    <input type="password" class="form-control" id="" name="pass_old" required>
						    <p class="err_s"><?php if(isset($err_pass_old)) {echo($err_pass_old); Session::put('err_pass_old', null);} ?></p>
						  </div>
						<div class="form-group">
						  	<span>*</span>
						    <label for="">Mật khẩu mới</label>
						    <input type="password" class="form-control" id="" name="pass_new" required>
						    <p class="err_s"><?php if(isset($err_eight)) {echo($err_eight); Session::put('err_eight', null);} ?></p>
						</div>
						<div class="form-group">
						  	<span>*</span>
						    <label for="">Nhập lại mật khẩu mới</label>
						    <input type="password" class="form-control" id="" name="again_pass_new" required>
						    <p class="err_s"><?php if(isset($err_pass_new)) {echo($err_pass_new); Session::put('err_pass_new', null);} ?></p>
						</div>
						<div class="form-group">
						  	<input type="submit" value="Đổi mật khẩu" class="btn btn-info">
						</div>
					</form>
				</div>
			</div>
		</div>
	</main>
@endsection