 <?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs;
use App\Category;
use App\Cities;
use App\Employers;
use App\Company;
use App\Quy_mo;
use App\jobSave;
use App\loginModel;
use App\InfoProfile;
use App\ProfileSave;
use App\Apply;
use DB;
use Session;
class PagesController extends Controller
{
    function __construct() {
        $cities = Cities::all();
        $category = Category::all();
        $company = Company::all();
        $quy_mo = Quy_mo::all();
        $jobs = Jobs::all();
        $employers = Employers::all();
        $jobs = Jobs::all();
        $users = loginModel::all();
        
        // công ty quy mô lớn
        $company_large = Company::join('quy_mo', 'company.id_quy_mo', '=', 'quy_mo.id')
                        ->select('company.*', 'quy_mo.name_quy_mo')
                        ->where('quy_mo.name_quy_mo', '=', '1000-5000')->limit(6)->get();

        // lấy ra việc làm hấp dẫn và thông tin người tuyển 
        $jobs_salary_high = Jobs::join('salary', 'jobs.id_salary', '=', 'salary.id')
                        ->join('employers', 'jobs.id_employer', '=', 'employers.id')
                        ->join('company', 'employers.id_company', '=', 'company.id')
                        ->where('salary.salary_max', '>=', 20)
                        ->where('jobs.status', '=', 1)
                        ->limit(30)->get();

        // lấy ra all job
        $data_jobs = Jobs::join('salary', 'jobs.id_salary', '=', 'salary.id')
                        ->join('employers', 'jobs.id_employer', '=', 'employers.id')
                        ->join('company', 'employers.id_company', '=', 'company.id')
                        ->select('jobs.*', 'company.name_company', 'company.logo', 'salary.salary_min', 'salary.salary_max')
                        ->where('jobs.status', '=', 1)
                        ->get();
                        

        // lấy ra việc làm mới nhất
        $jobsNew = Jobs::join('salary', 'jobs.id_salary', '=', 'salary.id')
                        ->join('employers', 'jobs.id_employer', '=', 'employers.id')
                        ->join('company', 'employers.id_company', '=', 'company.id')
                        ->select('jobs.*', 'company.name_company', 'company.logo', 'salary.salary_min', 'salary_max')
                        ->where('jobs.status', '=', 1)
                        ->orderby('jobs.created_at', 'desc')
                        ->take(7)
                        ->get();

        view()->share('cities', $cities);
        view()->share('category', $category);
        view()->share('company_large', $company_large);
        view()->share('jobs_salary_high', $jobs_salary_high);
        view()->share('data_jobs', $data_jobs);
        view()->share('jobsNew', $jobsNew);
        view()->share('jobs', $jobs);
        view()->share('employers', $employers);
        view()->share('users', $users);
    }

    public function index() {
        return view('pages.home');
    }

    // chi tiet viec lam
    public function detailJob($id, $name) {
        $id_user = Session::get('id_user');
        $cities = Cities::all();
        $jobSave = jobSave::where('id_job', '=', $id)
                            ->where('id_user', '=', $id_user)
                            ->get();
        $category = Category::all();
        $data = Jobs::join('employers', 'jobs.id_employer', '=', 'employers.id' )
                ->join('company', 'employers.id_company', '=', 'company.id')
                ->join('quy_mo', 'company.id_quy_mo', '=', 'quy_mo.id')
                ->join('salary', 'jobs.id_salary', '=', 'salary.id')
                ->join('experience', 'jobs.id_experience', '=', 'experience.id')
                ->join('degree', 'jobs.id_degree', '=', 'degree.id')
                ->join('chuc_vu', 'jobs.id_position', '=', 'chuc_vu.id')
                ->join('form_of_work', 'jobs.id_form_of_work', '=', 'form_of_work.id')
                ->select('jobs.*','employers.name_employer', 'employers.tel_employer', 'employers.email_employer', 'company.logo', 'company.name_company', 'company.address', 'quy_mo.name_quy_mo','salary.salary_min', 'salary.salary_max', 'experience.name_experience', 'degree.name_degree','chuc_vu.name_chuc_vu', 'form_of_work.name_form_of_work')
                ->where('jobs.id', '=', $id)->get();

        $str_id_cities = $data[0]['id_cities'];
        $arr_id_cities = explode(',', $str_id_cities);

         $str_id_category = $data[0]['id_category'];
         $arr_id_category = explode(',', $str_id_category);

        $arr_cities = [];
        $arr_category = [];

        foreach($cities as $value) {
            foreach($arr_id_cities as $item) {
                if($value['id'] === (int)$item) {
                   array_push($arr_cities, $value['name_cities']);
                }
            }
        }
        foreach($category as $value) {
            foreach($arr_id_category as $item) {
                if($value['id'] === (int)$item) {
                   array_push($arr_category, $value['name_category']);
                }
            }
        }
        return view('pages.detailJob', compact('data', 'arr_cities', 'arr_category', 'jobSave'));
    }
    public function tuyen_dung() {
        return view('pages.tuyen_dung');
    }

    // chi tiet cong ty
    public function detail_company($id_company, $name_company) {
        $cities = Cities::all();
        $company = Company::join('quy_mo', 'company.id_quy_mo', '=', 'quy_mo.id')
                            ->where('company.id', '=', $id_company)
                            ->get();

        // lấy ra số lượng việc làm của công ty
        $arr_jobs_company = Company::join('employers', 'employers.id_company', '=', 'company.id')
                                    ->join('jobs', 'employers.id', '=', 'jobs.id_employer')
                                    ->join('salary', 'jobs.id_salary', '=', 'salary.id')
                                    ->select('jobs.*', 'company.name_company', 'salary.salary_min', 'salary.salary_max')
                                    ->where('employers.id', '=', $id_company)
                                    ->get();

         $str_id_cities = $arr_jobs_company[0]['id_cities'];
            $arr_id_cities = explode(',', $str_id_cities);

            $arr_cities = [];
            foreach($cities as $value) {
                foreach($arr_id_cities as $item) {
                    if($value['id'] === (int)$item) {
                       array_push($arr_cities, $value['name_cities']);
                    }
                }
            }

        return view('pages.detail_company', compact('company', 'arr_cities', 'arr_jobs_company'));
    }

    // việc làm theo địa điểm
    public function city($id, $city) {
        $str_city = str_replace('-', ' ', $city);

        $data_jobs = Jobs::join('salary', 'jobs.id_salary', '=', 'salary.id')
                        ->join('employers', 'jobs.id_employer', '=', 'employers.id')
                        ->join('company', 'employers.id_company', '=', 'company.id')
                        ->join('cities', 'cities.id', '=', 'jobs.id_cities')
                        ->select('jobs.*', 'salary.salary_min', 'salary.salary_max', 'company.name_company', 'company.logo')
                        ->where('cities.id', '=', $id)
                        ->get();

        return view('pages.tuyen_dung', compact('data_jobs', 'str_city'));
    }

    // tim kiem
    public function getSearch(Request $req) {
        $name_title = $req->name_title;
        $str_nganh_nghe = $req->nganh_nghe;
        $str_city = $req->city;

        if(isset($name_title) && isset($str_nganh_nghe) && isset($str_city)) {
            $data_jobs = Jobs::join('salary', 'jobs.id_salary', '=', 'salary.id')
                        ->join('employers', 'jobs.id_employer', '=', 'employers.id')
                        ->join('company', 'employers.id_company', '=', 'company.id')
                        ->join('category', 'category.id', '=', 'jobs.id_category')
                        ->join('cities', 'cities.id', '=', 'jobs.id_cities')
                        ->where([['jobs.name', 'LIKE', '%'.$name_title.'%'], ['category.name_category', 'LIKE', '%'.$str_nganh_nghe.'%'], ['cities.name_cities', 'LIKE', '%'.$str_city.'%']])
                        ->select('jobs.*', 'company.name_company', 'company.logo', 'salary.salary_min', 'salary.salary_max')
                        ->select('jobs.*', 'company.name_company', 'company.logo', 'salary.salary_min', 'salary.salary_max')
                        ->get();


        }
        if(isset($name_title) && isset($str_nganh_nghe) && $str_city === null) {
             $data_jobs = Jobs::join('salary', 'jobs.id_salary', '=', 'salary.id')
                        ->join('employers', 'jobs.id_employer', '=', 'employers.id')
                        ->join('company', 'employers.id_company', '=', 'company.id')
                        ->join('category', 'category.id', '=', 'jobs.id_category')
                        ->where([['jobs.name', 'LIKE', '%'.$name_title.'%'], ['category.name_category', 'LIKE', '%'.$str_nganh_nghe.'%']])
                        ->select('jobs.*', 'company.name_company', 'company.logo', 'salary.salary_min', 'salary.salary_max')
                        ->get();
        }
        if(isset($name_title) && isset($str_city) && $str_nganh_nghe === null) {
             $data_jobs = Jobs::join('salary', 'jobs.id_salary', '=', 'salary.id')
                        ->join('employers', 'jobs.id_employer', '=', 'employers.id')
                        ->join('company', 'employers.id_company', '=', 'company.id')
                        ->join('cities', 'cities.id', '=', 'jobs.id_cities')
                        ->where([['jobs.name', 'LIKE', '%'.$name_title.'%'], ['cities.name_cities', 'LIKE', '%'.$str_city.'%']])
                        ->select('jobs.*', 'company.name_company', 'company.logo', 'salary.salary_min', 'salary.salary_max')
                        ->get();



        }
          if(isset($str_nganh_nghe) && isset($str_city) && $name_title === null) {
             $data_jobs = Jobs::join('salary', 'jobs.id_salary', '=', 'salary.id')
                        ->join('employers', 'jobs.id_employer', '=', 'employers.id')
                        ->join('company', 'employers.id_company', '=', 'company.id')
                        ->join('category', 'category.id', '=', 'jobs.id_category')
                        ->join('cities', 'cities.id', '=', 'jobs.id_cities')
                        ->where([['category.name_category', 'LIKE', '%'.$str_nganh_nghe.'%'], ['cities.name_cities', 'LIKE', '%'.$str_city.'%']])
                        ->select('jobs.*', 'company.name_company', 'company.logo', 'salary.salary_min', 'salary.salary_max')
                        ->get();


        }
        if(isset($name_title) && $str_city === null && $str_nganh_nghe === null) {
            $data_jobs = Jobs::join('salary', 'jobs.id_salary', '=', 'salary.id')
                        ->join('employers', 'jobs.id_employer', '=', 'employers.id')
                        ->join('company', 'employers.id_company', '=', 'company.id')
                        ->where([['jobs.name', 'LIKE', '%'.$name_title.'%']])
                        ->select('jobs.*', 'company.name_company', 'company.logo', 'salary.salary_min', 'salary.salary_max')
                        ->get();
            
        }
        if(isset($str_nganh_nghe) && $name_title === null && $str_city === null) {
            $data_jobs = Jobs::join('salary', 'jobs.id_salary', '=', 'salary.id')
                       ->join('employers', 'jobs.id_employer', '=', 'employers.id')
                        ->join('company', 'employers.id_company', '=', 'company.id')
                        ->join('category', 'category.id', '=', 'jobs.id_category')
                        ->where([['category.name_category', 'LIKE', '%'.$str_nganh_nghe.'%']])
                        ->select('jobs.*', 'company.name_company', 'company.logo', 'salary.salary_min', 'salary.salary_max')
                        ->get();

        }
        if(isset($str_city) && $name_title === null && $str_nganh_nghe === null) {
            $data_jobs = Jobs::join('salary', 'jobs.id_salary', '=', 'salary.id')
                       ->join('employers', 'jobs.id_employer', '=', 'employers.id')
                        ->join('company', 'employers.id_company', '=', 'company.id')
                        ->join('cities', 'cities.id', '=', 'jobs.id_cities')
                        ->where([['cities.name_cities', 'LIKE', '%'.$str_city.'%']])
                        ->select('jobs.*', 'company.name_company', 'company.logo', 'salary.salary_min', 'salary.salary_max')
                        ->get();


        }
        if($name_title === null && $str_nganh_nghe === null && $str_city === null) {
             $data_jobs = Jobs::join('salary', 'jobs.id_salary', '=', 'salary.id')
                               ->join('employers', 'jobs.id_employer', '=', 'employers.id')
                                ->join('company', 'employers.id_company', '=', 'company.id')
                                ->select('jobs.*', 'company.name_company', 'company.logo', 'salary.salary_min', 'salary.salary_max')
                                ->get();
        }


        return view('pages.search', compact('data_jobs', 'name_title', 'str_nganh_nghe', 'str_city'));
        
    }

    // tim kiem ung vien
    public function search_users(Request $request) {
         $name_position = $request->name_position;
         $str_city = $request->city;

         if(isset($name_position) && $str_city === null) {
            $data = loginModel::join('info_profile', 'info_profile.id', '=', 'users.id_info_profile')
                                ->join('experience', 'experience.id', '=', 'info_profile.id_experience')
                                ->where([['info_profile.name_position', 'LIKE', '%'.$name_position.'%']])
                                ->select('users.*','info_profile.id as id_info_profile', 'info_profile.name_position', 'experience.name_experience')
                                ->get();
         }
          if(isset($str_city) && $name_position === null) {
            $data = loginModel::join('info_profile', 'info_profile.id', '=', 'users.id_info_profile')
                                ->join('experience', 'experience.id', '=', 'info_profile.id_experience')
                                ->join('cities', 'cities.id', '=', 'info_profile.id_cities')
                                ->where([['cities.name_cities', 'LIKE', '%'.$str_city.'%']])
                                ->where('info_profile.name_position', '<>', '')
                                ->select('users.*','info_profile.id as id_info_profile', 'info_profile.name_position', 'experience.name_experience')
                                ->get();


         }
         if(isset($str_city) && isset($name_position)) {
            $data = loginModel::join('info_profile', 'info_profile.id', '=', 'users.id_info_profile')
                                ->join('experience', 'experience.id', '=', 'info_profile.id_experience')
                                ->join('cities', 'cities.id', '=', 'info_profile.id_cities')
                                ->where([['info_profile.name_position', 'LIKE', '%'.$name_position.'%'], ['cities.name_cities', 'LIKE', '%'.$str_city.'%']])
                                ->select('users.*','info_profile.id as id_info_profile', 'info_profile.name_position', 'experience.name_experience')
                                ->get();
         }
         if($str_city === null && $name_position === null) {
            $data = loginModel::join('info_profile', 'info_profile.id', '=', 'users.id_info_profile')
                            ->join('experience', 'experience.id', '=', 'info_profile.id_experience')
                            ->select('users.*','info_profile.id as id_info_profile', 'experience.name_experience', 'info_profile.name_position')
                            ->get();
         }

         return view('pages.ung_vien', compact('data', 'name_position', 'str_city'));
       
    }

    // viec lam da luu
    public function save_job($id) {
        $id_user = Session::get('id_user');

        $jobSave = jobSave::all()->where('id_job', '=', $id)
                                ->where('id_user', '=', $id_user);

        if(count($jobSave) > 0) {
           foreach($jobSave as $value) {
            $update = jobSave::find($value['id']);
            $update->status = !$update->status;
            $update->save();
           }
        }else {
            $table = new jobSave;
            $table->id_job = $id;
            $table->id_user = $id_user;
            $table->status = 1;
            $table->save();
        }

        return redirect()->back();
    }
    // profile save
    public function profile_save($id) {
        $id_employer = Session::get('id_employer');
        $check_id_employer = ProfileSave::where('id_employer', '=', $id_employer)->get();
        if(count($check_id_employer) > 0) {
            $profileSave = ProfileSave::where('id_profile', '=', $id)
                                        ->where('id_employer', '=', $id_employer)
                                        ->get();
            if(count($profileSave) > 0) {
                foreach($profileSave as $value) {
                    $update = ProfileSave::find($value['id']);
                    $update->status = !$update->status;
                    $update->save();
                }
            }else {
                $table = new ProfileSave;
                $table->id_profile = $id;
                $table->id_employer = $id_employer;
                $table->status = 1;
                $table->save();
            }
        }else {
            $table = new ProfileSave;
            $table->id_profile = $id;
            $table->id_employer = $id_employer;
            $table->status = 1;
            $table->save();
        }
        
       return redirect()->back();
    }

    public function getCompany() {
        $company = Company::limit(12)->get();
        return view('Pages.company', compact('company'));
    }

    public function searchCompany(Request $request) {
        $name_company = $request->name_company;

        if(strlen($name_company) > 0) {
            $company = Company::where('name_company', 'LIKE', '%'.$name_company.'%')->get();
        }
        return view('Pages.company', compact('company', 'name_company'));
    }

    public function ung_vien() {
        $data = loginModel::join('info_profile', 'info_profile.id', '=', 'users.id_info_profile')
                            ->join('experience', 'experience.id', '=', 'info_profile.id_experience')
                            ->where('info_profile.name_position', '<>', '')
                            ->select('users.*', 'info_profile.id as id_info_profile', 'experience.name_experience', 'info_profile.name_position')
                            ->get();

        return view('pages.ung_vien', compact('data'));
    }

    public function profile($id, $name_position) {
        $id_employer = Session::get('id_employer');
        $profile_save = ProfileSave::all()->where('id_profile', '=', $id)
                                        ->where('id_employer', '=', $id_employer);
        $data_profile = loginModel::join('skill', 'skill.id', '=', 'users.id_skill')
                        ->join('info_profile', 'info_profile.id','=', 'users.id_info_profile')
                        ->join('degree', 'degree.id','=', 'info_profile.id_degree')
                        ->join('experience', 'experience.id', 'info_profile.id_experience')
                        ->join('cities', 'cities.id', '=', 'info_profile.id_cities')
                        ->join('category', 'category.id', '=', 'info_profile.id_category')
                        ->join('form_of_work', 'form_of_work.id','=', 'info_profile.id_form_of_work')
                        ->join('chuc_vu', 'chuc_vu.id', '=', 'info_profile.id_chuc_vu')
                        ->join('salary', 'salary.id', '=', 'info_profile.id_salary')
                        ->select('users.*','info_profile.id as id_info_profile', 'info_profile.name_position','info_profile.description', 'info_profile.name_position', 'info_profile.description' , 'degree.name_degree', 'experience.name_experience', 'cities.name_cities', 'category.name_category', 'form_of_work.name_form_of_work','chuc_vu.name_chuc_vu', 'salary.salary_min', 'salary.salary_max', 'skill.des_skill', 'skill.name_skill')
                        ->where('users.id_info_profile', '=', $id)
                        ->get();


            $data_profile_new = InfoProfile::join('experience', 'experience.id', '=', 'info_profile.id_experience')
                                ->join('users', 'users.id_info_profile', '=', 'info_profile.id')
                                ->where('info_profile.name_position', '<>', '')
                                ->select('info_profile.*','info_profile.id as id_info_profile', 
                                    'experience.name_experience', 'users.name', 'users.avatar')
                                ->orderby('id', 'desc')
                                ->limit(6)
                                ->get();
        return view('pages.profile', compact('data_profile', 'data_profile_new', 'profile_save'));
    }

    // job apply 
    public function apply($id) {
         $id_user = Session::get('id_user');
        $name_position = loginModel::join('info_profile', 'info_profile.id', 'users.id_info_profile')
                                    ->where('users.id', $id_user)
                                    ->select('info_profile.name_position')
                                    ->get();
        if(isset($name_position) && $name_position[0]['name_position'] !== '')
        {
            $check_id_user = Apply::where('id_user', $id_user)->get();
            if(count($check_id_user) > 0) {
                $apply = Apply::where('id_job', $id)
                        ->where('id_user', $id_user)
                        ->get();
                if(count($apply) > 0) {
                    Session::put('apply_tt', 'Bạn đã ứng tuyển công việc này!');
                    return redirect()->back();
                }else {
                    $apply = new Apply;
                    $apply->id_job = $id;
                    $apply->id_user = $id_user;
                    $apply->status = 1;
                    $apply->save();
                    Session::put('apply_sc', 'Nộp đơn thành công!');
                    return redirect()->back();
                }


            }else {
                $apply = new Apply;
                $apply->id_job = $id;
                $apply->id_user = $id_user;
                $apply->status = 1;
                $apply->save();
                 Session::put('apply_sc', 'Nộp đơn thành công!');
                return redirect()->back();
            }
        }else {
            Session::put('profile_r', 'Hoàn thiện hồ sơ trước khi nộp đơn');
                return redirect()->back();
    }
        
}


}
