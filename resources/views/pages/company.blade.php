@extends('layout_user')
@section('content_company')
<style>
	.form_search {
		background: #000000;
		padding: 20px 0;
	}
	.form_search .container{

	   
	}
	.avtar_company {
		height: 250px;
		display: flex;
		align-items: center;
		justify-content: center;
	}
	.form_search .container form{
	}
	.form_search .container form .input_search{
		position: relative;
	    display: flex;
	    align-items: center;
	}
	.form_search .container form .input_search input {
		font-size: 14px;
		padding: 10px;
	}
	.form_search .container form .input_search i {
		position: absolute;
	    right: 30px;
	    color: #999;
	}
	.form_search .container form .button{}

	.list_company {}
	.list_company .card {
		cursor: pointer;
		transition: .3s ease-in-out;
		position: relative;
		margin-bottom: 30px;
	}
	.list_company .card a {
		position: absolute;
	    top: 50%;
	    left: -100px;
	    transition: .3s ease-in-out;
	    transform: translate(-50%, -50%);
	    background: #4a7fb5;
	    border-color: #4a7fb5;
	    opacity: 0;
	    visibility: hidden;
	}
	.list_company .card:hover {
		box-shadow: -2px 3px 11px 0px #00000078;
	}
	.list_company .card:hover a {
		left: 50%;
		opacity: 1;
		visibility: visible;
	}
	.list_company .card:hover .card-block h4.card-title {
		 box-shadow: 0 2px 5px black;
	}
	.list_company .card .card-block h4.card-title{
		font-size: 13px;
	    text-align: center;
	    background: tomato;
	    color: white;
	    padding: 10px;
	    border-radius: 40px 0;
	    transition: .3s ease-in-out;
	    height: 50px;
	    display: flex;
	    align-items: center;
	    justify-content: center;
	   
	}

	.list_company h2.notfound {
    font-size: 18px;
    margin-bottom: 30px;
}

</style>
	<main>
		<section class="form_search">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<form action="{{route('searchCompany')}}" method="post">
							<div class="row">
								<div class="input_search col-md-10">
									<i class="fa fa-search"></i>
									<input type="text" placeholder="Nhập tên công ty muốn tìm..." name="name_company"
									value="<?php if(isset($name_company)) {echo $name_company;}else {echo '';}?>" class="form-control" 
									>
								</div>
								<button type="submit" class="btn btn-info col-md-2">
									Tìm kiếm
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
		<section class="list_company">
			<div class="container">
				<div class="row">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
					    <li class="breadcrumb-item"><a href="{{route('/')}}">Home</a></li>
					    <li class="breadcrumb-item active" aria-current="page">Danh sách công ty</li>
					  </ol>
					</nav>
				</div>
			</div>
			<div class="container">
				<div class="row">
					@if(isset($company) && count($company) > 0)
						@foreach($company as $value)
							<div class="col-md-3">
								<div class="card">
									<div class="avtar_company">
										@if(isset($value['logo']) && $value['logo'] !== '')
											<img src="{{$value['logo']}}" alt="" class="card-img-top" style="height: 150px; width: 150px">
											@else
												<img src="{{asset('frontend/images/no-logo.png')}}" alt="" class="card-img-top" style="height: auto">
										@endif
									</div>
									<div class="card-block">
										<h4 class="card-title">{{$value['name_company']}}</h4>
										
										
									</div>
									<a href="{{route('detail_company',[$value['id'], str_replace([' ', '/'], ['-', '-'], $value['name_company']) ])}}.html" class="btn btn-primary">Xem chi tiết</a>
								</div>
							</div>
						@endforeach
						@else 
							<h2 class="notfound">Không tìm thấy kết quả phù hợp</h2>
					@endif
				</div>
			</div>
		</section>
	</main>
@endsection