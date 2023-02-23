<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Jobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // tạo bảng việc làm
        Schema::create('jobs', function (Blueprint $table) {
           $table->bigIncrements('id');
            $table->bigInteger('id_employer');
            $table->string('name');
            $table->bigInteger('id_salary'); // lương
            $table->bigInteger('id_experience'); // kinh nghiệm
            $table->bigInteger('id_degree'); // bằng cấp
            $table->integer('number_people'); // sl cần tuyển
            $table->bigInteger('id_position'); // chức vụ
            $table->bigInteger('id_form_of_work'); // hình thức làm việc
            $table->string('gender');
            $table->string('id_category'); // nganh nghe
            $table->string('id_cities'); // dia diem
            $table->string('description', 2000);
            $table->string('Welfare', 1000); // phúc lợi
            $table->string('requirements_other', 2000);
            $table->string('language');
            $table->date('date_expired'); // ngày hết hạn 
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
