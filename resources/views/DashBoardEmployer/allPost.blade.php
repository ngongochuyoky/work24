@extends('layout_dashboard_employers')
@section('content_allPost')
<main>
	<style>
		tbody tr td p {
			margin: 0;
			font-size: 14px;
		}
		tbody tr td p.title {
		    width: 270px;
		    overflow: hidden;
		    white-space: nowrap;
		    text-overflow: ellipsis;
		}
		tbody tr td strong {
			margin-right: 10px;
		}
		.contentLeft {
			height: 100vh
		}
	</style>
	<?php 
		$deleted = Session::get('deleted');
		$updated_job = Session::get('updated_job');
		$addted_job = Session::get('addted_job');
	 ?>
	 @if(isset($addted_job))
	 	<div class="row">
                <div class="col-md-12 text-right">
                    <div class="notify">
                        <div class="alert alert-info alert-dismissible nofication" role="alert">
                            <strong>{{$addted_job}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            {{Session::put('addted_job', null)}}
	 @endif
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
	 @if(isset($updated_job))
	 	<div class="row">
                <div class="col-md-12 text-right">
                    <div class="notify">
                        <div class="alert alert-info alert-dismissible nofication" role="alert">
                            <strong>{{$updated_job}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            {{Session::put('updated_job', null)}}
	 @endif
	 <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Danh sách tin tuyển dụng đã đăng</li>
            </ol>
        </nav>
	<table class="table">
	  <thead>
	    <tr>
	      <th scope="col">Vị trí tuyển dụng</th>
	      <th scope="col" class="text-center">Trạng thái</th>
	      <th scope="col">Hạn nộp hồ sơ</th>
	      <th scope="col">Hành động</th>
	    </tr>
	  </thead>
	  <tbody>
	  	@if(isset($data))
			@foreach($data as $value)
				<tr>
			      <td scope="row">
			      	<p class="title">
			      		<a href=" {{route('detailJob', [$value['id'], str_replace([' ', '/'], ['-', '-'], $value['name'])])}}.html" 
			      		target="_blank" style="font-size: 18px;">
                                      {{$value['name']}}</a>
                     </p>
			      	<p><strong>Cập nhật lúc</strong><span>{{$value['created_at']}}</span></p>
			      </td>
			      @if($value['status'] === 0)
			      	<td class="text-center"><span class="btn btn-info" style="font-size: 12px;">Đang chờ quản trị phê duyệt</span></td>
			      @endif
			       @if($value['status'] === 1)
			      	<td class="text-center"><span class="btn btn-success" style="font-size: 12px;">Đã phê duyệt</span></td>
			      @endif
			       @if($value['status'] === -1)
			      	<td><span class="btn btn-warning" style="font-size: 12px;">Bài tuyển dụng không phù hợp với nội quy sử dụng của trang web</span></td>
			      @endif
			      <td><p>{{$value['date_expired']}}</p></td>
			      <td>
			      	<a href="{{route('getEditJob', [$value['id']])}}" class="fa fa-edit btn btn-outline-info">Sửa</a>
			      	<a href="{{route('deletePostJob',[$value['id']])}}" class="fa fa-edit btn btn-danger">Xóa</a>
			      </td>
			    </tr>
			@endforeach
		@endif
	  </tbody>
	</table>
</main>
	
@endsection