@extends('layout_dashboard_employers')
@section('content_editPostJob')
<main>
	<style>
		.contentLeft{
			height: auto
		}
		.form_info form .contentRight{
			    border: 1px solid #abe4d3;
			    background: #d9f0e9;
			    border-radius: 5px;
			    padding: 15px;
		}
		.form_info form .contentRight h2{
			font-size: 17px;
			font-weight: bold;
			text-align: center;
		}
		.form_info form .contentRight > p {
			font-size: 13px;

		}
		.form_info form .contentRight > p.icon {
			text-align: center;
			font-size: 40px;
    		color: #20ce99;
		}
		.form_info form .contentRight .tab_intro {}
		.form_info form .contentRight .tab_intro .intro_item {
			display: flex;
			align-items: center;
			margin-bottom: 20px;
		}
		.form_info form .contentRight .tab_intro .intro_item span {
			    border: 2px solid gray;
			    width: 31px;
			    height: 30px;
			    border-radius: 50%;
			    display: flex;
			    align-items: center;
			    justify-content: center;
			    font-weight: 700;
			    font-size: 18px;
			    margin-right: 9px;
		}
		.form_info form .contentRight .tab_intro .intro_item p {
			font-size: 13px;
    		margin-bottom: 0;
		}
	</style>
	 <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa tin tuyển dụng</li>
            </ol>
        </nav>
	<section class="form_info">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h4>THÔNG TIN CÔNG VIỆC</h4>
                    </div>
                </div>
                <form action="{{route('postEditJob')}}" method="post">
                	<div class="row">
                		<div class="col-md-8">
                            <div class="row">
                                @if(isset($data))
                                    @foreach($data as $item)
                                        <input type="text" value="{{$item['id']}}" hidden name="id_job">
                                        <input type="text" value="{{$item['id_employer']}}" hidden name="id_employer">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <span class='required'>*</span>
                                                <label for="name">Chức danh</label>
                                                <input type="text" class="form-control" id="" name="name_position" 
                                                required 
                                                value="{{$item['name']}}"
                                                >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <span class='required'>*</span>
                                                <label for="name">Số lượng tuyển</label>
                                                <input type="number" min="1" class="form-control" id="" name="number_people" 
                                                required 
                                                value="{{$item['number_people']}}">

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <span class='required'>*</span>
                                                <label for="name">Cấp bậc</label>
                                                 <select class="form-control" id="" name="id_position" required>
                                                    <option value="{{$item['id_position']}}" selected data-default>{{$item['name_chuc_vu']}}</option>
                                                   @if(isset($chuc_vu))
                                                        @foreach($chuc_vu as $value)
                                                            <option value="{{$value['id']}}">{{$value['name_chuc_vu']}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <span class='required'>*</span>
                                                <label for="exampleFormControlInput1">Mức lương</label>
                                                <select class="form-control" id="" name="id_salary" required>
                                                    <option value="{{$item['id_salary']}}" selected data-default>
                                                        {{$item['salary_min'] . '-' . $item['salary_max']. ' triệu'}}
                                                    </option>
                                                   @if(isset($salary))
                                                        @foreach($salary as $value)
                                                            <option value="{{$value['id']}}">{{$value['salary_min'] . '-'. $value['salary_max'].' triệu'}}</option>
                                                        @endforeach
                                                    @endif

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <span class='required'>*</span>
                                                <label for="exampleFormControlInput1">Địa điểm làm việc</label>
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
                                                <label for="name">Loại hình công việc</label>
                                                <select class="form-control" id="" name="id_form_of_work" required>
                                                    <option value="{{$item['id_form_of_work']}}" selected data-default>{{$item['name_form_of_work']}}</option>
                                                   @if(isset($form_of_work))
                                                        @foreach($form_of_work as $value)
                                                            <option value="{{$value['id']}}">{{$value['name_form_of_work']}}</option>
                                                        @endforeach
                                                    @endif

                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <span class="required">*</span>
                                                <label for="">Mô tả công việc</label>
                                            <div class="form-group">
                                                <textarea name="description"  rows="10" placeholder="Mô tả công việc." required>{{$item['description']}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <span class="required">*</span>
                                                <label for="">Quyền lợi được hưởng</label>
                                            <div class="form-group">
                                                <textarea name="Welfare"  rows="10" placeholder="Mô tả quyền lợi." required>{{$item['Welfare']}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h4>YÊU CẦU CÔNG VIỆC</h4>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <span class='required'>*</span>
                                                <label for="exampleFormControlInput1">Kinh nghiệm</label>
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <span class='required'>*</span>
                                                <label for="exampleFormControlInput1">Bằng cấp</label>
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <span class='required'>*</span>
                                                <label for="exampleFormControlInput1">Giới tính</label>
                                                <select class="form-control" id="" name="gender" required>
                                                    <option value="{{$item['gender']}}" selected data-default>
                                                      {{$item['gender']}}
                                                    </option>
                                                    <option value="không yêu cầu">không yêu cầu</option>
                                                    <option value="Nam">Nam</option>
                                                    <option value="Nữ">Nữ</option>
                                                   

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <span class='required'>*</span>
                                                <label for="exampleFormControlInput1">Hạn nộp hồ sơ (Tối đa 90 ngày)</label>
                                                <input type="date" value="{{$item['date_expired']}}" class="form-control" name="date_expired">
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <span class='required'>*</span>
                                                <label for="exampleFormControlInput1">Ngôn ngữ hồ sơ</label>
                                               <input type="text" name="language" value="Tiếng Việt" class="form-control">
                                            </div>
                                        </div>
                                         <div class="col-md-12">
                                            <span class="required">*</span>
                                                <label for="">Yêu cầu công việc</label>
                                            <div class="form-group">
                                                <textarea name="requirements_other"  rows="10" placeholder="Yêu cầu công việc." required>{{$item['requirements_other']}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h4>THÔNG TIN LIÊN HỆ</h4>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <span class='required'>*</span>
                                                <label for="name">Người liên hệ</label>
                                                <input type="text" class="form-control" id="" name="name_employer" 
                                                required 
                                                value="{{$item['name_employer']}}"
                                                >

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <span class='required'>*</span>
                                                <label for="name">Email liên hệ</label>
                                                <input type="email" class="form-control" id="" name="email_employer" 
                                                required 
                                                value="<?php if($item['email_employer'] === 'undefined') {echo '';}else {echo $item['email_employer'];} ?>">
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <span class='required'>*</span>
                                                <label for="name">Số điện thoại liên hệ</label>
                                                <input type="text" min="9" max="11" class="form-control" id="" name="tel_employer" 
                                                required 
                                               value="<?php if($item['tel_employer'] === 'undefined') {echo '';}else {echo $item['tel_employer'];} ?>"
                                                >

                                            </div>
                                        </div>

                                    @endforeach
                                @endif
                            	
                            </div>
                            <input type="submit" value="Cập nhật" class="btn btn-info">
                        </div>
                        <div class="col-md-4 ">
                        	<div class="contentRight">
                        		<p class="icon"><i class="far fa-question-circle"></i></p>
                        	<h2>QUY ĐỊNH DUYỆT TIN TẠI WORK24</h2>
                        	<p>Quý khách vui lòng đoc kỹ quy định duyệt tin của MyWork để đảm bảo tin đăng hợp lệ:</p>
                        	<div class="tab_intro">
                        		<div class="intro_item row">
                        			<div class="col-md-2">
                        				<span>1</span>
                        			</div>
                        			<div class="col-md-10">
                        				<p><strong>KHÔNG</strong> viết in hoa hoặc không dấu toàn bộ nội dung tin tuyển dụng.</p>
                        			</div>
                        		</div>
                        		<div class="intro_item row">
                        			<div class="col-md-2">
                        				<span>2</span>
                        			</div>
                        			<div class="col-md-10">
                        				<p>Tên, địa chỉ công ty phải ghi rõ ràng, đầy đủ.</p>
                        			</div>
                        		</div>
                        		<div class="intro_item row">
                        			<div class="col-md-2">
                        				<span>3</span>
                        			</div>
                        			<div class="col-md-10">
                        				<p><strong>KHÔNG</strong> để cả nội dung tuyển dụng trong thông tin giới thiệu về công ty.</p>
                        			</div>
                        		</div>
                        		<div class="intro_item row">
                        			<div class="col-md-2">
                        				<span>4</span>
                        			</div>
                        			<div class="col-md-10">
                        				<p>Tiêu đề tin tuyển dụng: <strong>KHÔNG</strong> chứa các nội dung như: Tuyển gấp, hot, cần gấp, lương cao. <strong>KHÔNG</strong> sử dụng các ký tự đặc biệt: %@$*... </p>
                        			</div>
                        		</div>
                        		<div class="intro_item row">
                        			<div class="col-md-2">
                        				<span>5</span>
                        			</div>
                        			<div class="col-md-10">
                        				<p>Tin <strong>KHÔNG</strong> được trùng với tin đăng trước còn hạn, hoặc ở một tài khoản khác của cùng một doanh nghiệp đã đăng trước đó.</p>
                        			</div>
                        		</div>
                        		<div class="intro_item row">
                        			<div class="col-md-2">
                        				<span>6</span>
                        			</div>
                        			<div class="col-md-10">
                        				<p><strong>KHÔNG</strong> ể email liên hệ, số điện thoại liên hệ, website công ty ở các phần nội dung yêu cầu hay mô tả công việc.</p>
                        			</div>
                        		</div>
                        	</div>
                        	</div>
                        </div>
                	</div>

                     {!! csrf_field() !!}
                </form>
            </div>
        </section>
</main>
	
@endsection