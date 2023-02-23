@extends('layout_user')
@section('content_profile')
<style>
	#wrapper {
		height: 100vh;
	    scroll-behavior: smooth;
	    overflow-y: scroll;
	}
	.profile {}
	.profile .content {
		background: white;
	    border-radius: 5px;
	    position: relative;
	    padding-bottom: 30px;
	}
	.profile .content .logo {
		position: absolute;
		border-radius: 50%;
		top: 20px;
		left: 30px;

	}
	.profile .content .logo img {
		width: 100%;
		border-radius: 50%;
	}
	.profile .content .header_top {
		padding: 20px;
	    background: #639c7c;
	    color: white;
	    padding-left: 200px;
	    border-radius: 5px 5px 0 0;

	}
	.profile .content .header_top h2 {
		font-size: 24px;
	    margin-bottom: 0;
	    margin-top: 10px;
	}
	.profile .content .header_top p {
		color: #ffb100;
	}
	.profile .content .header_bottom {
	    display: flex;
	    justify-content: space-between;
	    padding: 20px 40px 20px 200px;
	    font-size: 14px;
	}
	.profile .content .header_bottom i {
    color: #2d92ce;
    margin-right: 10px;
    margin-bottom: 10px;
    font-size: 15px;
}
	.profile .save_profile{
		padding:30px;
	}
	.info_profile h3.title {
		overflow: hidden;
	    margin: 0 20px;
	    padding: 20px 0;
	}
	.info_profile h3.title i {
		font-size: 14px;
	    background: seagreen;
	    width: 30px;
	    height: 30px;
	    text-align: center;
	    line-height: 30px;
	    border-radius: 20px;
	    color: white;
	}
	.info_profile h3.title span {
		font-size: 18px;
    	font-weight: 600;
    	position: relative;
	}
	.info_profile h3.title span:after {
		content: '';
	    position: absolute;
	    top: 8px;
	    right: -615px;
	    display: block;
	    background: #bfb8b8;
	    width: 600px;
	    height: 4px;
	    border-radius: 5px;

	}
	.info_profile ul {
		padding-left: 20px;
		font-size: 14px;
	}
	.info_profile ul li {
		line-height: 25px;
	}
	.profile .lien-he {
	    font-size: 14px;
	    background: white;
	    margin: 30px 0;
	    padding: 20px;
	}
	.profile .lien-he p {
	    line-height: 30px;
	}
	.profile .h3_title {
		font-size: 18px; 
		padding-bottom: 10px; 
		border-bottom: 1px solid #ececec;
	}
	.profile .ung_vien_moi {
		background: white;
		border-radius: 5px;
	}
	.profile .ung_vien_moi .item_card {
		display: flex;
		margin-top: 20px;
		border-bottom: 1px dashed #ececec;
		padding-bottom: 20px;
	}
	.profile .ung_vien_moi .item_card .avatar {
		display: flex;
	    justify-content: center;
	    align-items: center;
	}
	.profile .ung_vien_moi .item_card .avatar img{
		width: 70%;
	    border: 1px solid #dacfcf;
	    border-radius: 5px;
	}
	.profile .ung_vien_moi .item_card .box-text {
		font-size: 14px;
	}
	.profile .ung_vien_moi .item_card .box-text strong {}

</style>
	<main>
		<?php 
			$id_user = Session::get('id_user');
			$roles = Session::get('roles');

		 ?>
		@if(isset($data_profile) && count($data_profile) > 0)
			@foreach($data_profile as $value)
			<div class="container">
				<nav aria-label="breadcrumb" class="p-0">
				  <ol class="breadcrumb" style="background: transparent; margin-bottom: 0">
				    <li class="breadcrumb-item"><a href="#">Trang chủ </a></li>
				    <li class="breadcrumb-item"><a href="#">Danh sách ứng viên </a></li>
				    <li class="breadcrumb-item active" aria-current="page">{{$value['name_position']}}</li>
				  </ol>
				</nav>
			</div>
			<div class="container">
				<div class="profile">
					<div class="row">
						<div class="col-md-9">
							<div class="content">
								<div class="logo">
									<img src="{{$value['avatar']}}" alt="" style="width: 150px; height: 150px;" >
								</div>
								<div class="header_top">
									<h2>{{$value['name']}}</h2>
									<p>{{$value['name_position']}}</p>
								</div>
								<div class="header_bottom">
									<div class="content_left">
										<p><i class="fa fa-birthday-cake"></i><span>{{$value['birthday']}}</span></p>
										<p><i class="fa fa-map-marker"></i><span>{{$value['address']}}</span></p>
									</div>
									<div class="content_right">
										<p><i class="fa fa-mars"></i><span>{{$value['gender']}}</span></p>
										<p><i class="fa fa-venus"></i><span>{{$value['marital_status']}}</span></p>
									</div>
								</div>
								@if($id_user === null && $roles !== null)
									<div class="save_profile">
										@if(isset($profile_save) && count($profile_save) > 0)
											@foreach($profile_save as $item)
												@if($item['status'] === 1)
													<a href="{{route('profile_save',[$value['id_info_profile']])}}" class="btn btn-info">
														<i class="fa fa-heart"></i> <span>Bỏ Lưu hồ sơ</span>
													</a>
												@else
													<a href="{{route('profile_save',[$value['id_info_profile']])}}" class="btn btn-outline-info">
														<i class="fa fa-heart"></i><span> Lưu hồ sơ</span>
													</a>
												@endif
											@endforeach
											
											@else
											<a href="{{route('profile_save',[$value['id_info_profile']])}}" class="btn btn-outline-info">
												<i class="fa fa-heart"></i><span> Lưu hồ sơ</span>
											</a>
										@endif
										<a href="#lien_he" class="btn btn-warning" style="color: white">
											Xem liên hệ
										</a>
									</div>
								@endif
								<div class="info_profile">
									<h3 class="title">
										<i class="fa fa-user"></i>
										<span>Thông tin hồ sơ</span>
									</h3>
									<div class="row">
										<div class="col-md-7">
											<ul>
												<li><strong>Ngành nghề: </strong><span>{{$value['name_category']}}</span></li>
												<li><strong>Trình độ học vấn: </strong>{{$value['name_degree']}}</li>
												<li><strong>Loại hình công việc: </strong>{{$value['name_form_of_work']}}</li>
												<li><strong>Cấp bậc mong muốn: </strong>{{$value['name_chuc_vu']}}</li>
												
											</ul>
										</div>
										<div class="col-md-5">
											<ul>
												<li><strong>Nơi làm việc: </strong><span>{{$value['name_cities']}}</span></li>
												<li><strong>Ngày cập nhật: </strong><span>{{$value['created_at']}}</span></li>
												<li><strong>Mức lương mong muốn:: </strong><span style="color: red">{{$value['salary_min'] . '-'. $value['salary_max']}} triệu</span></li>
												<li><strong>Số năm kinh nghiệm: </strong><span style="color: red">{{$value['name_experience']}}</span></li>
											</ul>
										</div>
									</div>
									<h3 class="title">
										<i class="fa fa-trophy"></i>
										<span>Mục tiêu nghề nghiệp</span>
									</h3>
									<div class="row">
										<div class="col-md-12">
											<?php
												$arr_muctieu = explode('@', $value['description']);
											 ?>
											  @foreach($arr_muctieu as $i)
											  	<p class="text pl-4 pr-4" style="font-size: 14px; line-height: 28px;">{{$i}}</p>
											 @endforeach 
											
										</div>
									</div>
									<h3 class="title">
										<i class="fa fa-bolt"></i>
										<span>Kỹ Năng Bản Thân</span>
									</h3>
									<div class="row">
										<div class="col-md-12">
											<p class="text pl-4 pr-4" style="font-size: 14px;">
												{{$value['des_skill']}}
											</p>
											<?php $arr_skill = explode('@', $value['name_skill']) ?>

											@foreach($arr_skill as $sk)
												<p class="text pl-4 pr-4" style="font-size: 14px; line-height: 28px;">{{$sk}}</p>
											@endforeach
										</div>
									</div>
								</div>
							</div>
							<div class="lien-he" id="lien_he">
								<h3 class="h3_title" >Thông tin liên hệ</h3>
								<p><strong>Họ tên: </strong><span>{{$value['name']}}</span></p>
								<p><strong>Email: </strong><span>{{$value['email']}}</span></p>
								@if($value['tel'] !== null)
								<p><strong>Số điện thoại: </strong><span>{{$value['tel']}}</span></p>
								@endif
								<p><strong>Địa chỉ: </strong><span>{{$value['address']}}.</span></p>
							</div>
						</div>
						<div class="col-md-3  p-0">
							<div class="ung_vien_moi">
								<h3 class="h3_title pt-3 pl-3">
									Hồ sơ ứng viên mới
								</h3>
								@if(isset($data_profile_new) && count($data_profile_new) > 0)
									@foreach($data_profile_new as $value) 
										<div class="item_card">
											<div class="avatar" style="width: 40%">
												<img src="{{$value['avatar']}}" alt="">
											</div>
											<div class="box-text">
												<strong>
													<a href="{{route('profile', [$value['id_info_profile'], str_replace([' ', '/'], ['-', '-'], $value['name_position'])])
                                                     }}.html">
													{{$value['name_position']}}</a>
												</strong>
												<p style="color: black">{{$value['name']}}</p>
												<p><span style="color: #999">kinh nghiệm: </span><span style="color: red">{{$value['name_experience']}}</span></p>
											</div>
										</div>
									@endforeach
								@endif
							</div>
								
						</div>
					</div>
				</div>
			</div>
		@endforeach
		@endif
	</main>
@endsection