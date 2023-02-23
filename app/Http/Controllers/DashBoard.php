<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\Degree;
use App\Experience;
use App\Cities;
use App\Category;
use App\Chuc_vu;
use App\FormOfWork;
use App\Salary;
use App\loginModel;
use App\InfoProfile;
use App\Skill;
use App\Apply;
use App\jobSave;
use App\Jobs;

class DashBoard extends Controller
{
    function __construct() {
        $userAvatar = loginModel::all();
        
        view()->share('userAvatar', $userAvatar);

    }

    // lấy ra việc làm đã lưu mới nhất và tổng số việc đã lưu
    public function index() {
        $id_user = Session::get('id_user');
        $info_profile_user = loginModel::join('info_profile', 'info_profile.id', '=', 'users.id_info_profile')
                        ->where('users.id', '=', $id_user)
                        ->get();
        $name_position = $info_profile_user[0]['name_position'];
        $jobsFit = Jobs::where('name', 'LIKE', '%'.$name_position.'%')
                    ->get();

        $jobSaveNew = jobSave::join('jobs', 'jobs.id', '=', 'jobs_save.id_job')
                            ->join('employers', 'employers.id', '=', 'jobs.id_employer')
                            ->join('company', 'company.id', 'employers.id_company')
                            ->select('jobs_save.*', 'jobs.name', 'company.name_company')
                            ->where('jobs_save.id_user', '=', $id_user)
                            ->orderby('id', 'desc')
                            ->limit(1)
                            ->get();
         $jobSave = jobSave::join('jobs', 'jobs.id', '=', 'jobs_save.id_job')
                            ->join('employers', 'employers.id', '=', 'jobs.id_employer')
                            ->join('company', 'company.id', 'employers.id_company')
                            ->join('salary', 'salary.id', 'jobs.id_salary')
                            ->select('jobs_save.*', 'jobs.name','jobs.date_expired', 'company.name_company', 'salary.salary_min', 'salary.salary_max')
                            ->where('jobs_save.id_user', '=', $id_user)
                            ->get();
         $jobs_apply = Apply::where('id_user', $id_user)->get();

        $active1 = 'active';
    	return view('dashboard.trang-ca-nhan-ntv', compact('active1', 'jobSaveNew', 'jobSave', 'jobsFit', 'jobs_apply'));
    }

    public function quanLyHoSo() {
        $id_user = Session::get('id_user');
        $position = loginModel::join('info_profile', 'info_profile.id', 'users.id_info_profile')
                                    ->where('users.id', $id_user)
                                    ->select('info_profile.name_position', 'info_profile.created_at', 'info_profile.updated_at')
                                    ->get();
        $active2 = 'active';
    	return view('dashboard.quan-ly-ho-so', compact('active2', 'position'));
    }
    public function getUpdateInfo() {
    	$id_user = Session::get('id_user');
    	$user = loginModel::all()->where('id', $id_user);
    	return view('dashboard.updateInfo', compact('user'));
    }

    // chỉnh sửa thông tin cá nhân
    public function postUpdateInfo(Request $request) {

        if ($request->hasFile('avatar')) {
            $file = $request->avatar;
            $pathName = $file->move('uploadAvatar', $file->getClientOriginalName());
            $avatar = "http://localhost/work24/public/" . $pathName;
        }else {
            $avatar = "http://localhost/work24/public/frontend/images/avatar/male_avatar.jpg";
        }

    	$id_user = Session::get('id_user');
    	$updateInfo = loginModel::find($id_user);
    	$ngay = $request->ngay;
    	$thang = $request->thang;
    	$nam = $request->nam;

    	$get_date = $ngay . '-' . $thang . '-' . $nam;
    	
	    $updateInfo->name = $request->name;
	    $updateInfo->email = $request->email;
        $updateInfo->avatar = $avatar;
	    $updateInfo->tel = $request->tel;
	    $updateInfo->address = $request->address;
	    $updateInfo->birthday = $get_date;
	    $updateInfo->gender = $request->gender;
	    $updateInfo->marital_status = $request->marital_status;

	    $updateInfo->save();

        Session::put('message_b1','Cập nhật thành công!');

        Session::put('created_at', $updateInfo->created_at);
        Session::put('updated_at', $updateInfo->updated_at);
        return Redirect::to('hoan-thien-ho-so/buoc/2');

    }

    public function getInfoProfile() {
        $degree = Degree::all();
        $experience = Experience::all();
        $cities = Cities::all();
        $category = Category::all();
        $chuc_vu = Chuc_vu::all();
        $form_of_work = FormOfWork::all();
        $salary = Salary::all();

        $id_user = Session::get('id_user');

        $valueDefault = InfoProfile::join('degree','info_profile.id_degree', 'degree.id')
                                    ->join('experience', 'info_profile.id_experience', '=', 'experience.id')
                                    ->join('cities', 'info_profile.id_cities', '=', 'cities.id')
                                    ->join('category', 'info_profile.id_category', '=', 'category.id')
                                    ->join('chuc_vu', 'info_profile.id_chuc_vu', '=', 'chuc_vu.id')
                                    ->join('form_of_work', 'info_profile.id_form_of_work', '=', 'form_of_work.id')
                                    ->join('salary', 'info_profile.id_salary', '=', 'salary.id')
                                    ->join('users', 'users.id_info_profile', '=', 'info_profile.id')
                                    ->select('info_profile.*', 'degree.name_degree', 'experience.name_experience','cities.name_cities','category.name_category','chuc_vu.name_chuc_vu','form_of_work.name_form_of_work','salary.salary_min', 'salary.salary_max')
                                    ->where('users.id', '=', $id_user)
                                    ->get();

     return view('dashboard.infoProfile', compact('degree', 'experience', 'cities', 'category', 'chuc_vu', 'form_of_work', 'salary', 'valueDefault'));
    }

    // chỉnh sửa hồ sơ
    public function postInfoProfile(Request $request) {
        $id_user = Session::get('id_user');
        $user = loginModel::find($id_user);
        $infoProfile = InfoProfile::find($user->id_info_profile);
        
        $infoProfile->name_position = $request->name_position;
        $infoProfile->id_degree = $request->id_degree;
        $infoProfile->id_experience = $request->id_experience;
        $infoProfile->id_cities = $request->id_cities;
        $infoProfile->id_category = $request->id_category;
        $infoProfile->id_form_of_work = $request->id_form_of_work;
        $infoProfile->id_chuc_vu = $request->id_chuc_vu;
        $infoProfile->id_salary = $request->id_salary;
        $infoProfile->description = $request->description;

        $infoProfile->save();

        Session::put('message_b2', 'Cập nhật thành công!');

        Session::put('created_at', $infoProfile->created_at);
        Session::put('updated_at', $infoProfile->updated_at);
        
        Session::put('name_position', $infoProfile->name_position);
        return Redirect::to('hoan-thien-ho-so/buoc/3');
 
    }
     
    public function getSkill() {
        $id_user = Session::get('id_user');
        $skill_value = Skill::join('users', 'users.id_skill', '=', 'skill.id')
                            ->select('skill.*')
                            ->where('users.id', '=', $id_user)
                            ->get();
        return view('dashboard.skill', compact('skill_value'));
    }
     // chỉnh sửa kỹ năng
    public function postSkill(Request $request) {
        if($request->des_skill !== null) {
             $arr_skill = $request->input('skill');
            $str_skill = '';
            if(isset($arr_skill)) {
                foreach($arr_skill as $value) {
                    $str_skill .= $value . '@';
                }
            }
            

            $skill = Skill::find($request->id_skill);

            $skill->des_skill = $request->des_skill;
            $skill->name_skill = $str_skill;

            $skill->save();

            Session::put('message_b3', 'Cập nhật thành công!');
             Session::put('updated', 'Cập nhật thành công!');
            Session::put('created_at', $skill->created_at);
            Session::put('updated_at', $skill->updated_at);


            return Redirect::to('quan-ly-ho-so');
        }else {
            Session::put('des_skill', 'Trường này không được để trống');
            return redirect()->back();
        }
       
    }


    // quan ly viec lam all viec lam da luu
    public function getJobs()
    {
        $id_user = Session::get('id_user');
        $jobSave = jobSave::join('jobs', 'jobs.id', '=', 'jobs_save.id_job')
                            ->join('employers', 'employers.id', '=', 'jobs.id_employer')
                            ->join('company', 'company.id', 'employers.id_company')
                            ->join('salary', 'salary.id', 'jobs.id_salary')
                            ->select('jobs_save.*', 'jobs.name','jobs.date_expired', 'company.name_company', 'salary.salary_min', 'salary.salary_max')
                            ->where('jobs_save.id_user', '=', $id_user)
                            ->get();
         

        $active3 = 'active';
        return view('dashboard.jobs_save', compact('active3', 'jobSave'));
    }
    public function getJobs_apply() {
        $id_user = Session::get('id_user');

        $jobs_apply = Apply::join('jobs', 'jobs.id', '=', 'apply.id_job')
                            ->join('employers', 'employers.id', 'jobs.id_employer')
                            ->join('company', 'company.id', 'employers.id_company')
                            ->join('salary', 'jobs.id_salary', '=', 'salary.id')
                            ->select('apply.*','jobs.name', 'salary.salary_min', 'salary.salary_max', 'company.name_company')
                        ->where('id_user', $id_user)->get();

        return view('dashboard.jobs_apply', compact('jobs_apply'));
    }

    // xóa công việc đa ứng tuyển
    public function delete_apply($id) {
        $apply = Apply::find($id);
        $apply->delete();

        Session::put('deleted', 'Xóa thành công việc làm ứng tuyển');
        return redirect()->back();
    }

    // xóa công việc đã lưu
    public function getUpdateJobSave($id) {
        $data = jobSave::find($id);
        $data->status = !$data->status;
        $data->save();

       Session::put('deleted', 'xóa công việc thanh công');
       return redirect()->back();
    }

    public function getChangePass() {

        $active5 = 'active';
        return view('dashboard.change_pass', compact('active5'));
    }
    public function postChangePass(Request $request) {
        $pass_old = $request->pass_old;
        $pass_new = $request->pass_new;
        $again_pass_new = $request->again_pass_new;

        $id_user = Session::get('id_user');

        $user = loginModel::find($id_user);

        if($pass_old === $user->password) {
            if(strlen($pass_new) >= 8 && strlen($again_pass_new) >= 8 ) {
                if($pass_new === $again_pass_new) {
                    $user = loginModel::find($id_user);
                    $user->password = $pass_new;
                    $user->save();
                    Session::put('change_success','Đổi mật khẩu thành công');
                    return redirect()->back();
                }else {
                    Session::put('err_pass_new','Mật khẩu không khớp');
                    return redirect()->back();
                }
            }else {
                Session::put('err_eight','Mật khẩu phải lớn hơn hoặc bằng 8 ký tự');
                return redirect()->back();
            }

        }else {
            Session::put('err_pass_old','Mật khẩu cũ không đúng');
             return redirect()->back();
        }

    }
}
