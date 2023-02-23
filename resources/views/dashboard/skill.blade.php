@extends('layout_dashboard')
@section('content_skill')
	<main>
        <style>
            .contentLeft {
                height: auto;
            }
        </style>
        <?php 
             $message_b2 = Session::get('message_b2');
            /*if($message_b2) {
                echo "<script type='text/javascript'>alert('$message_b2')</script>";
                Session::put('message_b2', null);
            }*/

            $skill = ['Kỹ năng tổ chức', 'Kỹ năng giao tiếp', 'Kỹ năng làm việc theo nhóm', 'Giải quyết vấn đề', 'Kỹ năng lãnh đạo', 'Kỹ năng thuyết trình', 'Lập kế hoạch', 'Quản lý thời gian hiệu quả', 'Dễ dàng thích nghi với mỗi trường mới', 'Tư duy sáng tạo'];
            $des_skill = Session::get('des_skill');

            //dd($des_skill)

         ?>
         @if(isset($message_b2))
            <div class="row">
                <div class="col-md-12 text-right">
                    <div class="notify">
                        <div class="alert alert-info alert-dismissible nofication" role="alert">
                            <strong>{{$message_b2}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        {{Session::put('message_b2', null)}}
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
                    <div class="col-md-4 active">
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
                        <h4>Kỹ năng</h4>
                    </div>

                </div>
                <form action="{{route('postSkill')}}" method="post">
                    <div class="row">
                        @if(isset($skill_value))
                            @if(count($skill_value) > 0)
                                @foreach($skill_value as $item)
                                <input type="text" value="{{$item['id']}}" name="id_skill" hidden>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">
                                                Các kỹ năng chuyên môn
                                            </label>
                                             @if(isset($des_skill))
                                                <p style="color: red; font-size: 12px;">{{$des_skill}} {{Session::put('des_skill', null)}}</p>
                                            @endif
                                            <textarea name="des_skill" id="" style="width: 100%" rows="7" required> {{$item['des_skill']}}</textarea>
                                        </div>
                                    </div>
                                    @foreach($skill as $value) 
                                         <div class="col-md-4">
                                            <div class="checkbox">
                                                 <label>
                                                    <input 
                                                    type="checkbox" 
                                                    name="skill[]" 
                                                   @if($value === $item['name_skill'])
                                                   checked="true"
                                                   @endif
                                                    value="{{$value}}"

                                                    style="margin-right: 10px">
                                                  {{$value}}

                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            @endif
                        @endif


                       
                        <div class="col-md-12 text-right">
                                <input type="submit" value="Cập nhật" class="btn btn-primary">

                        </div>

                    </div>

                     {!! csrf_field() !!}
                </form>
            </div>
        </section>
    </main>
@endsection