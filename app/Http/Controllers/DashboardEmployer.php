<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Degree;
use App\FormOfWork;
use App\Salary;
use App\Cities;
use App\Category;
use App\Chuc_vu;
use App\Experience;
use App\Employers;
use App\Jobs;
use App\Company;
use App\Quy_mo;
use App\InfoProfile;
use App\ProfileSave;
use App\Apply;
use Session;

class DashboardEmployer extends Controller
{
   function __construct() {
      $degree = Degree::all();
      $form_of_work = FormOfWork::all();
      $salary = Salary::all();
      $cities = Cities::all();
      $category = Category::all();
      $chuc_vu = Chuc_vu::all();
      $experience = Experience::all();
      $quy_mo = Quy_mo::all();


      view()->share('degree', $degree);
      view()->share('form_of_work', $form_of_work);
      view()->share('salary', $salary);
      view()->share('cities', $cities);
      view()->share('category', $category);
      view()->share('chuc_vu', $chuc_vu);
      view()->share('experience', $experience);
      view()->share('quy_mo', $quy_mo);
   }
   public function index() {  

    $id_employer = Session::get('id_employer');

    $postJob = Jobs::all()->where('id_employer', '=', $id_employer);
    $profileSave = ProfileSave::where('id_employer', '=', $id_employer)
                              ->where('profile_save.status', '=', 1)
                              ->get();
    $postJobNew = Jobs::join('employers', 'employers.id', 'jobs.id_employer')
                        ->select('jobs.*', 'employers.name_employer')
                        ->where('id_employer', '=', $id_employer)
                        ->orderby('id', 'desc')
                        ->limit(1)->get();
   
   	$active1 = 'active';
   	return view('DashboardEmployer.employer', compact('active1', 'postJob', 'profileSave', 'postJobNew'));
   }

   // post tin
   public function postJob() {

       $getId = Session::get('id_employer');
      $employer = Employers::where('id', $getId)->get();
   	
   	$active3 = 'active';
   	return view('dashboardEmployer.postJob', compact('active3', 'employer'));
   }

   public function handPostJob(Request $request) {


   	// table employer
   	$getId = Session::get('id_employer');

   	$table = Employers::find($getId);

   	$table->name_employer = $request->name_employer;
   	$table->tel_employer = $request->tel_employer;
   	$table->email_employer = $request->email_employer;
   

   	$table->save();

   	$name = $request->name_position;
   	$number_people = $request->number_people;
   	$id_position = $request->id_position;
   	$id_form_of_work = $request->id_form_of_work;
   	$id_cities = $request->id_cities;
   	$id_category = $request->id_category;
   	$id_salary = $request->id_salary;
   	$description = $request->description;
   	$welfare = $request->welfare;
   	$id_experience = $request->id_experience;
   	$id_degree = $request->id_degree;
   	$gender = $request->gender;
   	$date_expired = $request->date_expired;
   	$language = $request->language;
   	$requirements_other = $request->requirements_other;


   	$arr_date = explode('-', $date_expired);
   	$str_date = '';
   	foreach($arr_date as $value) {
   		$str_date .= $value . '-';
   	}
   	$str_date = rtrim($str_date, '-');

   	$postJob = new Jobs;
   	$postJob->id_employer = $getId;
   	$postJob->name = $name;
   	$postJob->id_salary = $id_salary;
   	$postJob->id_experience = $id_experience;
   	$postJob->id_degree = $id_degree;
   	$postJob->number_people = $number_people;
   	$postJob->id_position = $id_position;
   	$postJob->id_form_of_work = $id_form_of_work;
   	$postJob->gender = $gender;
   	$postJob->id_category = $id_category;
   	$postJob->id_cities = $id_cities;
   	$postJob->description = $description;
   	$postJob->Welfare = $welfare;
   	$postJob->requirements_other = $requirements_other;
   	$postJob->language = $language;
   	$postJob->date_expired = $str_date;
    $postJob->status = 0;

   	$postJob->save();

     Session::put('addted_job', 'Thêm việc làm thành công');
   	return Redirect::to('all-post-job');

   }

   public function getAllPost() {
   	$getId = Session::get('id_employer');

      $data = Jobs::join('employers', 'employers.id', '=', 'jobs.id_employer')
                  ->select('jobs.*')
                  ->where('jobs.id_employer', '=', $getId)
                  ->get();



   	$active4 = 'active';
   	return view('DashboardEmployer.allPost', compact('active4', 'data'));
   }

   public function deletePostJob($id) {
      $data = Jobs::find($id);
      $data->delete();

      Session::put('deleted', 'Xóa thành công việc làm');
      
      return redirect()->back();
   }

   public function getEditJob($id) {
      $data = Jobs::join('employers', 'employers.id', '=', 'jobs.id_employer')
                     ->join('chuc_vu', 'chuc_vu.id', '=', 'jobs.id_position')
                     ->join('form_of_work', 'form_of_work.id', '=', 'jobs.id_form_of_work')
                     ->join('salary', 'salary.id', '=', 'jobs.id_salary')
                     ->join('cities', 'cities.id', '=', 'jobs.id_cities')
                     ->join('category', 'category.id', '=', 'jobs.id_category')
                     ->join('experience', 'experience.id', '=', 'jobs.id_experience')
                     ->join('degree', 'degree.id', '=', 'jobs.id_degree')
                     ->select('jobs.*', 'employers.name_employer', 'employers.email_employer', 'employers.tel_employer', 'experience.name_experience', 'degree.name_degree', 'cities.name_cities', 'category.name_category', 'salary.salary_min', 'salary_max', 'chuc_vu.name_chuc_vu', 'form_of_work.name_form_of_work')
                     ->where('jobs.id', '=', $id)
                     ->get();

      return view('DashboardEmployer.editPostJob', compact('data'));

   }
   public function postEditJob(Request $request) {
        $id_job = $request->id_job;
        $id_employer = $request->id_employer;
        $name_employer = $request->name_employer;
        $email_employer = $request->email_employer;
        $tel_employer = $request->tel_employer;

        $updateEmployer = Employers::find($id_employer);
        $updateEmployer->name_employer = $name_employer;
        $updateEmployer->email_employer = $email_employer;
        $updateEmployer->tel_employer = $tel_employer;

        $updateEmployer->save();

        $updateJob = Jobs::find($id_job);
        $updateJob->name = $request->name_position;
        $updateJob->id_salary = $request->id_salary;
        $updateJob->id_experience = $request->id_experience;
        $updateJob->id_degree = $request->id_degree;
        $updateJob->number_people = $request->number_people;
        $updateJob->id_position = $request->id_position;
        $updateJob->id_form_of_work = $request->id_form_of_work;
        $updateJob->gender = $request->gender;
        $updateJob->id_category = $request->id_category;
        $updateJob->id_cities = $request->id_cities;
        $updateJob->description = $request->description;
        $updateJob->Welfare = $request->Welfare;
        $updateJob->requirements_other = $request->requirements_other;
        $updateJob->language = $request->language;
        $updateJob->date_expired = $request->date_expired;
        $updateJob->status = 0;

        $updateJob->save();
        Session::put('updated_job', 'Cập nhật việc làm thành công');
        return Redirect::to('all-post-job');
   }

   public function updateCompany() {
      $getId = Session::get('id_employer');
      $employer = Employers::where('id', $getId)->get();

      $data = Company::join('employers', 'employers.id_company', '=', 'company.id')
                        ->join('quy_mo', 'quy_mo.id', '=', 'company.id_quy_mo')
                        ->select('company.*', 'employers.name_employer', 'employers.tel_employer','employers.email_employer', 'employers.email', 'quy_mo.name_quy_mo')
                        ->where('employers.id', '=', $getId)
                        ->get();
      $id_cities = (int)$data[0]['id_cities'];
      $name_cities = Cities::where('id', $id_cities)->select('name_cities')->get();

     return view('DashBoardEmployer.updateCompany', compact('data', 'employer', 'name_cities'));

   }

   public function postUpdateCompany(Request $request) {
      $getId = Session::get('id_employer');

      if ($request->hasFile('logo')) {
            $file = $request->logo;
            $pathName = $file->move('frontend/uploadCompany', $file->getClientOriginalName());
            $logo = "http://localhost/work24/public/" . $pathName ;
        }else {
            $logo = "http://localhost/work24/public/frontend/images/no-logo.png";
        }
      
      
      

      $table = Employers::find($getId);

      $table->name_employer = $request->name_employer;
      $table->tel_employer = $request->tel_employer;
      $table->email_employer = $request->email_employer;

      $table->save();

      $company = Company::find($table->id_company);
      $company->name_company = $request->name_company;
      $company->logo = $logo;
      $company->address = $request->address;
      $company->id_quy_mo = $request->id_quy_mo;
      $company->id_cities = $request->id_cities;
      $company->website = $request->website;
      $company->introduce = $request->introduce;

      $company->save();

      Session::put('updated', 'cập nhật thành công !');
      return Redirect::to('nha-tuyen-dung/thong-tin-tai-khoan');
    
   }
   public function all_profile_save() {
      $id_employer = Session::get('id_employer');
      $data_profile_save = InfoProfile::join('users', 'users.id_info_profile', '=', 'info_profile.id')
                                ->join('profile_save', 'profile_save.id_profile', '=', 'info_profile.id')
                                ->select('users.name', 'info_profile.name_position', 'profile_save.*')
                                ->where('profile_save.id_employer', '=', $id_employer)
                                ->get();
      return view('DashboardEmployer.profile_save', compact('data_profile_save'));
   }

   public function getUpdateProfileSave($id) {
      $data = ProfileSave::find($id);
      $data->status = !$data->status;
      $data->save();

      Session::put('updated', 'Bỏ lưu thành công');
      return redirect()->back();
   }
   public function profile_apply() {

      $id_employer = Session::get('id_employer');
      $apply = Apply::join('jobs', 'jobs.id', 'apply.id_job')
                      ->join('employers', 'employers.id', 'jobs.id_employer')
                      ->join('users', 'users.id', 'apply.id_user')
                      ->where('employers.id', $id_employer)
                      ->select('apply.*', 'jobs.name as name_position', 'users.name', 'users.id_info_profile')
                    ->get();
      return view('DashBoardEmployer.profile_apply', compact('apply'));
   }
   public function updateJobApply($id) {
    $apply = Apply::find($id);
    $apply->status = 0;
    $apply->save();

    Session::put('updated', 'Xoá thành công hồ sơ ứng tuyển');
    return redirect()->back();
   }

   public function getChangePass() {
      $active6 = 'active';
      return view('dashboardEmployer.change_pass', compact('active6'));
   }
    public function postChangePass(Request $request) {
        $pass_old = $request->pass_old;
        $pass_new = $request->pass_new;
        $again_pass_new = $request->again_pass_new;

        $id_employer = Session::get('id_employer');

        $employer = Employers::find($id_employer);

        if($pass_old === $employer->password) {
            if(strlen($pass_new) >= 8 && strlen($again_pass_new) >= 8 ) {
                if($pass_new === $again_pass_new) {
                    $employer = Employers::find($id_employer);
                    $employer->password = $pass_new;
                    $employer->save();
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
