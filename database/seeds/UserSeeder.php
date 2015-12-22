<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seeder for populating the user table
        DB::table('tbl_users')->insert([
            ['username' => 'superadmin', 'fname' => 'Lars Joseph', 'lname' => 'Norlander', 'email' => 'lars.nrlndr+DevSAdmin@gmail.com', 'password' => md5("superadmin"), 'user_dept_id' => '3', 'user_type_id' => '1'],
            ['username' => 'ccshead', 'fname' => 'CCS', 'lname' => 'Head', 'email' => 'lars.nrlndr+DevCCSHead@gmail.com', 'password' => md5("ccshead"), 'user_dept_id' => '1', 'user_type_id' => '3'],
            ['username' => 'camphead', 'fname' => 'CAMP', 'lname' => 'Head', 'email' => 'lars.nrlndr+DevCAMPHead@gmail.com', 'password' => md5("camphead"), 'user_dept_id' => '2', 'user_type_id' => '3'],
            ['username' => 'ccsmem', 'fname' => 'CCS', 'lname' => 'Member', 'email' => 'lars.nrlndr+DevCCSMem@gmail.com', 'password' => md5("ccsmem"), 'user_dept_id' => '1', 'user_type_id' => '4'],
            ['username' => 'camphead', 'fname' => 'CAMP', 'lname' => 'Head', 'email' => 'lars.nrlndr+DevCAMPMem@gmail.com', 'password' => md5("campmem"), 'user_dept_id' => '2', 'user_type_id' => '4'],
            ['username' => 'aufadmin', 'fname' => 'AUF', 'lname' => 'Admin', 'email' => 'lars.nrlndr+DevAdmin@gmail.com', 'password' => md5("aufadmin"), 'user_dept_id' => '3', 'user_type_id' => '2'],
        ]);
    }
}
