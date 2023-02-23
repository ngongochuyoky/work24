<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InfoProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_profile', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_position');
            $table->bigInteger('id_degree');
            $table->bigInteger('id_experience');
            $table->bigInteger('id_cities');
            $table->bigInteger('id_category');
            $table->bigInteger('id_form_of_work');
            $table->bigInteger('id_chuc_vu');
            $table->bigInteger('id_salary');
            $table->string('description', 1000);
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
        Schema::dropIfExists('info_profile');
    }
}
