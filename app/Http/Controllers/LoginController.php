<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Validator;
use Auth;
use DB;
use App\loginModel;
use App\InfoProfile;
use App\Category;
use App\Cities;
use App\Employers;
use App\Company;
use App\Skill;
use Session;
class LoginController extends Controller
{
    public function getLogin_ntv() {
    	return view('formLogin.login_ntv');
    }

    public function postLogin_ntv(Request $request) {
    	$rules = [
    		'email' => 'required|email',
    		'password' => 'required|min:8'
    	];
    	$messagers = [
    		'email.required' => 'Email là trường bắt buộc',
    		'email.email' => 'Email không đúng định dạng',
    		'password.required' => 'Mật khẩu là trường bắt buộc',
    		'password.min' => 'Mật khẩu phải lớn hơn 8 ký tự'
    	];
    	$validator = Validator::make($request->all(), $rules, $messagers);

    	if($validator->fails()) {
    		return redirect()->back()->withErrors($validator)->withInput();
    	}else {
    		$email = $request->input('email');
    		$password = $request->input('password');


            $result = loginModel::where([['email','=',$email],['password','=',$password]])->first();
            if ($result) {
                Session::put('user_name', $result->name);
                Session::put('id_user', $result->id);
                Session::put('roles', $result->roles);
                Session::put('message_success', 'Đăng nhập thành công');
                return Redirect::to('trang-ca-nhan');
            }else {
                Session::put('message_err', 'Mật khẩu hoặc tài khoản không đúng, Vui lòng nhập lại');
               return redirect()->back();
            }
    		
    	}

    }

    public function getLogin_ntd() {
        return view('formLogin.login_ntd');
    }

    public function postLogin_ntd(Request $request) {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ];
        $messagers = [
            'email.required' => 'Email là trường bắt buộc',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu là trường bắt buộc',
            'password.min' => 'Mật khẩu phải lớn hơn 8 ký tự'
        ];
        $validator = Validator::make($request->all(), $rules, $messagers);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else {
            $email = $request->input('email');
            $password = $request->input('password');


            $result = Employers::where([['email','=',$email],['password','=',$password]])->first();
            if ($result) {
                Session::put('user_name', $result->name_employer);
                Session::put('id_employer', $result->id);
                Session::put('roles', $result->roles);
                Session::put('message_success', 'Đăng nhập thành công');
                return Redirect::to('nha-tuyen-dung');
            }else {
                Session::put('message_err', 'Mật khẩu hoặc tài khoản không đúng, Vui lòng nhập lại');
               return redirect()->back();
            }
            
        }
    }

    // xu ly logout
    public function getLogout() {
        Session::put('user_name', null);
        Session::put('id_user', null);
        Session::put('id_employer', null);
        Session::put('id_admin', null);
        Session::put('roles', null);
        Session::put('name_position', null);
        return Redirect::to('/');
    }



    // xu ly register
    public function getRegister_ntv() {
        return view('formLogin.register_ntv');
    }
    public function postRegister_ntv(Request $request) {

        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ];
        $messagers = [
            'email.required' => 'Email là trường bắt buộc',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu là trường bắt buộc',
            'password.min' => 'Mật khẩu phải lớn hơn 8 ký tự',
            'name.required' => 'Họ và tên là trường bắt buộc'
        ];
        

        if($request->has('name') && $request->has('email') && $request->has('password') && $request->has('againpass')){

            $validator = Validator::make($request->all(), $rules, $messagers);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }else {
                $name=$request->name;
                $email=$request->email;
                $password=$request->password;
                $againpass=$request->againpass;

                if($password === $againpass) {
                    $result = loginModel::all();
                    if(count($result) > 0){
                        foreach($result as $value) {
                            if($value['email'] === $email) {
                               Session::put('message_email', 'Email này đã tồn tại trên hệ thống!');
                                return redirect()->back();
                            } else {
                                $skill = new Skill;
                                $skill->des_skill = '';
                                $skill->name_skill='';
                                $skill->save();


                                $info_profile = new InfoProfile;
                                $info_profile->name_position = '';
                                $info_profile->id_degree=1;
                                $info_profile->id_experience=1;
                                $info_profile->id_cities=1;
                                $info_profile->id_category=1;
                                $info_profile->id_form_of_work=1;
                                $info_profile->id_chuc_vu=1;
                                $info_profile->id_salary=1;
                                $info_profile->description='';
                                $info_profile->save();


                                $table = new loginModel;
                                $table->name=$name;
                                $table->email=$email;
                                $table->tel='';
                                $table->password=$password;
                                $table->birthday="";
                                $table->address="";
                                $table->gender="";
                                $table->marital_status="";
                                $table->id_skill=$skill->id;
                                $table->id_info_profile=$info_profile->id;
                                $table->avatar="";
                                $table->roles=-1;
                                $table->save();


                                 Session::put('message_success', 'Đăng ký thành công');
                               return Redirect::to('login_ntv');
                            }
                        }
                    }else {
                         $skill = new Skill;
                         $skill->des_skill = '';
                         $skill->name_skill='';
                         $skill->save();

                        $info_profile = new InfoProfile;
                        $info_profile->name_position = '';
                        $info_profile->id_degree=1;
                        $info_profile->id_experience=1;
                        $info_profile->id_cities=1;
                        $info_profile->id_category=1;
                        $info_profile->id_form_of_work=1;
                        $info_profile->id_chuc_vu=1;
                        $info_profile->id_salary=1;
                        $info_profile->description='';
                        $info_profile->save();


                        $table = new loginModel;
                        $table->name=$name;
                        $table->email=$email;
                        $table->tel='';
                        $table->password=$password;
                        $table->birthday="";
                        $table->address="";
                        $table->gender="";
                        $table->marital_status="";
                        $table->id_skill=$skill->id;
                        $table->id_info_profile=$info_profile->id;
                        $table->avatar="";
                        $table->roles=-1;
                        $table->save();

                        Session::put('message_success', 'Đăng ký thành công');
                        return Redirect::to('login_ntv');

                    }

                }else {
                    Session::put('message_pass', 'Mật khẩu không khớp, vui lòng nhập lại !');
                    return redirect()->back();
                }
                
            }

        }
    }

    public function getRegister_ntd() {
        $category = Category::all();
        $cities = Cities::all();
        return view('formLogin.register_ntd', compact('category', 'cities'));
    }
    public function postRegister_ntd(Request $request) {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:8',
            'tel' => 'required|max:11',
            'tel' => 'required|min:10'
        ];
        $messagers = [
            'email.required' => 'Email là trường bắt buộc',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu là trường bắt buộc',
            'password.min' => 'Mật khẩu phải lớn hơn 8 ký tự',
            'name.required' => 'Họ và tên là trường bắt buộc',
            'tel.required' => 'Số điện thoại là trường bắt buộc',
            'tel.max' => 'Số điện thoại không phù hợp',
            'tel.min' => 'Số điện thoại không phù hợp'
        ];

        if($request->has('email') && $request->has('tel') && $request->has('password') && $request->has('confirm_pass')) {

            $validator = Validator::make($request->all(), $rules, $messagers);

            $name_employer = $request->name_employer;        
            $email = $request->email;        
            $tel = $request->tel;        
            $name_company = $request->name_company;        
            $cities = $request->cities;        
            $password = $request->password;        
            $confirm_pass = $request->confirm_pass; 


            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }else {
                if($password === $confirm_pass) {
                    $result = Employers::all();
                    $id_company = Employers::orderBy('id_company', 'desc')->limit(1)->get();
                    if(count($result) > 0) {
                        foreach($result as $value) {
                            if($value['email'] === $email) {
                                Session::put('message_email', 'Email này đã tồn tại trên hệ thống!');
                                return redirect()->back();
                            }else {
                                $company = new Company;
                                $company->logo = '';
                                $company->name_company = $name_company;
                                $company->address = '';
                                $company->id_cities = $cities;
                                $company->id_quy_mo = 1;
                                $company->website = '';
                                $company->introduce = '';
                                $company->save();

                                $table = new Employers;
                                $table->id_company = $company->id;
                                $table->name_employer = $name_employer;
                                $table->tel_employer = $tel;
                                $table->email_employer = '';
                                $table->email = $email;
                                $table->password = $password;
                                $table->roles=1;

                                $table->save();

                                Session::put('message_success', 'Đăng ký thành công');
                                return Redirect::to('login_ntd');
                            }
                        } 
                    }else {
                        $company = new Company;
                        $company->logo = '';
                        $company->name_company = $name_company;
                        $company->address = '';
                        $company->cities = $cities;
                        $company->quy_mo = '';
                        $company->website = '';
                        $company->introduce = '';
                        $company->save();

                        $table = new Employers;
                        $table->id_company = $company->id;
                        $table->name_employer = $name_employer;
                        $table->tel_employer = $tel;
                        $table->email_employer = '';
                        $table->email = $email;
                        $table->password = $password;
                        $table->roles=1;

                        $table->save();

                        Session::put('message_success', 'Đăng ký thành công');
                        return Redirect::to('login_ntd');
                    }
                }else {
                    Session::put('message_pass', 'Mật khẩu không khớp, vui lòng nhập lại !');
                    return redirect()->back();
                }
            }
        }

    }
}
