@extends('layout_admin')
@section('content_allEmployer')
<style>
	.contentLeft {
		height: auto;
	}
	td p.name_company, td p.address {
		width: 170px;
	    overflow: hidden;
	    text-overflow: ellipsis;
	    white-space: nowrap;
	}
</style>
	<main>
		<div class="container">
			<div class="row">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb mb-0" style="background: transparent;">
				    <li class="breadcrumb-item"><a href="{{route('admin-work24')}}">dashboard</a></li>
				    <li class="breadcrumb-item active" aria-current="page">Quản lý nhà tuyển dụng</li>
				  </ol>
				</nav>

			</div>
			<div class="row">
				<table class="table">
				  <thead class="thead-dark">
				    <tr>
				      <th scope="col">Stt</th>
				      <th scope="col">Họ tên</th>
				      <th scope="col">Email</th>
				      <th scope="col">Tên công ty</th>
				      <th scope="col">Address</th>
				      <th scope="col">Hành động</th>
				    </tr>
				  </thead>
				  <tbody>
				  	@if(isset($allEmployer) && count($allEmployer) > 0)
				  		@foreach($allEmployer as $value)
					 		<tr>
						      <th scope="row">{{$value['id']}}</th>
						      <td width="20%">{{$value['name_employer']}}</td>
						      <td>
						      	@if(isset($value['email_employer']) && $value['email_employer'] !== 'undefined')
						      		{{$value['email_employer']}}
						      		@else
						      		{{$value['email']}}
						      	@endif
						      </td>
						      <td ><p class="name_company">{{$value['name_company']}}</p></td>
						      <td ><p class="address">{{$value['address']}}</p></td>
						      <td>
						      	<a href="" class="fa fa-eye btn btn-info" data-toggle="modal" data-target="#view_{{$value['id']}}">
						      		chi tiết
						      	</a>
						      </td>
						    </tr>
						    <!-- Modal -->
							<div class="modal fade" id="view_{{$value['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							  <div class="modal-dialog modal-dialog-centered" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalLongTitle">
							        	Thông tin nhà tuyển dụng
							        </h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">
							        <p><strong>Họ Tên:</strong>
										<span>{{$value['name_employer']}}</span>
							        </p>
							        <p><strong>Email:</strong> 
							        	<span>
								        	@if(isset($value['email_employer']) && $value['email_employer'] !== 'undefined')
									      		{{$value['email_employer']}}
									      		@else
									      		{{$value['email']}}
									      	@endif
								        </span>
								    </p>
							       @if($value['tel_employer'] !== 'undefined')
								       	 <p><strong>Số điện thoại: </strong>
								        	<span>{{$value['tel_employer']}}</span>
								        </p>
							       @endif
							       <p><strong>Địa chỉ:</strong>
										<span>{{$value['address']}}</span>
							        </p>
							          <p><strong>Tên công ty:</strong>
										<span>{{$value['name_company']}}</span>
							        </p>
							         <p><strong>Mật khẩu:</strong>
										<span>{{$value['password']}}</span>
							        </p>
							         <p><strong>Ngày tạo:</strong>
										<span>{{$value['created_at']}}</span>
							        </p>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							      </div>
							    </div>
							  </div>
							</div>
				  		@endforeach
				  		@else
				  			<p>K có dữ liệu</p>
				  	@endif


				   
				   
				  </tbody>
				  

				</table>
				 <?php echo($allEmployer) ?>
			</div>

			
		</div>
	</main>
@endsection