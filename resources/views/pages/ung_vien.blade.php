@extends('layout_user')

@section('content_ungvien')
    {{-- {{dd($data_jobs)}} --}}
<main>
    <section class="formSearch">
        <div class="container form_search">
                @include('pages.search_ung_vien')
            </div>
    </section>
    <section class="countWork">
        <div class="container">
            <div class="row">
                <strong>@if(isset($data)) {{count($data)}} @endif ứng viên đã tìm thấy </strong>
            </div>
        </div>
    </section>
     
    <section class="tuyen_dung">
        <div class="container">
            <div class="row">
                    <div class="owl-carousel owl-theme">
                         @if(count($data) > 0)
                             <?php 
                               $data = $data->chunk(15);
                             ?>
                             @foreach($data as $item)
                                <div class="item">
                                    <div class="row">
                                        @foreach($item as $value)
                                            <div class="col-md-4">
                                                <a href="
                                                {{route('profile', [$value['id_info_profile'], str_replace([' ', '/'], ['-', '-'], $value['name_position'])])
                                                 }}.html
                                                " class="item_work" >
                                                    <div class="logo_cty">
                                                        @if(isset($value['avatar']) && $value['avatar'] !== '')
                                                            <img src="{{$value['avatar']}}">
                                                            @else
                                                                <img src="{{asset('frontend/images/no-logo.png')}}">
                                                        @endif
                                                    </div>
                                                    <div class="text">
                                                        <strong>{{$value['name_position']}}</strong>
                                                        <p style="color: black">{{$value['name']}}</p>
                                                        <p>
                                                            <span>kinh nghiệm: </span><span style="color: red">{{$value['name_experience']}}</span>
                                                        </p>
                                                    </div>
                                                </a>
                                            </div>
                                         @endforeach 
                                    </div>
                                </div>
                             @endforeach
                           @endif
                        <!-- end item owl -->

                    </div>
                </div>
        </div>
    </section>
   
    
</main>
@endsection