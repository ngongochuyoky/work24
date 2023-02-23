<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte;
use App\Post_Dantri;

class scrapeDantri extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scraper:dantri';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $category = [
        'phap-luat.htm',
        'nhip-song-tre.htm',
        'video-page.htm'
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
        // lấy tất cả bài viết trong danh mục

        foreach ($this->category as $category) {
             
            $l = env("DAN_TRI") . '/' . $category;

            print("Lấy danh mục của " . $category . "\n");

             $crawler = Goutte::request('GET', $l);

             $linkPost = $crawler->filter('a.fon6')->each(function ($node) {
              return $node->attr('href');
            });


             foreach ($linkPost as $link) {
                $l = env("DAN_TRI") . $link ;
               self::scraperPost($l);
             }
        }



    }



    // xử lý lấy từng bài viết
    public function scraperPost($url) {
        $crawler = Goutte::request('GET', $url);

        $title = $crawler->filter('h1.fon31')->each(function ($node) {
          return $node->text();
        });

        if(isset($title[0])) {
            $title = $title[0];
        }

         // $slug = str_slug($title);
        

        $description =  $crawler->filter('h2.fon33.mt1.sapo')->each(function ($node) {
          return $node->text();
        });

        if(isset($description[0])) {
            $description = $description[0];
        }



         $description = str_replace('Dân trí', '', $description);
          

        $content = $crawler->filter('#divNewsContent.fon34.mt3.mr2.fon43.detail-content  p')->each(function ($node) {
          return $node->text();
        });

        if(isset($content[0])) {
            $content = $content[0];
        }


        

        /* 
        $thumbnail = $crawler->filter('#divNewsContent figure.image.align-center.img-wrapper img.pswp-img')->each(function ($node) {
            return $node->attr('src');
        })[0];
         */

         // print($thumbnail . "\n");

        /*$data = [
            'title' => $title,
            'slug' => 'abc',
            'content' => $content,
            'description' => $description
            //'thumbnail' => $thumbnail
        ];

         Post::create($data);*/


         $data=new Post_Dantri();
         $data->title = $title;
          $data->slug = "";
          $data->thumbnail = "";
         $data->description = $description;
         $data->content = $content;
         $data->save();

         print('lấy dữ liệu thành công !' . "\n");
    }
}
