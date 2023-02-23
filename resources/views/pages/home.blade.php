@extends('layout_user')
@section('content_home')
<main>
	<section>
		<div class="slide_banner">
			<div class="owl-carousel owl-theme">
				<div class="item">
					<img src="{{asset("frontend/images/slides/01.jpg")}}" alt="slide">
				</div>
				<div class="item">
					<img src="{{asset("frontend/images/slides/02.jpg")}}" alt="slide">
				</div>
				<div class="item">
					<img src="{{asset("frontend/images/slides/03.jpg")}}" alt="slide">
				</div>
				<div class="item">
					<img src="{{asset("frontend/images/slides/04.jpg")}}" alt="slide">
				</div>
			</div>
			<div class="container form_search">
				<div class="row">
					<h2 class="col-md-12">Tìm kiếm công việc mơ ước</h2>
				</div>
				@include('pages.search')
			</div>

		</div>
	</section>
	<section>
		<div class="company pb-30">
			<div class="container">
				<div class="row">
					<h2 class="col-md-12 text-center title pd-30">Các Công Ty Hàng Đầu</h2>
				</div>
				<div class="row">
					@if(isset($company_large))
							@foreach($company_large as $value)
								<div class="col-md-4 col-lg-3 col-xl-2 text-center mb-20">
									<a href="
									{{route('detail_company',[$value['id'], str_replace([' ', '/'], ['-', '-'], $value['name_company']) ])
									}}.html
								">
										<div class="item">
											<img src="{{$value['logo']}}" alt="vnpt">
										</div>
									</a>
									<a href="
										{{route('detail_company',[$value['id'], str_replace([' ', '/'], ['-', '-'], $value['name_company']) ])
									}}.html
									">
										<strong>
											{{$value['name_company']}}
										</strong>
									</a>
								</div>
							@endforeach
						@endif
					
				</div>
			</div>
		</div>
	</section>
	<section>
		<div class="slide_works">
			<div class="container">
				<div class="row">
					<h2 class="col-md-12 text-center title pt-50">
						Việc Làm Hấp Dẫn
					</h2>
				</div>
				<div class="row">
					<div class="owl-carousel owl-theme">
						@if(isset($jobs_salary_high))
									<?php $data = $jobs_salary_high->chunk(10) ?>
									@foreach($data as $item)
						<div class="item">
							@foreach($item as $value)
								<div class="col-md-6">
									<a href="
									{{
										route('detailJob', [$value['id'], str_replace([' ', '/'], ['-', '-'], $value['name'])])
									}}.html
									" class="item_work">
										<div class="logo_cty">
											<img src="{{$value['logo']}}" alt="navigos">
										</div>
										<div class="text">
											<strong> {{$value['name']}} </strong>
											<p>{{$value['name_company']}} {{-- <span>{{$value['city_id']}}</span> --}}</p>
										</div>
									</a>
								</div>
							@endforeach	
						</div>  
							@endforeach
						@endif
							
						
	
						<!-- end item owl -->
					</div>
				</div>
				
			</div>

		</div>
	</section>
	<section>
		<div class="worksByCity pt-30">
			<div class="container">
				<div class="row">
					<h2 class="col-md-12 text-center title pd-30">
						<strong>Tìm Việc Làm Theo Tỉnh Thành</strong>
					</h2>
				</div>
				<div class="row pd-30 justify-content-center">
					<div class="col text-center">
						<ul class="contact">
							@if(isset($cities))
								@foreach($cities as $value) 
									<li class="item">
										<a href="
										{{route('dia-diem', [$value['id'], str_replace(' ', '-', $value['name_cities'])])
										}}
										
										" class="link">
											<strong>Việc làm tại {{$value['name_cities']}}</strong>
										</a>
									</li>
								@endforeach
							@endif
						</ul>
					</div>
					
				</div>
				<!-- end - row -->
			</div>
		</div>
	</section>
	<section>
		<div class="cam_nang">
			<div class="container">
				<div class="row">
					<h2 class="pd-30 text-center col-md-12">
						Cẩm Nang Nghề Nghiệp
					</h2>
				</div>
				<div class="row justify-content-center pb-20">
					<div class="col-md-10">
						<div class="row justify-content-center">
							<div class="col-lg-4 col-md-6 mb-20 ">
								<a href="#" class="card_item">
									<div class="card">
										<img src="{{asset("frontend/images/nguoi-ta-hoc-tu-thanh-cong-con-toi-hoc-tu-that-bai-280x186.jpg")}}" class="card-img-top" alt="nguoi-ta-hoc-tu-thanh-cong-con-toi-hoc-tu-that-bai-280x186.jpg">
										<div class="card-body">
											<strong>Người ta học từ thành công, còn tôi học từ thất bại</strong>
											<p class="card-text">Sự thất bại không đồng nghĩa với việc bạn sẽ không có...</p>
										</div>
									</div>
								</a>
							</div>
							<div class="col-lg-4 col-md-6 mb-20">
								<a href="#" class="card_item" >
									<div class="card">
										<img src="{{asset("frontend/images/12-280x186.jpg")}}" class="card-img-top" alt="12-280x186.jpg">
										<div class="card-body">
											<strong>Tôi phải làm thế nào khi đồng nghiệp đố kị?</strong>
											<p class="card-text">Tôi thường nghe nói, làm việc nơi công sở chỉ có bè chứ không...</p>
										</div>
									</div>
								</a>
							</div>
							<div class="col-lg-4 col-md-6 mb-20">
								<a href="#" class="card_item">
									<div class="card">
										<img src="{{asset("frontend/images/1-4-280x186.png")}}" class="card-img-top" alt="1-4-280x186.png">
										<div class="card-body">
											<strong>Sở hữu CV chuyên nghiệp với tính năng trang trí CV trên...</strong>
											<p class="card-text">CV được ví là “vũ khí” sắc bén để bạn có thể cạnh tranh...</p>
										</div>
									</div>
								</a>
							</div>
						</div>
					</div>
					<a href="#" class="link_camnang mt-30">
						<i class="fas fa-angle-double-right	"></i>
						<strong>ĐẾN TRANG CẨM NANG NGHỀ NGHIỆP</strong>
					</a>
				</div>

			</div>
		</div>
	</section>
	<section>
		<div class="box_index pd-30">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-4 col-md-6 text_count text-center">
						<strong class="title">
							Ứng Viên
						</strong>
						@if(isset($users))
							<h2>{{ count($users) }}</h2>
						@endif
						
					</div>
					<div class="col-lg-4 col-md-6 text_count text-center">
						<strong class="title">
							Việc Làm
						</strong>
						@if(isset($users))
							<h2>{{ count($jobs) }}</h2>
						@endif
					</div>
					<div class="col-lg-4 col-md-6 text_count text-center">
						<strong class="title">
							Nhà Tuyển Dụng
						</strong>
						@if(isset($users))
							<h2>{{ count($employers) }}</h2>
						@endif
					</div>
				</div>
			</div>
		</div>
	</section>
</main>

@endsection