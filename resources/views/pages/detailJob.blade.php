@extends('layout_user')
@section('content_job')
	<main>
		<?php $id_employer = Session::get('id_employer');
			$id_user = Session::get('id_user');
			$roles = Session::get('roles');
			$apply_sc = Session::get('apply_sc');
			$apply_tt = Session::get('apply_tt');
			$profile_r = Session::get('profile_r');
		 ?>
	 	 @if(isset($profile_r))
		 	<div class="row">
	                <div class="col-md-12 text-right">
	                    <div class="notify">
	                        <div class="alert alert-warning alert-dismissible nofication" role="alert">
	                            <strong>{{$profile_r}}</strong>
	                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                                <span aria-hidden="true">&times;</span>
	                                <span class="sr-only">Close</span>
	                            </button>
	                        </div>
	                    </div>
	                </div>
	            </div>

	            {{Session::put('profile_r', null)}}
		 @endif
		 @if(isset($apply_sc))
			 	<div class="row">
		                <div class="col-md-12 text-right">
		                    <div class="notify">
		                        <div class="alert alert-info alert-dismissible nofication" role="alert">
		                            <strong>{{$apply_sc}}</strong>
		                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                                <span aria-hidden="true">&times;</span>
		                                <span class="sr-only">Close</span>
		                            </button>
		                        </div>
		                    </div>
		                </div>
		            </div>

		            {{Session::put('apply_sc', null)}}
			 @endif
			 @if(isset($apply_tt))
			 	<div class="row">
		                <div class="col-md-12 text-right">
		                    <div class="notify">
		                        <div class="alert alert-warning alert-dismissible nofication" role="alert">
		                            <strong>{{$apply_tt}}</strong>
		                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                                <span aria-hidden="true">&times;</span>
		                                <span class="sr-only">Close</span>
		                            </button>
		                        </div>
		                    </div>
		                </div>
		            </div>

		            {{Session::put('apply_tt', null)}}
			 @endif
		@if(isset($data))
			{{-- {{dd($data)}} --}}
			@foreach($data as $value)
				<section class="banner_bg_cty">
				</section>
				<section class="info_cty">
					<div class="container">

						<div class="row">
							<div class="col-md-12 content_info">
								<div class="logo_cty">
									<a href="#">
										<img src="{{$value['logo']}}" alt="navigos">
									</a>
								</div>
								<div class="text pt-20 pb-20 pl-30 pr-30">
									<div class="title">
										<h2 class="mr0">
											{{$value['name']}}
										</h2>
										<p>
											<a href="{{route('detail_company', [$value['id_employer'], str_replace([' ', '/'], ['-', '-'], $value['name_company'])])}}">
												{{$value['name_company']}}
											</a> - 
											@if(isset($arr_cities))
												@foreach($arr_cities as $item)
													<span>{{$item}}</span>
												@endforeach
											@endif
											
										</p>
										<p class="count_view mt-10">
											{{-- <span class="mr-20">63 l?????t xem</span>  --}}
											<strong>H???n n???p h??? s??: {{$value['date_expired']}}</strong>
										</p>
									</div>
									@if($id_employer === null && $roles === -1)
									<div class="save_send">
										<a href="{{route('apply', [$value['id']])}}">N???p ????n</a>
										@if(isset($jobSave) && count($jobSave) > 0)
											@if($jobSave[0]['status']  === 0)
												<a href="{{route('save_job', [$value['id']])}}">
													<i class="fa fa-heart"></i>
													<span>L??u vi???c l??m</span>
												</a>
											@else
												<a href="{{route('save_job', [$value['id']])}}" class="active">
													<i class="fa fa-heart"></i>
													<span>B??? l??u vi???c l??m</span>
												</a>
											@endif
										@else 
											<a href="{{route('save_job', [$value['id']])}}">
												<i class="fa fa-heart"></i>
												<span>L??u vi???c l??m</span>
											</a>
										@endif
										
									</div>
									@endif
								</div>
								<!-- end item work -->
							</div>
						</div>
					</div>

				</section>
				
				<section class="tttd">
					<div class="container">
						<div class="row">
							<p>Th??ng Tin Tuy???n D???ng</p>
						</div>
					</div>
				</section>
				<section class="main-content">
					<div class="container mb-3">
						<div class="row">
							<div class="col-md-8 contentLeft">
								<h2 class="mt-0">QUY???N L???I ???????C H?????NG</h2>
								<ul class="pl-4">
									<?php 
									if(isset($value['Welfare'])) {
										$explode = explode('-', $value['Welfare']);
									} ?>
									@foreach($explode as $item) 
										@if(strlen($item) > 0) 
											<li>{{str_replace('.', "", $item)}}</li>
										@endif
									@endforeach
									
								</ul>
								<h2>M?? T??? C??NG VI???C</h2>
								<ul class="pl-4">
									<?php 
									if(isset($value['description'])) {
										$explode1 = explode('-', $value['description']);
									} ?>
									@foreach($explode1 as $item) 
										@if(strlen($item) > 0) 
											<li>{{str_replace('.', "", $item)}}</li>
										@endif
									@endforeach
								</ul>
								<h2>
									Y??U C???U KH??C
								</h2>
								<ul class="pl-4">
									<?php 
									if(isset($value['requirements_other'])) {
										$explode2 = explode('-', $value['requirements_other']);
									} ?>
									@foreach($explode2 as $item) 
										@if(strlen($item) > 0) 
											<li>{{str_replace('.', "", $item)}}</li>
										@endif
									@endforeach
								</ul>
								<h2>H??NH TH???C N???P H??? S??</h2>
								<ul class="pl-4">
									<li>B???m v??o n??t N???P ????N ????? ???ng tuy???n</li>
								</ul>
							</div>
							<div class="col-md-4">
								<div class="contentRight">
									<p class="mt-3">
										<i class="fa fa-dollar"></i>
										<span>M???c l????ng<strong>{{$value['salary_min']}} tri???u - {{$value['salary_max']}} tri???u </strong></span>
										
									</p>
									<p>
										<i class="fa fa-vcard"></i>
										<span>Kinh nghi???m<strong>{{$value['name_experience']}}</strong></span>
										
									</p>
									<p>
										<i class="fa fa-mortar-board"></i>
										<span>Y??u c???u b???ng c???p<strong>{{$value['name_degree']}}</strong></span>
										
									</p>
									<p>
										<i class="fa fa-group"></i>
										<span>S??? l?????ng c???n tuy???n<strong>{{$value['number_people']}}</strong></span>
										
									</p>
									<p class="cities_category">
											<span>
												<i class="fa fa-map-marker"></i>
												<span>?????a ??i???m l??m vi???c</span>
											</span>
											<span>
												@if(isset($arr_category))
													@foreach($arr_cities as $item)
														<strong>{{$item}}</strong>
													@endforeach
												@endif
											</span>
										</p>
									<p>
										<i class="fa fa-rocket"></i>
										<span>H??nh th???c l??m vi???c<strong>{{$value['name_form_of_work']}}</strong></span>
										
									</p>
									<p class="cities_category">
										<span>
											<i class="fa fa-sliders"></i>
											<span>Ng??nh ngh???</span>
										</span>
										<span>
											@if(isset($arr_category))
												@foreach($arr_category as $item)
													
													<strong>{{$item}}</strong>
												@endforeach
											@endif
										</span>
									</p>
									<p>
										<i class="fa fa-user"></i>
										<span>Y??u c???u gi???i t??nh <strong>{{$value['gender']}}</strong></span>
										
									</p>
									<p >
										<i class="fa fa-user-secret"></i>
										<span>Ch???c v???<strong>{{$value['name_chuc_vu']}}</strong></span>
										
									</p>
									<p class="pt-3">
										<i class="fa fa-language"></i>
										<span>Ng??n ng???<strong>{{$value['language']}}</strong></span>
										
									</p>
								</div>
								
							</div>
						</div>

						
					</div>
				</section>
				<section class="lien-he">
					<div class="container">
						<div class="row ">
								<h2>Th??ng tin li??n h???</h2>
						</div>
						<div class="row">
									<div class="col-md-3">
										<p><strong>Ng?????i li??n h???:</strong></p>
										@if($value['email_employer'] !== 'undefined')
											<p><strong>Email li??n h???:</strong></p>
										@endif

										@if($value['tel_employer'] !== 'undefined')
											<p><strong>S??? ??i???n tho???i li??n h???:</strong></p>
										@endif
										
										<p><strong>?????a ch??? c??ng ty:</strong></p>
										<p><strong>H???n n???p h??? s??:</strong></p>
									</div>
									<div class="col-md-9">
										<p>{{$value['name_employer']}}</p>
											@if($value['email_employer'] !== 'undefined')
												<p>{{$value['email_employer']}}</p>
											@endif

											@if($value['tel_employer'] !== 'undefined')
												<p>{{$value['tel_employer']}}</p>
											@endif
										<p>{{$value['address']}}</p>
										<p>{{$value['date_expired']}}</p>
									</div>
								</div>
							</div>
					</div>
				</section>
			@endforeach
		@endif
	</main>
@endsection