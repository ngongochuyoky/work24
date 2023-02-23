<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PagesController@index')->name('/');

// login
Route::get('login_ntv', 'LoginController@getLogin_ntv');
Route::post('login_ntv', 'LoginController@postLogin_ntv');
Route::get('login_ntd', 'LoginController@getLogin_ntd');
Route::post('login_ntd', 'LoginController@postLogin_ntd')->name('login_ntd');

// register 
 Route::get('register_ntv', 'LoginController@getRegister_ntv');
 Route::post('register_ntv', 'LoginController@postRegister_ntv');
 Route::get('register_ntd', 'LoginController@getRegister_ntd');
 Route::post('register_ntd', 'LoginController@postRegister_ntd')->name('register_ntd');

// ==================== pages ================
// tuyen dung
 Route::get('tuyen-dung', 'PagesController@tuyen_dung');
 // viec lam
 Route::get('tuyen-dung/chi-tiet-viec-lam/{id}/{name}', 'PagesController@detailJob')->name('detailJob');
// công ty - nhà tuyển dụng
 Route::get('tuyen-dung/nha-tuyen-dung/{id}/{name}', 'PagesController@detail_company')->name('detail_company');
 Route::get('tuyen-dung/dia-diem/{id}/{city}', 'PagesController@city')->name('dia-diem');
 Route::get('ung-vien', 'PagesController@ung_vien')->name('ung-vien');
 Route::get('ho-so/{id}/{name_position}', 'PagesController@profile')->name('profile');

 // jobs_save
 Route::get('save-job/{id}', 'PagesController@save_job')->name('save_job');
 Route::get('profile-save/{id}', 'PagesController@profile_save')->name('profile_save');
 Route::get('cong-ty', "PagesController@getCompany")->name('company');

// jobs_apply
 Route::get('apply-job/{id}', 'PagesController@apply')->name('apply');

 // logout 
Route::get('logout', 'LoginController@getLogout');

// ==================== Dashboard ================
 Route::get('trang-ca-nhan', 'DashBoard@index')->name('trang-ca-nhan');
// xử lý hoàn thiện hồ sơ
Route::get('quan-ly-ho-so', 'DashBoard@quanLyHoSo')->name('quan-ly-ho-so');
Route::get('hoan-thien-ho-so/buoc/1', 'DashBoard@getUpdateInfo')->name('getUpdateInfo');
Route::post('hoan-thien-ho-so/buoc/1', 'DashBoard@postUpdateInfo')->name('postUpdateInfo');
Route::get('hoan-thien-ho-so/buoc/2', 'DashBoard@getInfoProfile')->name('getInfoProfile');
Route::post('hoan-thien-ho-so/buoc/2', 'DashBoard@postInfoProfile')->name('postInfoProfile');
Route::get('hoan-thien-ho-so/buoc/3', 'DashBoard@getSkill')->name('getSkill');
Route::post('hoan-thien-ho-so/buoc/3', 'DashBoard@postSkill')->name('postSkill');
// xu ly quan lý việc làm 
Route::get('trang-ca-nhan/viec-lam', 'Dashboard@getJobs')->name('getJobs');
Route::get('trang-ca-nhan/viec-lam-da-ung-tuyen', 'Dashboard@getJobs_apply')->name('getJobs_apply');

// delete
Route::get('delet-jobs_save/{id}', 'Dashboard@getUpdateJobSave')->name('update_jobSave');
// delete jobs_apply
Route::get('delete-jobs_apply/{id}}', 'Dashboard@delete_apply')->name('delete_apply');

// doi-mat khau
Route::get('doi-mat-khau','Dashboard@getChangePass');
Route::post('doi-mat-khau','Dashboard@postChangePass')->name('change_pass');

 //====================== search ===============
 Route::post('tuyen-dung/search', 'PagesController@getSearch')->name('getSearch');
 
 Route::post('cong-ty/tim-kiem-cong-ty', 'PagesController@searchCompany')->name('searchCompany');
 Route::post('ung-vien/search', 'PagesController@search_users')->name('search_users');

 // ============================== Dashboard  Nha - tuyen - dung =======================
  Route::get('nha-tuyen-dung', 'DashBoardEmployer@index')->name('nha-tuyen-dung');
  Route::get('nha-tuyen-dung/dang-tin', 'DashBoardEmployer@postJob')->name('postJob');
  Route::post('nha-tuyen-dung/dang-tin', 'DashBoardEmployer@handPostJob')->name('handPostJob');
  Route::get('all-post-job', 'DashBoardEmployer@getAllPost')->name('allPost');
  Route::get('delete-post-job/{id}', 'DashBoardEmployer@deletePostJob')->name('deletePostJob');

  // edit 
  Route::get('nha-tuyen-dung/dang-tin/xem-lai/{id}', 'DashboardEmployer@getEditJob')->name('getEditJob');
  Route::post('nha-tuyen-dung/dang-tin/xem-lai', 'DashboardEmployer@postEditJob')->name('postEditJob');
  Route::get('nha-tuyen-dung/thong-tin-tai-khoan', 'DashboardEmployer@updateCompany')->name('updateCompany');
  Route::post('nha-tuyen-dung/thong-tin-tai-khoan', 'DashboardEmployer@postUpdateCompany')->name('postUpdateCompany');

  Route::get('nha-tuyen-dung/ho-so-da-luu', 'DashboardEmployer@all_profile_save')->name('all_profile_save');
  Route::get('nha-tuyen-dung/profile-ung-tuyen', 'DashboardEmployer@profile_apply')->name('profile_apply');
  Route::get('delet-prfile_save/{id}', 'DashboardEmployer@getUpdateProfileSave')->name('updateProfileSave');

  Route::get('doi-mat-khau-ntd', 'DashboardEmployer@getChangePass')->name('get_change_pass_employer');
  Route::post('doi-mat-khau-ntd', 'DashboardEmployer@postChangePass')->name('change_pass_employer');

  // xóa ứng viên ứng tuyển
  Route::get('delete-job-apply/{id}', 'DashBoardEmployer@updateJobApply')->name('updateJobApply');

// ======================================= Admin ==============================
  Route::get('admin-work24', 'AdminWork24@homeAdmin')->name('admin-work24');
  Route::get('admin-work24/login', 'AdminWork24@adminLogin');
  Route::post('admin-work24/login', 'AdminWork24@postAdminLogin')->name('login-admin');
  Route::get('admin-work24/register', 'AdminWork24@adminRegister')->name('register-admin');
  Route::post('admin-work24/register', 'AdminWork24@postAdminRegister')->name('register_admin');
  Route::get('doi-mat-khau-admin', 'AdminWork24@getChangePass');
  Route::post('doi-mat-khau-admin', 'AdminWork24@postChangePass')->name('postChangePass');

  Route::get('admin-work24/nguoi-tim-viec', 'AdminWork24@getAllUser')->name('allUser');
  Route::get('admin-work24/nha-tuyen-dung', 'AdminWork24@getAllEmployer')->name('allEmployer');
  // ====== quan ly các bảng ========
  Route::get('admin-work24/tat-ca-nganh-nghe', 'AdminWork24@getAllCategory')->name('allCategory');
  Route::get('admin-work24/tat-ca-nganh-nghe/{id}', 'AdminWork24@updateStatusJob')->name('updateStatusJob');
  Route::get('admin-work24/delete-category/{id}', 'AdminWork24@deleteCategory')->name('deleteCategory');
  Route::get('admin-work24/update-category/{id}', 'AdminWork24@updateCategory')->name('updateCategory');
  Route::post('admin-work24/update-category/', 'AdminWork24@postUpdateCategory')->name('postUpdateCategory');
  Route::get('admin-work24/them-nganh-nghe', 'AdminWork24@addCategory')->name('addCategory');
  Route::post('admin-work24/them-nganh-nghe', 'AdminWork24@postAddCategory')->name('postAddCategory');

  // ===chuc vu ======
  Route::get('admin-work24/tat-ca-chuc-vu', 'AdminWork24@getAllChucVu')->name('allChucVu');
  Route::get('admin-work24/them-chuc-vu', 'AdminWork24@addChucVu')->name('addChucVu');
  Route::post('admin-work24/them-chuc-vu', 'AdminWork24@postAddChucVu')->name('postAddChucVu');
  Route::get('admin-work24/update-chuc-vu/{id}', 'AdminWork24@updateChucVu')->name('updateChucVu');
  Route::post('admin-work24/update-chuc-vu/', 'AdminWork24@postUpdateChucVu')->name('postUpdateChucVu');
  Route::get('admin-work24/delete-chuc-vu/{id}', 'AdminWork24@deletechuc_vu')->name('deletechuc_vu');  
  // ===thành phố ======
  Route::get('admin-work24/tat-ca-thanh-pho', 'AdminWork24@getAllCities')->name('allCities');
  Route::get('admin-work24/them-thanh-pho', 'AdminWork24@getAddCities')->name('addCities');
  Route::post('admin-work24/them-thanh-pho', 'AdminWork24@postAddCities')->name('postAddCities');
  Route::get('admin-work24/update-thanh-pho/{id}', 'AdminWork24@updateCities')->name('updateCities');
  Route::post('admin-work24/update-thanh-pho/', 'AdminWork24@postUpdateCities')->name('postUpdateCities');
  Route::get('admin-work24/delete-cities/{id}', 'AdminWork24@deleteCities')->name('deleteCities');  
  // ===bằng cấp ======
  Route::get('admin-work24/tat-ca-bang-cap', 'AdminWork24@getAllDegree')->name('allDegree');
  Route::get('admin-work24/them-bang-cap', 'AdminWork24@getAddDegree')->name('addDegree');
  Route::post('admin-work24/them-bang-cap', 'AdminWork24@postAddDegree')->name('postAddDegree');
  Route::get('admin-work24/update-bang-cap/{id}', 'AdminWork24@updateDegree')->name('updateDegree');
  Route::post('admin-work24/update-bang-cap/', 'AdminWork24@postUpdateDegree')->name('postUpdateDegree');
  Route::get('admin-work24/delete-degree/{id}', 'AdminWork24@deleteDegree')->name('deleteDegree');  

   // ===hình thức việc làm ======
  Route::get('admin-work24/tat-ca-hinh-thuc-viec-lam', 'AdminWork24@getAllFormOfWork')->name('allFormOfWork');
  Route::get('admin-work24/them-hinh-thuc-viec-lam', 'AdminWork24@getAddFormOfWork')->name('addFormOfWork');
  Route::post('admin-work24/them-hinh-thuc-viec-lam', 'AdminWork24@postAddFormOfWork')->name('postAddFormOfWork');
  Route::get('admin-work24/update-hinh-thuc-viec-lam/{id}', 'AdminWork24@updateFormOfWork')->name('updateFormOfWork');
  Route::post('admin-work24/update-hinh-thuc-viec-lam/', 'AdminWork24@postUpdateFormOfWork')->name('postUpdateFormOfWork');
  Route::get('admin-work24/delete-form-of-work/{id}', 'AdminWork24@deleteFormOfWork')->name('deleteFormOfWork');  
   // ===quy mo ======
  Route::get('admin-work24/tat-ca-quy-mo', 'AdminWork24@getAllQuyMo')->name('allQuyMo');
  Route::get('admin-work24/them-quy-mo', 'AdminWork24@getAddQuyMo')->name('addQuyMo');
  Route::post('admin-work24/them-quy-mo', 'AdminWork24@postAddQuyMo')->name('postAddQuyMo');
  Route::get('admin-work24/update-quy-mo/{id}', 'AdminWork24@updateQuyMo')->name('updateQuyMo');
  Route::post('admin-work24/update-quy-mo/', 'AdminWork24@postUpdateQuyMo')->name('postUpdateQuyMo');
  Route::get('admin-work24/delete-quy-mo/{id}', 'AdminWork24@deleteQuyMo')->name('deleteQuyMo');  
  
  // ===lương ======
  Route::get('admin-work24/tat-ca-luong', 'AdminWork24@getAllSalary')->name('allSalary');
  Route::get('admin-work24/them-luong', 'AdminWork24@getAddSalary')->name('addSalary');
  Route::post('admin-work24/them-luong', 'AdminWork24@postAddSalary')->name('postAddSalary');
  Route::get('admin-work24/update-luong/{id}', 'AdminWork24@updateSalary')->name('updateSalary');
  Route::post('admin-work24/update-luong/', 'AdminWork24@postUpdateSalary')->name('postUpdateSalary');
  Route::get('admin-work24/delete-luong/{id}', 'AdminWork24@deleteSalary')->name('deleteSalary');  
  
  // quan ly viec lam
  Route::get('admin-work24/all-job', 'AdminWork24@allJob')->name('all-job');
  Route::get('admin-work24/delete-job/{id}', 'AdminWork24@deleJob')->name('deleJob');




