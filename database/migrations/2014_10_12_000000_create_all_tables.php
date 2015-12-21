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
        Schema::create('tbl_departments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('department_name');
        });

        Schema::create('tbl_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->integer('user_dept_id')->unsigned();
            $table->foreign('user_dept_id')->references('id')->on('tbl_departments');
            $table->rememberToken();
            $table->timestamps();
        });

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
        Schema::drop('tbl_file_records');

        Schema::drop('tbl_users');

        Schema::drop('tbl_departments');
    }
}
