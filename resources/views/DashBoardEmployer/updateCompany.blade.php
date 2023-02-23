@extends('layout_dashboard_employers')
@section('content_updateCompany')
<style>
	.contentLeft {
		height: auto;
	}
	.form_update {
		  background: white;
	    margin: 20px;
	    padding: 20px 0;
	    border-radius: 5px;
	    border: 1px solid #eae5e5
	}
	.form_update h2 {
		font-size: 22px;
	    padding-left: 10px;
	    border-bottom: 1px solid #eae5e5
	    padding-bottom: 20px;
	    width: 100%;
	    margin-bottom: 20px;
	}
	.form_update .col-md-9 {
		background: white !important;
	}
	.form_update .logo {
		width: 165px;
    	margin: 0 auto;
    	border: 1px solid #eae5e5
	}
	.form_update .logo img {
		width: 100%;
	}
	.form_update .el-upload-file {
		display: none;
	}
	.form_update .clickUpload {
		cursor: pointer;
		color: green;
		margin-top: 10px;
	}
	.form_update .title-nhat {
		color: gray
	}
	.form_update .form-group label {
		font-weight: 500;
		font-size: 14px;
	}
	.form_update .form-group span {
		color: red;
	}
	.form_update textarea {
		font-size: 13px;
		padding: 10px;
		border-radius: 5px;
	}
</style>
<?php $updated = Session::get('updated'); ?> 
	<main>
		<nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cập nhật thông tin chung</li>
            </ol>
        </nav>
        @if(isset($updated))
	            <div class="row">
	                <div class="col-md-12 text-left">
	                    <div class="notify">
	                        <div class="alert alert-info alert-dismissible nofication" role="alert">
	                            <strong>{{$updated}}</strong>
	                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                                <span aria-hidden="true">&times;</span>
	                                <span class="sr-only">Close</span>
	                            </button>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        {{Session::put('updated', null)}}
	        @endif
        <section class="form_update">
        	<div class="container">
        		<div class="row">
        			<h2>THÔNG TIN CHUNG</h2>
        		</div>
        		{{-- // {{dd($data)}} --}}
        		<form action="{{route('postUpdateCompany')}}" enctype="multipart/form-data" method="post">
        			@if(isset($data) && count($data) > 0)
        				@foreach($data as $value)

        			<div class="row">
        			
        			<div class="col-md-9">
        				<div class="container">
        					<div class="row">
        					<div class="col-md-12">
	        					<p class="title-nhat">Thông tin tài khoản</p>
	        					<div class="form-group">
	        						<label for="">Địa chỉ email</label>
			        				<input type="text" readonly value="{{$value['email']}}" class="form-control">
	        					</div>
	        				</div>
							
							<div class="col-md-12">
								<p class="title-nhat">Thông tin công ty</p>
								<div class="form-group">
									<span>*</span>
									<label for="">Tên công ty</label>
									<input type="text" class="form-control" value="{{$value['name_company']}}" name="name_company" required>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<span>*</span>
									<label for="">Địa chỉ công ty</label>
									<input type="text" class="form-control" value="{{$value['address']}}" name="address" required>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<span>*</span>
									<label for="">Tỉnh/Thành phố</label>
									<select class="form-control" id="" name="id_cities" required>
                                            <option value="{{$value['id_cities']}}" selected data-default>
                                            {{$name_cities[0]['name_cities']}}</option>
                                           @if(isset($cities))
                                                @foreach($cities as $item)
                                                    <option value="{{$item['id']}}">{{$item['name_cities']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<span>*</span>
									<label for="">Quy mô</label>
									<select class="form-control" id="" name="id_quy_mo" required>
                                            <option value="{{$value['id_quy_mo']}}" selected data-default>{{$value['name_quy_mo']}}</option>
                                           @if(isset($quy_mo))
                                                @foreach($quy_mo as $item)
                                                    <option value="{{$item['id']}}">{{$item['name_quy_mo']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<span>*</span>
									<label for="">Website</label>
									<input type="text" class="form-control" value="{{$value['website']}}" name="website" required>
								</div>
							</div>
							
	        			</div>
        				</div>
	        			
        			</div>
        			<div class="col-md-3">
        				<div class="form-group text-center">
        					<p>logo công ty</p>
        					<div class="logo">
        						@if(isset($value['logo']) && $value['logo'] !== '')
        							<img src="{{$value['logo']}}" alt="">
        						@else 
        							<img src="{{asset('frontend/images/no-logo.png')}}" alt="">
        						@endif
        						
        					</div>
        					<input type="file" value="{{$value['logo']}}" id="file" name="logo" class="el-upload-file" >
        					<label for="file" class="clickUpload"><i class="fa fa-upload"></i>Thay logo công ty</label>
        				</div>
        			</div>
        		</div>
        		<div class="row">
        			<div class="col-md-12">
							<div class="form-group">
								<span>*</span>
								<label for="">Mô tả sơ lược về công ty</label>
								<textarea id="" cols="30" style="width: 100%" rows="10" name="introduce" required>{{$value['introduce']}}</textarea>
							</div>
						</div>
						
						
						<div class="col-md-6">
							<div class="form-group">
								<span>*</span>
								<label for="">Người liên hệ</label>
								<input type="text" class="form-control" value="{{$value['name_employer']}}" name="name_employer" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<span>*</span>
								<label for="">Số điện thoại liên hệ</label>
								<input required type="text" class="form-control" value="<?php if($value['tel_employer'] !== 'undefined') {echo $value['tel_employer'];}else {echo '';} ?>" name="tel_employer">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<span>*</span>
								<label for="">Email liên hệ</label>
								<input required type="text" class="form-control" value="<?php if($value['email_employer'] !== 'undefined') {echo $value['email_employer'];}else {echo '';} ?>" name="email_employer">
							</div>
						</div>
        		</div>
        		<input type="submit" value="Cập nhật thông tin" class="btn btn-info">
        		{!!  csrf_field() !!}
        		</form>
        		@endforeach
        			@endif
        	</div>
        </section>
	</main>
@endsection