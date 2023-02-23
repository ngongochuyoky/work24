@extends('layout_dashboard')
@section('content_jobs_apply')
<?php $deleted = Session::get('deleted'); ?>
	<main>
		<style>
		tr.content th, 
		tr.content td {
			vertical-align: middle;
		}
		tr.content {
			position: relative;
			
		}
		tr.content td.active, th.active {
			opacity: .2
		}
		td.delete {
			position: absolute;
			left: 50%;
		}
	</style>
	<div class="wrapper">
		<div class="container">
			@if(isset($deleted))
			 	<div class="row">
		                <div class="col-md-12 text-right">
		                    <div class="notify">
		                        <div class="alert alert-danger alert-dismissible nofication" role="alert">
		                            <strong>{{$deleted}}</strong>
		                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                                <span aria-hidden="true">&times;</span>
		                                <span class="sr-only">Close</span>
		                            </button>
		                        </div>
		                    </div>
		                </div>
		            </div>

		            {{Session::put('deleted', null)}}
			 @endif
			<nav aria-label="breadcrumb">
			  <ol class="breadcrumb">
			    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
			    <li class="breadcrumb-item active" aria-current="page">Việc làm đã ứng tuyển</li>
			  </ol>
			</nav>
			<section class="job_apply">

				<table class="table table-dark">
				  <thead>
				    <tr class="text-center">
				      <th scope="col" width="35%">Vị trí / Công ty</th>
				      <th scope="col">Mức lương</th>
				      <th scope="col">Ngày ứng tuyển</th>
				      <th scope="col">Trạng thái</th>
				      {{-- <th scope="col">Xóa</th> --}}
				    </tr>
				  </thead>
				  <tbody class="text-center">
				  	@if(isset($jobs_apply) && count($jobs_apply) > 0)
						@foreach($jobs_apply as $value)
							 <tr class="content ">
								<th scope="row" 
									class="text-left <?php if($value['status'] === 0) {echo 'active';} else {echo '';} ?>">
							      	<a style="font-size: 12px; " 
							      		href="{{route('detailJob', [$value['id_job'], str_replace([' ', '/'], ['-', '-'], $value['name'])])
										}}.html" target="_blank"
									>
											{{$value['name']}}
									</a>
							      	<p style="font-size: 14px;">{{$value['name_company']}}</p>
							    </th>
							     
							     <td style="color: red" 
							     class="<?php if($value['status'] === 0) {echo 'active';} else {echo '';} ?>">
							     	{{$value['salary_min'] . ' triệu  - ' . $value['salary_max'] . ' triệu'}} 
							     </td>
							     <td class="<?php if($value['status'] === 0) {echo 'active';} else {echo '';} ?>">
								     {{$value['created_at']}}
								 </td>
							     <td class="<?php if($value['status'] === 0) {echo 'active';} else {echo '';} ?>">
							     	@if($value['status'] === 1) 
							     		<span class="btn btn-success" style="font-size: 12px;">Đã ứng tuyển</span>
							     	@endif
							     	@if($value['status'] === 0)
							     		<span>Nhà tuyển dụng từ chối</span>
							     	@endif
							     </td>
								@if($value['status'] === 0)
						     		 <td class="delete">
								      	<a href="{{route('delete_apply', [$value['id']])}}" class="btn btn-danger"><i class="fa fa-trash"></i><span> Xoá</span></a>
								    </td>
						     	@endif
						    </tr>
						@endforeach
						@else
							<h4 class="no_data">Không có dữ liệu</h4>
					@endif
				  </tbody>
				</table>
			</section>
		</div>
	</div>
		
		</main>
@endsection