
@extends('layout_dashboard_employers')
@section('content_profile_save')
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
	<?php $updated = Session::get('updated'); ?> 
	</style>
			<nav aria-label="breadcrumb">
			  <ol class="breadcrumb">
			    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
			    <li class="breadcrumb-item active" aria-current="page">DANH SÁCH HỒ SƠ ĐÃ LƯU</li>
			  </ol>
			</nav>
			@if(isset($updated))
	            <div class="row">
	                <div class="col-md-12 text-left">
	                    <div class="notify">
	                        <div class="alert alert-danger alert-dismissible nofication" role="alert">
	                            <strong>{{$updated}}</strong>
	                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                                <span aria-hidden="true">&times;</span>
	                                <span class="sr-only">Close</span>
	                            </button>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        {{Session::put('updated', null)}}
	        @endif
			<section class="jobs">

				<table class="table">
				  <thead>
				    <tr class="text-center">
				      <th scope="col" width="35%">Họ và tên</th>
				      <th scope="col">Vị trí</th>
				      <th scope="col">Ngày lưu</th>
				      <th scope="col">Hành động</th>
				    </tr>
				  </thead>
				  <tbody class="text-center">
				  	{{-- {{dd($data_profile_save)}} --}}
				  	@if(isset($data_profile_save) && count($data_profile_save) > 0)
						@foreach($data_profile_save as $value)
							@if($value['status'] === 1)
								 <tr class="content">
									<th scope="row" class="text-center">
								      	<a style=" " 
								      	href="{{route('profile', [$value['id_profile'], str_replace([' ', '/'], ['-', '-'], $value['name_position'])])
                                                     }}.html" target="_blank">
												{{$value['name']}}
										</a>
								      	{{-- <p style="font-size: 14px;">{{$value['name_company']}}</p> --}}
								    </th>
								    
								     <td>{{$value['name_position']}}</td>
									<td>{{$value['created_at']}}</td>
								    <td>
								      	<a href="{{route('updateProfileSave', [$value['id']])}}" class="btn btn-danger"><i class="fa fa-trash"></i><span> Bỏ lưu</span></a>
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