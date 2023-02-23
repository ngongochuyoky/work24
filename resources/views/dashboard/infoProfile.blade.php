@extends('layout_dashboard')
@section('content_infoProfile')
<main>
    <style>
    .contentLeft {
            height: auto;
        }
    </style>

    <?php 
         $message_b1 = Session::get('message_b1');
        /*if($message_b1) {
            echo "<script type='text/javascript'>alert('$message_b1')</script>";
            Session::put('message_b1', null);
        }*/
     ?>
     @if(isset($message_b1))
            <div class="row">
                <div class="col-md-12 text-right">
                    <div class="notify">
                        <div class="alert alert-info alert-dismissible nofication" role="alert">
                            <strong>{{$message_b1}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        {{Session::put('message_b1', null)}}
        @endif
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cập nhật hồ sơ</li>
            </ol>
        </nav>
        <section class="contact">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 ">
                        <a href="{{route('getUpdateInfo')}}">
                            <div class="icon">
                                <i class="fa fa-user"></i>
                            </div>
                        </a>
                        <div class="text">
                            <h6>Thông tin cá nhân</h6>
                        </div>
                    </div>
                    <div class="col-md-4 active">
                        <a href="{{route('getInfoProfile')}}">
                            <div class="icon">
                                <i class="fa fa-info"></i>
                            </div>
                        </a>
                        <div class="text">
                            <h6>Thông tin hồ sơ</h6>
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <a href="{{route('getSkill')}}">
                            <div class="icon">
                                <i class="fa fa-bolt"></i>
                            </div>
                        </a>
                        <div class="text">
                            <h6>Kỹ năng</h6>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="form_info">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Thông tin hồ sơ</h4>
                    </div>

                </div>
                <form action="{{route('postInfoProfile')}}" method="post">
                    @if(isset($valueDefault))
                        @if(count($valueDefault) > 0)
                            @foreach($valueDefault as $item)
                               @if($item['name_position'] !== "")
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <span class='required'>*</span>
                                                <label for="name">Vị trí/việc làm cần ứng tuyển</label>
                                                <input type="text" class="form-control" id="" name="name_position" 
                                                required 
                                                value="{{$item['name_position']}}"
                                                placeholder="VD:Nhân viên kinh doanh">

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <span class='required'>*</span>
                                                <label for="">Trình độ học vấn</label>
                                                <select class="form-control" id="" name="id_degree" required>
                                                    <option value="{{$item['id_degree']}}" selected data-default>
                                                       {{$item['name_degree']}}
                                                    </option>
                                                    @if(isset($degree))
                                                        @foreach($degree as $value)
                                                            <option value="{{$value['id']}}">{{$value['name_degree']}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <span class='required'>*</span>
                                                <label for="emai">Số năm kinh nghiệm</label>
                                                <select class="form-control" id="" name="id_experience" required>
                                                    <option value="{{$item['id_experience']}}" selected data-default>
                                                         {{$item['name_experience']}}
                                                    </option>
                                                     @if(isset($experience))
                                                        @foreach($experience as $value)
                                                            <option value="{{$value['id']}}">{{$value['name_experience']}}</option>
                                                        @endforeach
                                                    @endif

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <span class='required'>*</span>
                                                <label for="exampleFormControlInput1">Nơi làm việc</label>
                                                <select class="form-control" id="" name="id_cities" required>
                                                    <option value="{{$item['id_cities']}}" selected data-default>
                                                       {{$item['name_cities']}}
                                                    </option>
                                                   @if(isset($cities))
                                                        @foreach($cities as $value)
                                                            <option value="{{$value['id']}}">{{$value['name_cities']}}</option>
                                                        @endforeach
                                                    @endif


                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <span class='required'>*</span>
                                                <label for="exampleFormControlInput1">Ngành nghề</label>
                                                <select class="form-control" id="" name="id_category" required>
                                                    <option value="{{$item['id_category']}}" selected data-default>
                                                       {{$item['name_category']}}
                                                    </option>
                                                    @if(isset($category))
                                                        @foreach($category as $value)
                                                            <option value="{{$value['id']}}">{{$value['name_category']}}</option>
                                                        @endforeach
                                                    @endif

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <span class='required'>*</span>
                                                <label for="exampleFormControlInput1">Loại hình công việc</label>
                                                <select class="form-control" id="" name="id_form_of_work" required>
                                                    <option value="{{$item['id_form_of_work']}}" selected data-default>
                                                        {{$item['name_form_of_work']}}
                                                    </option>
                                                    @if(isset($form_of_work))
                                                        @foreach($form_of_work as $value)
                                                            <option value="{{$value['id']}}">{{$value['name_form_of_work']}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <span class='required'>*</span>
                                                <label for="exampleFormControlInput1">Cấp bậc</label>
                                                <select class="form-control" id="" name="id_chuc_vu" required>
                                                    <option value="{{$item['id_chuc_vu']}}" selected data-default>
                                                         {{$item['name_chuc_vu']}}
                                                    </option>
                                                    @if(isset($chuc_vu))
                                                        @foreach($chuc_vu as $value)
                                                            <option value="{{$value['id']}}">{{$value['name_chuc_vu']}}</option>
                                                        @endforeach
                                                    @endif

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <span class='required'>*</span>
                                                <label for="exampleFormControlInput1">Mức lương</label>
                                                <select class="form-control" id="" name="id_salary" required>
                                                    <option value="{{$item['id_salary']}}" selected data-default>
                                                        {{$item['salary_min'] . ' - ' . $item['salary_max'] . ' triệu'}}
                                                    </option>
                                                    @if(isset($salary))
                                                        @foreach($salary as $value)
                                                            <option value="{{$value['id']}}">{{$value['salary_min']}} - {{$value['salary_max']}} triệu</option>
                                                        @endforeach
                                                    @endif

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <span class="required">*</span>
                                                <label for="">Mô tả mục tiêu nghề nghiệp</label>
                                            <div class="form-group">
                                                <textarea name="description"  rows="10" placeholder="Mô tả, giới thiệu về định hướng công việc của bản thân trong tương lại ngắn hoặc dài hạn." required> {{$item['description']}}</textarea>
                                                <p>Lưu ý: Để nội dung xuống dòng bạn hãy thêm @ cuối cùng.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-right">
                                            <input type="submit" value="Cập nhật" class="btn btn-primary">
                                        </div>

                                    </div>

                                    @else
                                    
                                     <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <span class='required'>*</span>
                                                <label for="name">Vị trí/việc làm cần ứng tuyển</label>
                                                <input type="text" class="form-control" id="" name="name_position" 
                                                required 
                                                value=""
                                                placeholder="VD:Nhân viên kinh doanh">

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <span class='required'>*</span>
                                                <label for="">Trình độ học vấn</label>
                                                <select class="form-control" id="" name="id_degree" required>
                                                    <option value="" selected data-default>
                                                    </option>
                                                    @if(isset($degree))
                                                        @foreach($degree as $value)
                                                            <option value="{{$value['id']}}">{{$value['name_degree']}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <span class='required'>*</span>
                                                <label for="emai">Số năm kinh nghiệm</label>
                                                <select class="form-control" id="" name="id_experience" required>
                                                    <option value="" selected data-default>
                                                    </option>
                                                     @if(isset($experience))
                                                        @foreach($experience as $value)
                                                            <option value="{{$value['id']}}">{{$value['name_experience']}}</option>
                                                        @endforeach
                                                    @endif

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <span class='required'>*</span>
                                                <label for="exampleFormControlInput1">Nơi làm việc</label>
                                                <select class="form-control" id="" name="id_cities" required>
                                                    <option value="" selected data-default>
                                                       
                                                    </option>
                                                   @if(isset($cities))
                                                        @foreach($cities as $value)
                                                            <option value="{{$value['id']}}">{{$value['name_cities']}}</option>
                                                        @endforeach
                                                    @endif


                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <span class='required'>*</span>
                                                <label for="exampleFormControlInput1">Ngành nghề</label>
                                                <select class="form-control" id="" name="id_category" required>
                                                    <option value="" selected data-default>
                                                      
                                                    </option>
                                                    @if(isset($category))
                                                        @foreach($category as $value)
                                                            <option value="{{$value['id']}}">{{$value['name_category']}}</option>
                                                        @endforeach
                                                    @endif

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <span class='required'>*</span>
                                                <label for="exampleFormControlInput1">Loại hình công việc</label>
                                                <select class="form-control" id="" name="id_form_of_work" required>
                                                    <option value="" selected data-default>
                                                       
                                                    </option>
                                                    @if(isset($form_of_work))
                                                        @foreach($form_of_work as $value)
                                                            <option value="{{$value['id']}}">{{$value['name_form_of_work']}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <span class='required'>*</span>
                                                <label for="exampleFormControlInput1">Cấp bậc</label>
                                                <select class="form-control" id="" name="id_chuc_vu" required>
                                                    <option value="" selected data-default>
                                                       
                                                    </option>
                                                    @if(isset($chuc_vu))
                                                        @foreach($chuc_vu as $value)
                                                            <option value="{{$value['id']}}">{{$value['name_chuc_vu']}}</option>
                                                        @endforeach
                                                    @endif

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <span class='required'>*</span>
                                                <label for="exampleFormControlInput1">Mức lương</label>
                                                <select class="form-control" id="" name="id_salary" required>
                                                    <option value="" selected data-default>
                                                        
                                                    </option>
                                                    @if(isset($salary))
                                                        @foreach($salary as $value)
                                                            <option value="{{$value['id']}}">{{$value['salary_min']}} - {{$value['salary_max']}} triệu</option>
                                                        @endforeach
                                                    @endif

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <span class="required">*</span>
                                                <label for="">Mô tả mục tiêu nghề nghiệp</label>
                                            <div class="form-group">
                                                <textarea name="description"  rows="10" placeholder="Mô tả, giới thiệu về định hướng công việc của bản thân trong tương lại ngắn hoặc dài hạn." required></textarea>
                                                <p>Lưu ý: Để nội dung xuống dòng bạn hãy thêm @ cuối cùng.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-right">
                                            <input type="submit" value="Cập nhật" class="btn btn-primary">
                                        </div>

                                    </div>
                               @endif

                            @endforeach
                      @endif
                    @endif

                     {!! csrf_field() !!}
                </form>
            </div>
        </section>
    </main>
@endsection