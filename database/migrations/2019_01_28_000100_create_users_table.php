<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('surname');
            $table->boolean('is_admin')->default(false);
            $table->integer('city_id')->unsigned();
            $table->string('mobile_phone')->unique();
            $table->boolean('is_mobile_verified')->default(false);
            $table->integer('status_id')->unsigned()->default(1);
            $table->boolean('can_be_brand_face')->default(false);
            $table->string('about_me')->nullable();
            $table->string('avatar')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('status_id')->references('id')->on('statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
