
@extends('layout_admin')
	@section('content_home')
	<style>
		#wrapper .col-md-9 {
            background: #0000008c;
        }
	</style>
	<?php $mes_success  = Session::get('mes_success'); ?>
		@if(isset($mes_success))
		<div class="notify">
			<div class="alert alert-info alert-dismissible nofication" role="alert">
				<strong>{{$mes_success}}</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
			</div>
		</div>
		@endif
	<?php Session::put('mes_success', null) ?>
	<main>
        <section class="list-item">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="item">
                            <h2>
                                @if(isset($allJob) && count($allJob) > 0)
                                    {{(count($allJob))}}
                                @endif
                            </h2>
                        <p>Tất cả việc làm</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="item">
                            <h2>
                                @if(isset($users) && count($users) > 0)
                                    {{(count($users))}}
                                @endif
                            </h2>
                        <p>Người tìm việc</p>
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="item">
                            <h2>
                                @if(isset($employers) && count($employers) > 0)
                                    {{(count($employers))}}
                                @endif
                            </h2>
                        <p>Nhà tuyển dụng</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="item">
                            <h2>0</h2>
                        <p>Hồ sơ đã ứng tuyển</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="job_save_new">
            <div class="container">
                <div class="row" style="justify-content: space-between; align-items: center;">
                    <h4>Việc làm mới nhất</h4>
                    <p class="text-right"><a href="{{route('all-job')}}">Xem tất cả</a></p>
                </div>
                <div class="row">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th scope="col">Tiêu đề công việc</th>
                          <th scope="col">Số lượng</th>
                          <th scope="col">Ngày đăng</th>
                        </tr>
                      </thead>
                      <tbody>
                      @if(isset($postJobNew) && count($postJobNew) > 0)
                        @foreach($postJobNew as $value)
                                <tr>
                                  <th scope="row">{{$value['name']}}</th>
                                  <td scope="row">{{$value['number_people']}}</td>
                                  <td scope="row">{{$value['created_at']}}</td>
                                </tr>
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
	@endsection

