@extends('layout_dashboard_employers') 
@section('contentHome')
	<style>
        #wrapper .col-md-9 {
            background: black;
        }
		.contentLeft {
        		min-height: 100vh;
    		}

	</style>
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
                                @if(isset($postJob) && count($postJob) > 0)
                                    {{(count($postJob))}}
                                    @else
                                       0
                                @endif
                            </h2>
                        <p>Việc làm đã đăng</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="item">
                            <h2>
                                @if(isset($profileSave) && count($profileSave) > 0)
                                    {{(count($profileSave))}}
                                    @else
                                       0
                                @endif
                            </h2>
                        <p>Hồ sơ đã lưu</p>
                        </div>
                    </div>
                    <div class="col-md-4">
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
                    <h4>Việc làm đã đăng mới nhất</h4>
                    <p class="text-right"><a href="{{route('allPost')}}">Xem tất cả</a></p>
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