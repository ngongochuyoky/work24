@extends('layout_user')
@section('content_detailCompany')
	<main>
		@if(isset($company) && isset($arr_jobs_company))
			@foreach($company as $value)
				<section class="detail_company">
					<div class="container">
						<div class="row">
							<div class="col-md-9">
								<div class="contentLeft">
									<div class="j_logo">
										<img src="{{$value['logo']}}" alt="danko">
									</div>
									<div class="j_company">
										<h1>{{$value['name_company']}}</h1>
										<p>
											<i class="fa fa-map-marker"></i>
											<strong>Địa chỉ: </strong>
											<span> {{$value['address']}}</span>
										</p>
										<p>
											<i class="fas fa-users"></i>
											<strong>Số nhân viên: </strong>
											<span> {{$value['name_quy_mo']}}</span>
										</p>
										<p>
											<i class="fa fa-map-marker"></i>
											<strong> Website: </strong>
											<span> {{$value['website']}}</span>
										</p>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="jobs">
									<h1><strong>{{count($arr_jobs_company)}}</strong></h1> 
									<span>Việc làm</span>
								</div>
							</div>
						</div>
					</div>
				</section>
				<section class="company-container">
					<div class="container">
						<div class="row">
							<div class="col-md-8">
								<div class="introduce">
									<h4>Giới thiệu về xông ty</h4>
									<p class="text">{{$value['introduce']}}</p>
								</div>
							</div>

							<div class="col-md-4">
								<div class="tab-jobs">
									<h4>Chúng tôi đang tuyển dụng</h4>
									<p class="text">{{$value['name_company']}} đang tuyển dụng 
									{{count($arr_jobs_company)}} vị trí. Click để xem.</p>
									
									@foreach($arr_jobs_company as $item)
									<div class="jobs">
										<h5><strong><a href=" 
											{{
											route('detailJob', [$item['id'], str_replace([' ', '/'], ['-', '-'], $item['name'])])
										}}.html
										 ">
											{{$item['name']}}
										</a></strong></h5>
										<p class="cty">{{$item['name_company']}}</p>
										
										<div class="d-flex">
											<p class="item" style="color: tomato">
												<i class="fa fa-map-marker"></i>
												<span>{{$item['salary_min']}} triệu - {{$item['salary_max']}} triệu</span>
											</p>
											<p class="item">
												<i class="fa fa-map-marker"></i>
													<span>{{$item['date_expired']}}</span>
											</p>
											<p class="item">
												<i class="fa fa-map-marker"></i>
												@if(isset($arr_cities))
													@foreach($arr_cities as $item) 
														<span>{{$item}}</span>
													@endforeach
												@endif
											</p>
										</div>

									</div>

									@endforeach


								</div>
							</div>
						</div>
					</div>
				</section>
			@endforeach
		@endif
		</main>

@endsection