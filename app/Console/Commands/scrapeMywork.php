<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte;
use App\Employers;
use App\Jobs;
class scrapeMywork extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:mywork';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $category = [];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
         /*$crawler = Goutte::request('GET', "https://mywork.com.vn/tuyen-dung");

          $title = $crawler->filter('.logo_box img')->each(function ($node) {
          return $node->attr('data-src');
      })[0];
          // dd($title);*/
      $crawler = Goutte::request('GET', "https://mywork.com.vn/tuyen-dung");
       $arr_title = $crawler->filter('p.j_title a.el-tooltip.item')->each(function ($node) {
          return $node->attr('href');
      });

       dd($arr_title);
    

     
        self::scrapeJob( "https://mywork.com.vn/tuyen-dung/viec-lam/1307529/truong-pho-phong-san-xuat-chuyen-nganh-ep-phun-nhua-ky-thuat.html");

       

   }

   public function scrapeJob($url) {


        // lấy thông tin 1 bài viết việc làm
    $crawler = Goutte::request('GET', $url);




        // chi tiết thông tin cần tuyển
     $name = $crawler->filter('h1.main-title')->each(function ($node) {
          return $node->text();
      })[0];

    $elementSpan = $crawler->filter('.job_detail_general p')->each(function ($node) {
      return $node->text();
  });

    $experience = $elementSpan[0];
    $degree = $elementSpan[1];
    $number_people = $elementSpan[2];
    $form_of_work = $elementSpan[3];
    $position = $elementSpan[4];
    $gender = $elementSpan[5];


    $arr_nganh_nghe = $crawler->filter('.job-cat span')->each(function ($node) {
      return $node->text();
  });
    $str_nganh_nghe = '';
    foreach($arr_nganh_nghe as $nganh_nghe) {
        $str_nganh_nghe .= $nganh_nghe;
    }


    $city_id = $crawler->filter('span.location_tag')->each(function ($node) {
      return $node->text();
  });
    $str_city = '';
        foreach($city_id as $city) {
            $str_city .=  $city;
        }

    $salary = $crawler->filter('.row-standard span.text_red')->each(function ($node) {
      return $node->text();
  })[0];

    $mo_ta = $crawler->filter('.mw-box-item')->each(function ($node) {
      return $node->html();
  });

    $description = $mo_ta[2];
    $Welfare = $mo_ta[3];

    if(isset($mo_ta[4])) {
        $requirements_other = $mo_ta[4];
    }else {
     $requirements_other = '';
 }



 $box_contact = $crawler->filter('.box-contact .item')->each(function ($node) {
  return $node->text();
});
 $name_employer = $box_contact[0];
 $address = $box_contact[1];
 $date_expired = $box_contact[2];
 $language = $box_contact[3];



        // lấy thông tin liên hệ

 $name_congty = $crawler->filter('a.capitalize')->each(function ($node) {
    return $node->text();
})[0];

set_time_limit(30);

 $logo = $crawler->filter('.box-logo')->each(function ($node) {
  return $node->html();
});

 dd($logo);

 $quy_mo = $crawler->filter('p.config')->each(function ($node) {
    return $node->text();
})[0];




 $link_congty = $crawler->filter('a.capitalize')->each(function ($node) {
    return $node->attr('href');
})[0];

 $url = env('MY_WORK') . $link_congty;



 $crawler = Goutte::request('GET', $url);


 $introduce = $crawler->filter('.desc read-more')->each(function ($node) {
  return $node->attr('text');
})[0];

 $website = $crawler->filter('.j_company p')->each(function ($node) {
  return $node->text();
})[2];

 // lấy random info_employer 
    function get_random( $length ) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $size = strlen( $chars );
        $str = '';
        for( $i = 0; $i < $length; $i++ ) {
            $str .= $chars[ rand( 0, $size - 1 ) ];
        }
        return $str;
    }
    $email = get_random( 5 ) . '@gmail.com';
    $password = get_random( 8 );
    $tel_employer = "09" . rand(1,100000000);

    $data = new Employers();

    $data->email = $email;
    $data->password = $password;
    $data->logo = '';
    $data->name_cty = $name_congty;
    $data->address = $address;
    $data->name_employer = $name_employer;
    $data->tel_employer = $tel_employer;
    $data->city_id = $city_id[0];
    $data->quy_mo = $quy_mo;
    $data->website = $website;
    $data->introduce = $introduce;

    // $data->save();

    $id_employer = Employers::max('id');


    // dd($id_employer);
    if(isset($id_employer)) {
        $data = new Jobs();
        $data->id_employer = $id_employer;
        $data->name = $name;
        $data->salary = $salary;
        $data->experience = $experience;
        $data->degree = $degree;
        $data->number_people = $number_people;
        $data->position = $position;
        $data->form_of_work = $form_of_work;
        $data->gender = $gender;
        $data->nganh_nghe = $str_nganh_nghe;
        $data->city_id = $str_city;
        $data->description = $description;
        $data->Welfare = $Welfare;
        $data->requirements_other = $requirements_other;
        $data->language = $language;
        $data->date_expired = $date_expired;

        // $data->save();

        print('Lấy dữ liệu thành công của bài viết');
        }
 
    }

}

