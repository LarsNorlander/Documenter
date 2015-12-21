<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Creates tbl_departments
        Schema::create('tbl_departments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('department_name');
            $table->timestamps();
        });
        //Creates tbl_user_types
        Schema::create('tbl_user_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        //Creates tble_users
        Schema::create('tbl_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('fname');
            $table->string('lname');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->integer('user_dept_id')->unsigned();
            $table->foreign('user_dept_id')->references('id')->on('tbl_departments');
            $table->integer('user_type_id')->unsigned();
            $table->foreign('user_type_id')->references('id')->on('tbl_user_types');
            $table->rememberToken();
            $table->timestamps();
        });
        //Creates tbl_file_records
        Schema::create('tbl_file_records', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filename');
            $table->integer('total_versions');
            $table->integer('public_version');
            $table->integer('owner_id')->unsigned();
            $table->foreign('owner_id')->references('id')->on('tbl_users');
            $table->json('sharing');
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
        //Pretty self-explanatory for these lines
        Schema::drop('tbl_file_records');

        Schema::drop('tbl_users');

        Schema::drop('tbl_user_types');

        Schema::drop('tbl_departments');
    }
}
