
@extends('layout_dashboard')
@section('content_jobs_save')
	<main>
		<style>
		tr.content th, 
		tr.content td {
			vertical-align: middle;
		}
		.contentLeft {
                overflow: auto;
            }
            tr th a:hover {
            	color: tomato
            }
           h4.no_data {
	    position: absolute;
	    top: 200px;
	    left: 40%;
	}
	</style>
			<nav aria-label="breadcrumb">
			  <ol class="breadcrumb">
			    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
			    <li class="breadcrumb-item active" aria-current="page">Việc làm đã lưu</li>
			  </ol>
			</nav>
			<section class="jobs">

				<table class="table table-dark">
				  <thead>
				    <tr class="text-center">
				      <th scope="col" width="35%">Vị trí / Công ty</th>
				      <th scope="col">Ngày lưu</th>
				      <th scope="col">Ngày hết hạn</th>
				      <th scope="col">Mức lương</th>
				      <th scope="col">Xóa</th>
				    </tr>
				  </thead>
				  <tbody class="text-center">
				  	@if(isset($jobSave) && count($jobSave) > 0)
						@foreach($jobSave as $value)
							@if($value['status'] === 1)
								 <tr class="content">
									<th scope="row" class="text-left">
								      	<a style="font-size: 12px; " 
								      		href="{{route('detailJob', [$value['id_job'], str_replace([' ', '/'], ['-', '-'], $value['name'])])
													}}.html" target="_blank">
												{{$value['name']}}
										</a>
								      	<p style="font-size: 14px;">{{$value['name_company']}}</p>
								    </th>
								     <td>{{$value['created_at']}}</td>
								     <td>{{$value['date_expired']}}</td>
								     <td style="color: red">{{$value['salary_min'] . ' - ' . $value['salary_max'] . ' triệu'}}</td>

								    <td>
								      	<a href="{{route('update_jobSave', [$value['id']])}}" class="btn btn-danger"><i class="fa fa-trash"></i><span> Xoá</span></a>
								    </td>
							    </tr>
							@endif
						@endforeach
						@else
							<h4 class="no_data">Không có dữ liệu</h4>
					
					@endif
				  </tbody>
				</table>
			</section>
		</main>
@endsection