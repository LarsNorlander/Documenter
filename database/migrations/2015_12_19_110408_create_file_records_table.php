<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_file_records', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filename');
            $table->integer('total_versions');
            $table->integer('public_version');
            $table->string('owner');
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
    }
}
