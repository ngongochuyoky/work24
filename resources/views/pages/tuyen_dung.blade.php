@extends('layout_user')

@section('content_tuyendung')
    {{-- {{dd($data_jobs)}} --}}
<main>
    <section class="formSearch">
        <div class="container form_search">
                @include('pages.search')
            </div>
    </section>
    <section class="countWork">
        <div class="container">
            <div class="row">
                <strong>@if(isset($data_jobs)) {{count($data_jobs)}} @endif công việc đã tìm thấy </strong>
            </div>
        </div>
    </section>
    <section class="tuyen_dung">
        <div class="container">
            <div class="row">
                    <div class="owl-carousel owl-theme">
                         @if(isset($data_jobs))
                             <?php 
                               $data = $data_jobs->chunk(21);
                             ?>
                             @foreach($data as $item)
                                <div class="item">
                                    <div class="row">
                                        @foreach($item as $value)
                                                <div class="col-md-4">
                                                    <a href="
                                                    {{route('detailJob', [$value['id'], str_replace([' ', '/'], ['-', '-'], $value['name'])])
                                                     }}.html
                                                    " class="item_work" >
                                                        <div class="logo_cty">
                                                            <img src="{{$value['logo']}}" alt="vnpt">
                                                        </div>
                                                        <div class="text">
                                                            <strong title="Việc làm tuyển dụng: {{$value['name']}}">{{$value['name']}}</strong>
                                                            <p title="Tìm việc làm của {{$value['name_company']}}">{{$value['name_company']}}</p>
                                                            <p class="slary-date">
                                                                <span style="color: tomato">{{$value['salary_min']}} triệu - {{$value['salary_max']}} triệu</span>
                                                                <span>{{$value['date_expired']}}</span>
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
    <section class="allWork">
        <div class="container">
            <div class="row">
                <h2 class="title">VIỆC LÀM MỚI</h2>
            </div>
            <div class="row">
                <div class="col-md-9">
                        @if(isset($jobsNew))
                            @foreach($jobsNew as $value)
                                <div class="item_work">
                                    <div class="logo_cty">
                                        <a href="{{route('detailJob', [$value['id'], str_replace([' ', '/'], ['-', '-'], $value['name'])])
                                             }}.html">
                                            <img src="{{$value['logo']}}" alt="navigos">
                                        </a>
                                    </div>
                                    <div class="text pt-10 pb-10 pl-30 pr-30">
                                        <div class="contentLeft">
                                            <div class="title">
                                                <h2 class="mr0">
                                                    <a href="{{route('detailJob', [$value['id'], str_replace([' ', '/'], ['-', '-'], $value['name'])])
                                             }}.html" class="name">
                                                        {{$value['name']}}
                                                    </a>
                                                </h2>
                                                <p>{{$value['name_company']}}</p>
                                            </div>
                                            <div class="info">
                                                <div class="usd">
                                                    <i class="fa fa-usd"></i>
                                                    <span style="color: tomato">{{$value['salary_min']}} triệu - {{$value['salary_max']}} triệu</span>
                                                </div>
                                                <div class="time">
                                                    <i class="fa fa-clock"></i>
                                                    <span>{{$value['date_expired']}}</span>
                                                </div>
                                            </div>
                                        </div>
                                      {{--   <div class="save">
                                            <i class="fa fa-heart"></i>
                                            <span>Lưu</span>
                                        </div> --}}
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        

                         <div class="row">
                             <div class="page navigation">
                                 <?php //echo ($jobsNew); ?>
                             </div>
                         </div>
                    </div>
                <div class="col-md-3">
                    <div class="list-qc">
                        {{-- <img src="{{asset("frontend/images/qc1.jpg")}}" alt=""> --}}
                        <img src="{{asset("frontend/images/qc2.jpg")}}" alt="" class="mt-20 mb-20">
                        <img src="{{asset("frontend/images/qc3.jpg")}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end allWork -->
    
</main>
@endsection