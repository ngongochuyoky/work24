<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs;

class SearchController extends Controller
{
   public function getSearch(Request $req) {
        $name_title = $req->name_title;
        $str_nganh_nghe = $req->nganh_nghe;
        $str_city = $req->city;

        if(strlen($name_title) > 0 && strlen($str_nganh_nghe) > 0 && strlen($str_city) > 0) {
            $data_jobs = Jobs::join('salary', 'jobs.id_salary', '=', 'salary.id')
                        ->join('employers', 'jobs.id_employer', '=', 'employers.id')
                        ->join('company', 'employers.id_company', '=', 'company.id')
                        ->join('category', 'category.id', '=', 'jobs.id_category')
                        ->join('cities', 'cities.id', '=', 'jobs.id_cities')
                        ->where([['jobs.name', 'LIKE', '%'.$name_title.'%'], ['jobs.id_category', 'LIKE', '%'.$str_nganh_nghe.'%'], ['jobs.id_cities', 'LIKE', '%'.$str_city.'% ']])
                        ->get();
        }
        if(strlen($name_title) > 0 && strlen($str_nganh_nghe) > 0) {
             $data_jobs = Jobs::join('salary', 'jobs.id_salary', '=', 'salary.id')
                        ->join('employers', 'jobs.id_employer', '=', 'employers.id')
                        ->join('company', 'employers.id_company', '=', 'company.id')
                        ->join('category', 'category.id', '=', 'jobs.id_category')
                        ->where([['jobs.name', 'LIKE', '%'.$name_title.'%'], ['jobs.id_category', 'LIKE', '%'.$str_nganh_nghe.'%']])
                        ->get();
        }
        if(strlen($name_title) > 0 && strlen($str_city) > 0) {
             $data_jobs = Jobs::join('salary', 'jobs.id_salary', '=', 'salary.id')
                        ->join('employers', 'jobs.id_employer', '=', 'employers.id')
                        ->join('company', 'employers.id_company', '=', 'company.id')
                        ->join('cities', 'cities.id', '=', 'jobs.id_cities')
                        ->where([['jobs.name', 'LIKE', '%'.$name_title.'%'], ['jobs.id_cities', 'LIKE', '%'.$str_city.'%']])
                        ->get();
        }
          if(strlen($str_nganh_nghe) > 0 && strlen($str_city) > 0) {
             $data_jobs = Jobs::join('salary', 'jobs.id_salary', '=', 'salary.id')
                        ->join('employers', 'jobs.id_employer', '=', 'employers.id')
                        ->join('company', 'employers.id_company', '=', 'company.id')
                        ->join('category', 'category.id', '=', 'jobs.id_category')
                        ->join('cities', 'cities.id', '=', 'jobs.id_cities')
                        ->where([['jobs.id_category', 'LIKE', '%'.$str_nganh_nghe.'%'], ['jobs.id_cities', 'LIKE', '%'.$str_city.'%']])
                        ->get();
        }
        if(strlen($name_title) > 0) {
            $data_jobs = Jobs::join('salary', 'jobs.id_salary', '=', 'salary.id')
                        ->join('employers', 'jobs.id_employer', '=', 'employers.id')
                        ->join('company', 'employers.id_company', '=', 'company.id')
                        ->where([['jobs.name', 'LIKE', '%'.$name_title.'%']])
                        ->get();
            
        }
        if(strlen($str_nganh_nghe) > 0) {
            $data_jobs = Jobs::join('salary', 'jobs.id_salary', '=', 'salary.id')
                       ->join('employers', 'jobs.id_employer', '=', 'employers.id')
                        ->join('company', 'employers.id_company', '=', 'company.id')
                        ->join('category', 'category.id', '=', 'jobs.id_category')
                        ->where([['category.name_category', 'LIKE', '%'.$str_nganh_nghe.'%']])
                        ->get();

        }
        if(strlen($str_city) > 0) {
            $data_jobs = Jobs::join('salary', 'jobs.id_salary', '=', 'salary.id')
                       ->join('employers', 'jobs.id_employer', '=', 'employers.id')
                        ->join('company', 'employers.id_company', '=', 'company.id')
                        ->join('cities', 'cities.id', '=', 'jobs.id_cities')
                        ->where([['cities.name_cities', 'LIKE', '%'.$str_city.'%']])
                        ->get();

        }
        if($name_title === null && $str_nganh_nghe === null && $str_city === null) {
             $data_jobs = Jobs::join('salary', 'jobs.id_salary', '=', 'salary.id')
                               ->join('employers', 'jobs.id_employer', '=', 'employers.id')
                                ->join('company', 'employers.id_company', '=', 'company.id')
                                ->get();
        }

        return view('pages.tuyen_dung', compact('data_jobs', 'name_title', 'str_nganh_nghe', 'str_city'));
        
    }

    /*public function searchCompany(Request $request) {
        dd($request->name_company);
    }*/
}
