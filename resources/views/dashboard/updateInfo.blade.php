@extends('layout_dashboard')
@section('content_updateInfo')

    <?php 
        $ngay = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31];
        $thang = [1,2,3,4,5,6,7,8,9,10,11,12];
        $nam = [1971,1972,1973,1974,1975,1976,1977,1978,1979,1980,1981,1982,1983,1984,1985,1986,1987,1988,1989,1990,1991,1992,1993,1994,1995,1996,1997,1998,1999,2000,2001,2002,2003,2004,2005,2006,2007,2008,2009,2010];
     ?>
	<main>
		<style>
		.contentLeft {
        		height: auto;
    		}
       section form label.clickUpload {
            font-size: 15px;
            color: #de770d;
            margin-top: 10px;
        }
    	</style>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cập nhật hồ sơ</li>
            </ol>
        </nav>
        <section class="contact">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 active">
                        <a href="{{route('getUpdateInfo')}}">
                            <div class="icon">
                                <i class="fa fa-user"></i>
                            </div>
                        </a>
                        <div class="text">
                            <h6>Thông tin cá nhân</h6>
                        </div>
                    </div>
                    <div class="col-md-4">
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
                    	<h4>Thông tin cá nhân</h4>
                    </div>

                </div>
                <form action="{{route('postUpdateInfo')}}" method="POST" enctype="multipart/form-data">
                      @if(isset($user))
                        @foreach($user as $value)
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group text-center">
                                        <p>avatar user</p>
                                        <div class="avatar">

                                            @if(isset($value['avatar']) && $value['avatar'] !== '')
                                                <img src="{{$value['avatar']}}" alt="" style="width: 150px;">
                                            @else 
                                                <img src="{{asset('frontend/images/avatar/male_avatar.jpg')}}" alt="">
                                            @endif
                                        </div>
                                        <input type="file" id="file" name="avatar" class="el-upload-file" style="display: none" value="{{$value['avatar']}}">
                                        <label for="file" class="clickUpload"><i class="fa fa-upload"></i>Thay logo công ty</label>
                                    </div>
                                </div>
                  
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <span class='required'>*</span>
                                            <label for="name">Họ tên</label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="" 
                                                name="name" 
                                                placeholder="nguyen van a" 
                                                required
                                                value="<?php if($value['name']) {echo $value['name']; } else {echo '';} ?>

                                                ">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <span class='required'>*</span>
                                            <label for="">Số điện thoại</label>
                                            <input type="text" 
                                            class="form-control" id="" 
                                            name="tel" 
                                            placeholder="0898162561"
                                            required
                                            value="<?php if($value['tel']) {echo $value['tel']; } else {echo '';} ?>" 

                                            >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        
                                        <div class="form-group">
                                            <span class='required'>*</span>
                                            <label for="emai">Địa chỉ email</label>
                                            <input type="email" 
                                            class="form-control" id=""
                                             name="email"
                                              placeholder="name@example.com"
                                              required
                                            value="<?php if($value['email']) {echo $value['email']; } else {echo '';} ?>" 
                                            >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <span class='required'>*</span>
                                        <label for="exampleFormControlInput1">Ngày sinh</label>
                                        <div class="row">
                                            <div class="col-md-4">
                                                    <?php 

                                                        if($value['birthday']) {
                                                            $get_date = $value['birthday'];
                                                            $date = explode('-', $get_date);

                                                            ?>
                                                     
                                                <select class="form-control" name="ngay" required>
                                                    <option value="{{$date[0]}}" data-default>
                                                        {{$date[0]}}
                                                    </option>
                                                    @foreach($ngay as $ng) 
                                                        <option value="{{$ng}}">{{$ng}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <select class="form-control" name="thang" required>
                                                    <option value="{{$date[1]}}" data-default>
                                                        {{$date[1]}}
                                                    </option>
                                                     @foreach($thang as $t) 
                                                        <option value="{{$t}}">{{$t}}</option>
                                                    @endforeach
                                                   
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <select class="form-control" name="nam" required>
                                                    <option value="{{$date[2]}}" data-default>
                                                        {{$date[2]}}
                                                    </option>
                                                    @foreach($nam as $n) 
                                                        <option value="{{$n}}">{{$n}}</option>
                                                    @endforeach
                                                </select>

                                                <?php    } else { ?>

                                                <select class="form-control" name="ngay" required>
                                                    @foreach($ngay as $ng) 
                                                        <option value="{{$ng}}">{{$ng}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <select class="form-control" name="thang" required>
                                                     @foreach($thang as $t) 
                                                        <option value="{{$t}}">{{$t}}</option>
                                                    @endforeach
                                                   
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <select class="form-control" name="nam" required>
                                                    @foreach($nam as $n) 
                                                        <option value="{{$n}}">{{$n}}</option>
                                                    @endforeach
                                                </select>

                                             <?php   }

                                                    ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <span class='required'>*</span>
                                            <label for="exampleFormControlInput1">Địa chỉ</label>
                                            <input type="text" class="form-control" name="address" 
                                            placeholder="Nhập địa chỉ nơi ở hiện tại"
                                            required
                                            value="<?php if($value['address']) {echo $value['address']; } else {echo '';} ?>" 
                                            >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="required">*</span>
                                        <label for="exampleFormControlInput1">Giới tính</label>
                                        <br>
                                        <input type="radio" 
                                        checked="checked"
                                        value="Nam"
                                        id="gender" 
                                        name="gender" 
                                        >
                                        <span>nam</span>

                                        <input type="radio" 
                                        id="gender2" 
                                         value="Nữ"
                                         name="gender"  
                                         >
                                        <span>nữ</span>
                                    </div>

                                    <div class="col-md-6">
                                        <span class='required'>*</span>
                                        <label for="exampleFormControlInput1">Tình trạng hôn nhân</label>
                                        <br>
                                        <input type="radio" name="marital_status" checked="checked" value="Độc thân">
                                        <span>Độc thân</span>

                                        <input type="radio" name="marital_status" value="Đã kết hôn">
                                        <span>Đã kết hôn</span>
                                    </div>

                                    <div class="col-md-12 text-right">
                                      
                                        <input type="submit" value="Cập nhật" class="btn btn-primary">
                                    </div>
                                    </div>
                                </div>
                          
                            </div>
                       @endforeach
                    
                    @endif()  

                    {!! csrf_field() !!}
                </form>
            </div>
        </section>
    </main>
@endsection()