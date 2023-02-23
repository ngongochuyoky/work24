@extends('layout_admin')
@section('content_all_job')
<style>
	.contentLeft {
		height: auto
	}
	tbody tr td {
		font-size: 14px;
	}
	p.eclipse, p.created_at {
	    width: 160px;
	    overflow: hidden;
	    white-space: nowrap;
	    text-overflow: ellipsis;
	}
	p.created_at {
	    width: 80px;
	}
</style>
	<main>
		<?php $deleted_job = Session::get('deleted_job');
		$updated_status = Session::get('updated_status');
		 ?>
		<div class="container">
			@if(isset($deleted_job))
			 	<div class="row">
		                <div class="col-md-12 text-right">
		                    <div class="notify">
		                        <div class="alert alert-danger alert-dismissible nofication" role="alert">
		                            <strong>{{$deleted_job}}</strong>
		                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                                <span aria-hidden="true">&times;</span>
		                                <span class="sr-only">Close</span>
		                            </button>
		                        </div>
		                    </div>
		                </div>
		            </div>

		            {{Session::put('deleted_job', null)}}
			 @endif
			 @if(isset($updated_status))
			 	<div class="row">
		                <div class="col-md-12 text-right">
		                    <div class="notify">
		                        <div class="alert alert-info alert-dismissible nofication" role="alert">
		                            <strong>{{$updated_status}}</strong>
		                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                                <span aria-hidden="true">&times;</span>
		                                <span class="sr-only">Close</span>
		                            </button>
		                        </div>
		                    </div>
		                </div>
		            </div>

		            {{Session::put('updated_status', null)}}
			 @endif
			<div class="row">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb mb-0" style="background: transparent;">
				    <li class="breadcrumb-item"><a href="{{route('admin-work24')}}">dashboard</a></li>
				    <li class="breadcrumb-item active" aria-current="page">Quản lý ngành nghề</li>
				  </ol>
				</nav>

			</div>
			<div class="row">
				<table class="table">
				  <thead class="thead-dark">
				    <tr>
				      <th scope="col">Stt</th>
				      <th scope="col">Chức danh</th>
				      <th scope="col">Tên công ty</th>
				      <th scope="col">Mức lương</th>
				      <th scope="col">Địa điểm</th>
				      <th scope="col">created_at</th>
				      <th scope="col">status</th>
				      <th scope="col">Hành động</th>
				    </tr>
				  </thead>
				  <tbody>
				  	@if(isset($data) && count($data) > 0)
				  		@foreach($data as $key => $value)
				  			@if($value['status'] === 1 || $value['status'] === 0)
				  				<tr>
							      <th scope="row">{{$value['id']}}</th>
							      <td ><p class="eclipse">{{$value['name']}}</p></td>
							      <td ><p class="eclipse">{{$value['name_company']}}</p></td>
							      <td style="color: red">{{$value['salary_min']}} - {{$value['salary_max']}} triệu</td>
							      <td >{{$value['name_cities']}}</td>
							      <td ><p class="created_at">{{$value['created_at']}}</p></td>
							      @if($value['status'] === 1) 
							      	<td> 
							      		<button disabled  class="btn btn-info" style="font-size: 12px;">Đã phê duyệt</button>
							      	</td>
							      @endif 
							       @if($value['status'] === 0) 
							       	<td>	
							       		<a href="{{route('updateStatusJob', [$value['id']])}}" class="btn btn-outline-info" style="font-size: 12px;">Phê duyệt</a>
							       	</td>
							      @endif
							      <td>
							      	<a href="{{
											route('detailJob', [$value['id'], str_replace([' ', '/'], ['-', '-'], $value['name'])])
										}}.html" class="fa fa-eye btn btn-info" target="_blank">
							      	</a>
							      	<a href="{{route('deleJob', [$value['id']])}}" class="fa fa-trash btn btn-danger">
							      	</a>
							      </td>
							    </tr>
				  			@endif
					 		
				  		@endforeach
				  		@else
				  			<p>K có dữ liệu</p>
				  	@endif


				   
				   
				  </tbody>

				</table>
				 <?php echo($data) ?>
			</div>

			
		</div>
	</main>
@endsection