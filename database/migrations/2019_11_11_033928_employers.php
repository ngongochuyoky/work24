<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Employers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Tạo bảng cho người tuyển dụng
        Schema::create('employers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_company');
            $table->string('name_employer');
             $table->string('tel_employer');
            $table->string('email_employer');
            // thông tin đăng nhập
            $table->string('email');
            $table->string('password');
            $table->bigInteger('roles');
           
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
        Schema::dropIfExists('employers');
    }
}
