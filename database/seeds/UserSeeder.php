<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seeder for populating the user table
        DB::table('tbl_users')->insert([
            ['username'       => 'admin',
             'fname'          => 'Jhon',
             'lname'          => 'Doe',
             'email'          => 'jhon.doe@gmail.com',
             'password'       => bcrypt('admin'),
             'user_dept_id'   => '4',
             'user_type_id'   => '1',
             'user_status_id' => '1',
             'user_tags'      => '[]']]);
    }
}
