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
                <li class="breadcrumb-item active" aria-current="page">Danh s??ch tin tuy???n d???ng ???? ????ng</li>
            </ol>
        </nav>
	<table class="table">
	  <thead>
	    <tr>
	      <th scope="col">V??? tr?? tuy???n d???ng</th>
	      <th scope="col" class="text-center">Tr???ng th??i</th>
	      <th scope="col">H???n n???p h??? s??</th>
	      <th scope="col">H??nh ?????ng</th>
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
			      	<p><strong>C???p nh???t l??c</strong><span>{{$value['created_at']}}</span></p>
			      </td>
			      @if($value['status'] === 0)
			      	<td class="text-center"><span class="btn btn-info" style="font-size: 12px;">??ang ch??? qu???n tr??? ph?? duy???t</span></td>
			      @endif
			       @if($value['status'] === 1)
			      	<td class="text-center"><span class="btn btn-success" style="font-size: 12px;">???? ph?? duy???t</span></td>
			      @endif
			       @if($value['status'] === -1)
			      	<td><span class="btn btn-warning" style="font-size: 12px;">B??i tuy???n d???ng kh??ng ph?? h???p v???i n???i quy s??? d???ng c???a trang web</span></td>
			      @endif
			      <td><p>{{$value['date_expired']}}</p></td>
			      <td>
			      	<a href="{{route('getEditJob', [$value['id']])}}" class="fa fa-edit btn btn-outline-info">S???a</a>
			      	<a href="{{route('deletePostJob',[$value['id']])}}" class="fa fa-edit btn btn-danger">X??a</a>
			      </td>
			    </tr>
			@endforeach
		@endif
	  </tbody>
	</table>
</main>
	
@endsection