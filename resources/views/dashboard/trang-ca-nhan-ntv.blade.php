@extends('layout_dashboard')
@section('content_trang_ca_nhan')
<?php $message_success = Session::get('message_success'); ?>

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
	<main>
		
		<section class="list-item">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<div class="item">
							<h2>
								@if(isset($jobsFit))
									{{count($jobsFit)}}
								@endif
							</h2>
						<p>Việc làm phù hợp</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="item">
							<h2>
								<?php $count = 0; ?>
								@if(isset($jobSave) && count($jobSave) > 0)
									@foreach($jobSave as $item) 
										@if($item['status'] === 1)
											<?php $count++ ; ?>
										@endif
									@endforeach
									{{($count)}}
									@else
										0
								@endif
							</h2>
							
						<p>Công việc đã lưu</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="item">
							<h2>
								@if(isset($jobs_apply))
									{{count($jobs_apply)}}
									@else
										0
								@endif
							</h2>
						<p>Công việc đã ứng tuyển</p>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="job_save_new">
			<div class="container">
				<div class="row" style="justify-content: space-between; align-items: center;">
					<h4>Việc làm đã lưu mới nhất</h4>
					<p class="text-right"><a href="{{route('getJobs')}}">Xem tất cả</a></p>
				</div>
				<div class="row">
					<table class="table table-hover">
					  <thead>
					    <tr>
					      <th scope="col">Tiêu đề công việc</th>
					      <th scope="col">Công ty</th>
					      <th scope="col">Ngày lưu</th>
					    </tr>
					  </thead>
					  <tbody>
					  @if(isset($jobSaveNew) && count($jobSaveNew) > 0)
					  	@foreach($jobSaveNew as $value)
					  		@if($value['status'] === 1)
								<tr>
							      <th scope="row">{{$value['name']}}</th>
							      <td scope="row">{{$value['name_company']}}</td>
							      <td scope="row">{{$value['created_at']}}</td>
							    </tr>
							    	@else
					  		<tr>
					  			<td >
					  				Chưa có dữ liệu
					  			</td>
					  		</tr>
							   @endif
					  	@endforeach
					  	@else
					  		<tr>
					  			<td >
					  				Chưa có dữ liệu
					  			</td>
					  		</tr>
					@endif
					    
					  </tbody>
					</table>
				</div>
			</div>
		</section>
	</main>
@endsection()