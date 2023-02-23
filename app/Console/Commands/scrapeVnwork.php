<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte;
use App\Jobs;
use App\Employers;
use DB;

class scrapeVnwork extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:vietnamwork';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $category = [
        //'mien-nam/viec-lam-chuyen-mon',
        // 'mien-bac/viec-lam-chuyen-mon',
        'mien-nam/viec-lam-lao-dong-pho-thong',
        'mien-bac/viec-lam-lao-dong-pho-thong',
        'mien-nam/viec-lam-sinh-vien-ban-thoi-gian',
        'mien-bac/viec-lam-sinh-vien-ban-thoi-gian'
    ];

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

       /*foreach($this->category as $category) {
            $l = env("VIET_NAM_WORK") . $category;

            print("lấy danh mục của " . $category . "\n");

            $crawler = Goutte::request('GET', $l);

            $linkPost = $crawler->filter('a.link_box_panel1.text_grey2')->each(function ($node) {
                    return $node->attr('href');
                });


            foreach($linkPost as $link) {
                $l = $link ;
                print("lấy link của " . $link . "\n");
                self::scrapePost($l);
            }*/
        self::scrapePost("https://vieclam24h.vn/lao-dong-pho-thong/nhan-vien-phuc-vu-c26p0id3098666.html");

    //}
}
    public function scrapePost($url) {

        // lấy thông tin 1 bài viết
        $crawler = Goutte::request('GET', $url);


        $name = $crawler->filter('h1.font28')->each(function ($node) {
          return $node->text();
      });

        if(isset($name[0])) {
            $name = $name[0];
        }

        // chi tiết thông tin cần tuyển
        $elementSpan = $crawler->filter('.line-icon.mb_12 span.job_value')->each(function ($node) {
          return $node->text();
      });
        $arr_nganh_nghe = $crawler->filter('h2.font14 a')->each(function ($node) {
          return $node->text();
      });

        $arr_city_id = $crawler->filter('span.pl_28 a')->each(function ($node) {
          return $node->text();
      });

        array_push($elementSpan, $arr_nganh_nghe, $arr_city_id);

         // xử lý thêm 1 trường thực tập tránh trường hợp lỗi khi crawler dữ liệu
        if (count($elementSpan) === 10) {
            array_splice($elementSpan, 6, 0, "");
        }

        $salary = $elementSpan[0];
        $experience = $elementSpan[1];
        // $degree = $elementSpan[2];
        if (isset($elementSpan[2])) {
            $degree = $elementSpan[2];
        }
        $number_people = $elementSpan[3];
        $position = $elementSpan[4];
        $form_of_work = $elementSpan[5];
        $time_tria = $elementSpan[6];
        $gender = $elementSpan[7];
        $year_old = $elementSpan[8];
        $nganh_nghe = $elementSpan[9];
        $city_id = $elementSpan[10];

        $mo_ta = $crawler->filter('p.word_break')->each(function ($node) {
          return $node->text();
      });

        $description = $mo_ta[0];
        $Welfare = $mo_ta[1];

        if(isset($mo_ta[2])) {
            $requirements_other = $mo_ta[2];
        }else {
           $requirements_other = '';
       }

       $date_expired = $crawler->filter('span.pl_24 span.text_pink')->each(function ($node) {
          return $node->text();
      })[0];




         // lấy thông tin người đăng tuyển employes
       
       $tt_lien_he = $crawler->filter('.job_description .pt_14.pb_14 .pr_0.mb_0')->each(function ($node) {
          return $node->text();
      });
       $name_employer = $tt_lien_he[0];
       $address = $tt_lien_he[1];

       $name_cty = $crawler->filter('a.text_grey3')->each(function ($node) {
          return $node->text();
      })[0];


       $logo = $crawler->filter('.logo-company img.img_responsive')->each(function ($node) {
          return $node->attr('src');
      });
       if(isset($logo[0])) {
        $logo = $logo[0];
    }

         // lấy random email_employer 
    function get_random( $length ) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $size = strlen( $chars );
        $str = '';
        for( $i = 0; $i < $length; $i++ ) {
            $str .= $chars[ rand( 0, $size - 1 ) ];
        }
        return $str;
    }
    $email_employer = get_random( 7 ) . '@gmail.com';
    $email = get_random( 5 ) . '@gmail.com';
    $password = get_random( 8 );
    $tel_employer = "09" . rand(1,100000000);



    $data = new Employers();

    $data->email = $email; 
    $data->password = $password; 
    $data->logo = $logo; 
    $data->name_cty = $name_cty;
    $data->address = $address;
    $data->name_employer = $name_employer; 
    $data->tel_employer = $tel_employer; 
    $data->email_employer = $email_employer; 
    $data->city_id = "";
    $data->quy_mo = "";
    $data->website = "";
    $data->quantity_user_follow = 1;
    $data->info = "";

    // dd($city_id);

     // $data->save();


    // $id_employers = DB::table('tablename')->where('column','filter')->get();

    print("lấy dữ liệu thành công bang employes" . "\n");

    $id_employers = DB::select('select * from users where id = :id', ['id' => 1]);

    dd($id_employers);

    /*$data = new Jobs();

    $data->id_employer = ''; 
    $data->name = $name; 
    $data->salary = $salary; 
    $data->experience = $experience;
    $data->degree = $degree;
    $data->number_people = $number_people; 
    $data->position = $position; 
    $data->form_of_work = $form_of_work; 
    $data->time_tria = $time_tria; 
    $data->gender = $gender; 
    $data->year_old = $year_old; 
    $data->nganh_nghe = $nganh_nghe;
    $data->city_id = $city_id; 
    $data->description = $description;
    $data->Welfare = $Welfare;
    $data->requirements_other = $requirements_other;
    $data->date_expired = $date_expired;*/


        // $data->save();

    //print('lấy dữ liệu thành công bang job!' . "\n");

}
}
