@extends('layout_admin')
@section('content_allUser')
	<main>
		<div class="container">
			<div class="row">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><a href="{{route('admin-work24')}}">dashboard</a></li>
				    <li class="breadcrumb-item active" aria-current="page">Quản lý người tìm việc</li>
				  </ol>
				</nav>

			</div>
			<div class="row">
				<table class="table">
				  <thead class="thead-dark">
				    <tr>
				      <th scope="col">Stt</th>
				      <th scope="col">Họ tên</th>
				      <th scope="col">Số điện thoại</th>
				      <th scope="col">Ngày sinh</th>
				      <th scope="col">Giới tính</th>
				      <th scope="col">Hành động</th>
				    </tr>
				  </thead>
				  <tbody>
				  	@if(isset($dataUser) && count($dataUser) > 0)
				  		@foreach($dataUser as $value)
					 		<tr>
						      <th scope="row">{{$value['id']}}</th>
						      <td>{{$value['name']}}</td>
						      <td>{{$value['tel']}}</td>
						      <td>{{$value['birthday']}}</td>
						      <td>{{$value['gender']}}</td>
						      <td>
						      	<a href="" class="fa fa-eye btn btn-info" data-toggle="modal" data-target="#view_{{$value['id']}}">
						      		xem
						      	</a>
						      </td>
						    </tr>

						    <!-- Modal -->
							<div class="modal fade" id="view_{{$value['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							  <div class="modal-dialog modal-dialog-centered" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalLongTitle">
							        	Thông tin người tìm việc
							        </h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">
							        <p><strong>Họ Tên:</strong>
										<span>{{$value['name']}}</span>
							        </p>
							        <p><strong>Email:</strong> 
							        	<span>
								        	{{$value['email']}}
								        </span>
								    </p>
							       	 <p><strong>Số điện thoại: </strong>
							        	<span>
							        		{{$value['tel']}}
							        	</span>
							        </p>
							       	 <p><strong>Ngày sinh: </strong>
							        	<span>
							        		{{$value['birthday']}}
							        	</span>
							        </p>
							       <p><strong>Địa chỉ:</strong>
										<span>
											{{$value['address']}}
										</span>
							        </p>
							         <p><strong>Giới tính:</strong>
										<span>
											{{$value['gender']}}
										</span>
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
							        	@if($value['name_position'] !== '')
											<a 
										      	href="{{route('profile', [$value['id_info_profile'], str_replace([' ', '/'], ['-', '-'], $value['name_position'])])}}.html" 
										      	class="fa fa-eye btn btn-info" target="_blank">
										      		chi tiết
									      	</a>
								      	@endif
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
			</div>

			
		</div>
	</main>
@endsection