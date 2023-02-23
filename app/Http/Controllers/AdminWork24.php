<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Admin;
use App\loginModel;
use App\Employers;
use App\Category;
use App\Jobs;
use App\Chuc_vu;
use App\Cities;
use App\Degree;
use App\FormOfWork;
use App\Quy_mo;
use App\Salary;
use Session;

class AdminWork24 extends Controller
{
    public function homeAdmin() {
        $id_admin = Session::get('id_admin');
        if($id_admin === null) {
            return Redirect::to('admin-work24/login');
        }else {
            $allJob = Jobs::all();
            $users = loginModel::all();
            $employers = Employers::all();

            $postJobNew = Jobs::join('employers', 'employers.id', 'jobs.id_employer')
                        ->select('jobs.*', 'employers.name_employer')
                        ->orderby('id', 'desc')
                        ->limit(2)->get();
            return view('admin.index', compact('allJob', 'users', 'employers', 'postJobNew'));
        }
    }
    public function adminLogin() {
    	return view('formLogin.login_admin');
    }
    public function adminRegister() {
    	return view('formLogin.register_admin');
    }
    public function postAdminRegister(Request $request) {
    	$email = $request->email;
    	$name = $request->name;
    	$password = $request->password;
    	$confirm_pass = $request->confirm_pass;

    	if(strlen($password) >= 6 && strlen($confirm_pass) >= 6) {
    		if($password === $confirm_pass) {
    			$resutl = Admin::all();

    			if(count($resutl) > 0) {
    				foreach($resutl as $value) {
    					if($value['email'] === $email){
    						Session::put('message_email', 'Email này đã tồn tại trên hệ thống!');
                            return redirect()->back();
    					}else {
    						$admin = new Admin;
    						$admin->name = $name;
    						$admin->email = $email;
    						$admin->password = $password;
    						$admin->roles = 0;
    						$admin->save();
    						Session::put('message_success', 'Đăng ký thành công');
                            return Redirect::to('admin-work24/login');
    					}
    				}
    			}else {
    				$admin = new Admin;
					$admin->name = $name;
					$admin->email = $email;
					$admin->password = $password;
					$admin->roles = 0;
					$admin->save();
					Session::put('message_success', 'Đăng ký thành công');
                    return Redirect::to('admin-work24/login');
    			}
    		}
    	}
    }

    public function postAdminLogin(Request $request) {
        $email = $request->input('email');
        $password = $request->input('password');


        $result = Admin::where([['email','=',$email],['password','=',$password]])->first();
        if ($result) {
            Session::put('user_name', $result->name);
            Session::put('id_admin', $result->id);
            Session::put('roles', $result->roles);
            Session::put('mes_success', 'Đăng nhập thành công');
            return Redirect::to('admin-work24');
        }else {
            Session::put('message_err', 'Mật khẩu hoặc tài khoản không đúng, Vui lòng nhập lại');
           return redirect()->back();
        }
    }

    public function getAllUser() {
        $dataUser = loginModel::join('info_profile', 'info_profile.id', '=', 'users.id_info_profile')
                    ->select('users.*', 'info_profile.name_position')
                    ->orderby('users.id', 'desc')
                    ->get();
        $active3 = 'active';
        return view('admin.all-user', compact('active3', 'dataUser'));
    }

    public function getAllEmployer() {
        $allEmployer = Employers::join('company', 'company.id', '=', 'employers.id_company')
                                ->select('employers.*', 'company.name_company','company.address')
                                ->orderby('employers.id', 'desc')
                                ->paginate(15);
        $active4 = 'active';
        return view('admin.allEmployer', compact('active4', 'allEmployer'));
    }

    public function getChangePass() {
        return view('admin.change_pass');
    }
    public function postChangePass(Request $request) {
        $pass_old = $request->pass_old;
        $pass_new = $request->pass_new;
        $again_pass_new = $request->again_pass_new;

        $id_admin = Session::get('id_admin');

        $admin = Admin::find($id_admin);

        if($pass_old === $admin->password) {
            if(strlen($pass_new) >= 8 && strlen($again_pass_new) >= 8 ) {
                if($pass_new === $again_pass_new) {
                    $admin = Admin::find($id_admin);
                    $admin->password = $pass_new;
                    $admin->save();
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


    //=================quan ly category====================
    public function getAllCategory() {
        $category = Category::select('category.*')
                            ->orderby('category.id','desc')
                            ->paginate(10);
        return view('admin.category.allCategory', compact('category'));
    }
    public function addCategory() {
         return view('admin.category.addCategory');
    }
    public function postAddCategory(Request $request) {
        $name_category = $request->name_category;

        $dataCategory = Category::where('name_category', '=', $name_category)->get();
        if(count($dataCategory) > 0) {

            Session::put('name_category','Tên ngành nghề này đã được tồn tại');
            return redirect()->back();
        }else {
            $data = new Category;
            $data->name_category = $name_category;
            $data->save();

            Session::put('addted_category','Thêm tên ngành nghề thành công');
             return redirect()->back();
        }
    }
    public function updateCategory($id) {
         $category = Category::find($id);
         return view('admin.category.updateCategory', compact('category'));
    }
    public function  postUpdateCategory(Request $request) {
        $id = $request->id;
        $name_category = $request->name_category;
        $dataCategory = Category::where('name_category', '=', $name_category)->get();
        if(count($dataCategory) > 0) {
             Session::put('name_category','Tên ngành nghề này đã được tồn tại');
             return redirect()->back();
        }else {
            $category = Category::find($id);
            $category->name_category = $name_category;
            $category->update();

             Session::put('updated_category','Chỉnh sửa tên ngành nghề thành công');
             return redirect()->back();
        }
    }
    public function deleteCategory($id) {
        $category = Category::find($id);
        $category->delete();

        Session::put('deleted_category','Xóa tên ngành nghề thành công');
        return redirect()->back();
    }

    // ============= quan ly chuc vu ================
    public function getAllChucVu() {
        $chuc_vu = Chuc_vu::select('chuc_vu.*')
                            ->orderby('chuc_vu.id','desc')
                            ->paginate(10);
        return view('admin.chuc_vu.allChucVu', compact('chuc_vu'));
    }
      public function addChucVu() {
             return view('admin.chuc_vu.addChucVu');
        }
     public function postAddChucVu(Request $request) {
            $name_chuc_vu = $request->name_chuc_vu;

            $dataChucVu = Chuc_vu::where('name_chuc_vu', '=', $name_chuc_vu)->get();
            if(count($dataChucVu) > 0) {

                Session::put('name_chuc_vu','Tên chức vụ này đã được tồn tại');
                return redirect()->back();
            }else {
                $data = new Chuc_vu;
                $data->name_chuc_vu = $name_chuc_vu;
                $data->save();

                Session::put('addted_chuc_vu','Thêm tên chức vụ thành công');
                 return redirect()->back();
            }
        }
        public function updateChucVu($id) {
         $chuc_vu = Chuc_vu::find($id);
         return view('admin.chuc_vu.updateChucVu', compact('chuc_vu'));
    }
     public function  postUpdateChucVu(Request $request) {
        $id = $request->id;
        $name_chuc_vu = $request->name_chuc_vu;
        $dataChucVu = Chuc_vu::where('name_chuc_vu', '=', $name_chuc_vu)->get();
        if(count($dataChucVu) > 0) {
             Session::put('name_chuc_vu','Tên chức vụ này đã được tồn tại');
             return redirect()->back();
        }else {
            $chuc_vu = Chuc_vu::find($id);
            $chuc_vu->name_chuc_vu = $name_chuc_vu;
            $chuc_vu->update();

             Session::put('updated_chuc_vu','Chỉnh sửa tên chức vụ thành công');
             return redirect()->back();
        }
    }
     public function deletechuc_vu($id) {
        $chuc_vu = Chuc_vu::find($id);
        $chuc_vu->delete();

        Session::put('deleted_chuc_vu','Xóa tên chức vụ thành công');
        return redirect()->back();
    }

    // ============= quan ly thanh pho ================
    public function getAllCities() {
         $cities = Cities::select('cities.*')
                            ->orderby('cities.id','desc')
                            ->paginate(10);
        return view('admin.cities.allCities', compact('cities'));
    }
    public function getAddCities() {
        return view('admin.cities.addCities');
    }
    public function postAddCities(Request $request) {

        $name_cities = $request->name_cities;

        $dataCities = Cities::where('name_cities', '=', $name_cities)->get();
        if(count($dataCities) > 0) {

            Session::put('name_cities','Tên thành phố này đã được tồn tại');
            return redirect()->back();
        }else {
            $data = new Cities;
            $data->name_cities = $name_cities;
            $data->save();

            Session::put('addted_cities','Thêm tên thành phố thành công');
             return redirect()->back();
        }
    } 

    public function updateCities($id) {
        $cities = Cities::find($id);
         return view('admin.cities.updateCities', compact('cities'));
    }
    public function postUpdateCities(Request $request) {
        $id = $request->id;
        $name_cities = $request->name_cities;
        $dataCities = Cities::where('name_cities', '=', $name_cities)->get();
        if(count($dataCities) > 0) {
             Session::put('name_cities','Tên thành phố này đã được tồn tại');
             return redirect()->back();
        }else {
            $cities = Cities::find($id);
            $cities->name_cities = $name_cities;
            $cities->update();

             Session::put('updated_cities','Chỉnh sửa tên thành phố thành công');
             return redirect()->back();
        }
    }
    public function deleteCities($id) {
        $cities = Cities::find($id);
        $cities->delete();

        Session::put('deleted_cities','Xóa tên thành phố thành công');
        return redirect()->back();
    }


    // ============= quan ly bang cap ================
    public function getAllDegree() {
         $degree = Degree::select('degree.*')
                            ->orderby('degree.id','desc')
                            ->paginate(10);
        return view('admin.degree.allDegree', compact('degree'));
    }
    public function getAddDegree() {
        return view('admin.degree.addDegree');
    }
    public function postAddDegree(Request $request) {

        $name_degree = $request->name_degree;

        $dataDegree = Degree::where('name_degree', '=', $name_degree)->get();
        if(count($dataDegree) > 0) {

            Session::put('name_degree','Tên bằng cấp này đã được tồn tại');
            return redirect()->back();
        }else {
            $data = new Degree;
            $data->name_degree = $name_degree;
            $data->save();

            Session::put('addted_degree','Thêm tên bằng cấp thành công');
             return redirect()->back();
        }
    } 

    public function updateDegree($id) {
        $degree = Degree::find($id);
         return view('admin.degree.updateDegree', compact('degree'));
    }
    public function postUpdateDegree(Request $request) {
        $id = $request->id;
        $name_degree = $request->name_degree;
        $dataDegree = Degree::where('name_degree', '=', $name_degree)->get();
        if(count($dataDegree) > 0) {
             Session::put('name_degree','Tên bằng cấp này đã được tồn tại');
             return redirect()->back();
        }else {
            $degree = Degree::find($id);
            $degree->name_degree = $name_degree;
            $degree->update();

             Session::put('updated_degree','Chỉnh sửa tên bằng cấp thành công');
             return redirect()->back();
        }
    }
    public function deleteDegree($id) {
        $degree = Degree::find($id);
        $degree->delete();

        Session::put('deleted_degree','Xóa tên bằng cấp thành công');
        return redirect()->back();
    }

      // ============= quan ly hình thức việc làm ================
    public function getAllFormOfWork() {
         $form_of_work = FormOfWork::select('form_of_work.*')
                            ->orderby('form_of_work.id','desc')
                            ->paginate(10);
        return view('admin.form_of_work.allFormOfWork', compact('form_of_work'));
    }
    public function getAddFormOfWork() {
        return view('admin.form_of_work.addFormOfWork');
    }
    public function postAddFormOfWork(Request $request) {

        $name_form_of_work = $request->name_form_of_work;

        $dataFormOfWork = FormOfWork::where('name_form_of_work', '=', $name_form_of_work)->get();
        if(count($dataFormOfWork) > 0) {

            Session::put('name_form_of_work','Tên hình thức này đã được tồn tại');
            return redirect()->back();
        }else {
            $data = new FormOfWork;
            $data->name_form_of_work = $name_form_of_work;
            $data->save();

            Session::put('addted_form_of_work','Thêm tên hình thức việc làm thành công');
             return redirect()->back();
        }
    } 

    public function updateFormOfWork($id) {
        $form_of_work = FormOfWork::find($id);
         return view('admin.form_of_work.updateFormOfWork', compact('form_of_work'));
    }
    public function postUpdateFormOfWork(Request $request) {
        $id = $request->id;
        $name_form_of_work = $request->name_form_of_work;
        $dataFormOfWork = FormOfWork::where('name_form_of_work', '=', $name_form_of_work)->get();
        if(count($dataFormOfWork) > 0) {
             Session::put('name_form_of_work','Tên hình thức này đã được tồn tại');
             return redirect()->back();
        }else {
            $form_of_work = FormOfWork::find($id);
            $form_of_work->name_form_of_work = $name_form_of_work;
            $form_of_work->update();

             Session::put('updated_form_of_work','Chỉnh sửa tên hình thức việc làm thành công');
             return redirect()->back();
        }
    }
    public function deleteFormOfWork($id) {
        $form_of_work = FormOfWork::find($id);
        $form_of_work->delete();

        Session::put('deleted_form_of_work','Xóa tên hình thức việc làm thành công');
        return redirect()->back();
    } 
      // ============= quan ly quy mo ================
    public function getAllQuyMo() {
         $quy_mo = Quy_mo::select('quy_mo.*')
                            ->orderby('quy_mo.id','desc')
                            ->paginate(10);
        return view('admin.quy_mo.allQuyMo', compact('quy_mo'));
    }
    public function getAddQuyMo() {
        return view('admin.quy_mo.addQuyMo');
    }
    public function postAddQuyMo(Request $request) {

        $name_quy_mo = $request->name_quy_mo;

        $dataQuyMo = Quy_mo::where('name_quy_mo', '=', $name_quy_mo)->get();
        if(count($dataQuyMo) > 0) {

            Session::put('name_quy_mo','Tên quy mô này đã được tồn tại');
            return redirect()->back();
        }else {
            $data = new Quy_mo;
            $data->name_quy_mo = $name_quy_mo;
            $data->save();

            Session::put('addted_quy_mo','Thêm tên quy mô thành công');
             return redirect()->back();
        }
    } 

    public function updateQuyMo($id) {
        $quy_mo = Quy_mo::find($id);
         return view('admin.quy_mo.updateQuyMo', compact('quy_mo'));
    }
    public function postUpdateQuyMo(Request $request) {
        $id = $request->id;
        $name_quy_mo = $request->name_quy_mo;
        $dataQuyMo = Quy_mo::where('name_quy_mo', '=', $name_quy_mo)->get();
        if(count($dataQuyMo) > 0) {
             Session::put('name_quy_mo','Tên quy mô đã được tồn tại');
             return redirect()->back();
        }else {
            $quy_mo = Quy_mo::find($id);
            $quy_mo->name_quy_mo = $name_quy_mo;
            $quy_mo->update();

             Session::put('updated_quy_mo','Chỉnh sửa tên quy mô thành công');
             return redirect()->back();
        }
    }
    public function deleteQuyMo($id) {
        $quy_mo = Quy_mo::find($id);
        $quy_mo->delete();

        Session::put('deleted_quy_mo','Xóa tên quy mô thành công');
        return redirect()->back();
    }   
    // ============= quan ly lương ================
    public function getAllSalary() {
         $salary = Salary::select('salary.*')
                            ->orderby('salary.id','desc')
                            ->paginate(10);
        return view('admin.salary.allSalary', compact('salary'));
    }
    public function getAddSalary() {
        return view('admin.salary.addSalary');
    }
    public function postAddSalary(Request $request) {

        $salary_min = $request->salary_min;
        $salary_max = $request->salary_max;

        $dataSalary = Salary::where('salary_min', '=', $salary_min)
                            ->where('salary_max', '=', $salary_max)->get();
        if(count($dataSalary) > 0) {

            Session::put('name_salary','Tên lương này đã được tồn tại');
            return redirect()->back();
        }else {
            $data = new Salary;
            $data->salary_min = $salary_min;
            $data->salary_max = $salary_max;
            $data->save();

            Session::put('addted_salary','Thêm tên lương thành công');
             return redirect()->back();
        }
    } 

    public function updateSalary($id) {
        $salary = Salary::find($id);
         return view('admin.salary.updateSalary', compact('salary'));
    }
    public function postUpdateSalary(Request $request) {
        $id = $request->id;
        $salary_min = $request->salary_min;
        $salary_max = $request->salary_max;
        $dataSalary = Salary::where('salary_min', '=', $salary_min)
                            ->where('salary_max', '=', $salary_max)->get();
        if(count($dataSalary) > 0) {
             Session::put('name_salary','Tên lương đã được tồn tại');
             return redirect()->back();
        }else {
            $salary = Salary::find($id);
            $salary->salary_min = $salary_min;
            $salary->salary_max = $salary_max;
            $salary->update();

             Session::put('updated_salary','Chỉnh sửa tên lương thành công');
             return redirect()->back();
        }
    }
    public function deleteSalary($id) {
        $salary = Salary::find($id);
        $salary->delete();

        Session::put('deleted_salary','Xóa tên lương thành công');
        return redirect()->back();
    }

    // tat ca viec lam
    public function allJob() {

        $data = Jobs::join('employers', 'employers.id', '=', 'jobs.id_employer')
                ->join('company', 'company.id', '=', 'employers.id_company')
                ->join('salary', 'salary.id', 'jobs.id_salary')
                ->join('cities', 'cities.id', '=', 'jobs.id_cities')
                ->select('jobs.*', 'company.name_company', 'salary.salary_min', 'salary.salary_max', 'cities.name_cities')
                ->orderby('jobs.id', 'desc')
                ->paginate(10);
        return view('admin.all-job', compact('data'));
    }
    public function updateStatusJob($id) {
        $updateJob = Jobs::find($id);
        $updateJob->status = 1;
        $updateJob->save();
        Session::put('updated_status', 'Phê duyệt thành công bài viết');
        return redirect()->back();
    }
    // update lại -1
    public function deleJob($id) {
        $data = Jobs::find($id);
        $data->status = -1;
        $data->save();

        Session::put('deleted_job','Xóa việc làm thành công');
        return redirect()->back();
    }

  
}
