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
            ['username'       => 'lars.nrlndr',
             'fname'          => 'Lars Joseph',
             'lname'          => 'Norlander',
             'email'          => 'lars.nrlndr+DevSAdmin@gmail.com',
             'password'       => bcrypt('superadmin'),
             'user_dept_id'   => '4',
             'user_type_id'   => '1',
             'user_status_id' => '1',
             'user_tags'      => '[]'],

            ['username'       => 'ccshead',
             'fname'          => 'Paul',
             'lname'          => 'Xavier',
             'email'          => 'lars.nrlndr+DevCCSHead@gmail.com',
             'password'       => bcrypt("ccshead"),
             'user_dept_id'   => '1',
             'user_type_id'   => '2',
             'user_status_id' => '1',
             'user_tags'      => '[]'],

            ['username'       => 'ccsmem',
             'fname'          => 'Harold',
             'lname'          => 'Smith',
             'email'          => 'lars.nrlndr+DevCCSMem@gmail.com',
             'password'       => bcrypt("ccsmem"),
             'user_dept_id'   => '1',
             'user_type_id'   => '3',
             'user_status_id' => '1',
             'user_tags'      => '[]'],

            ['username'       => 'hrhead',
             'fname'          => 'Angeline',
             'lname'          => 'Gal',
             'email'          => 'lars.nrlndr+DevAdmin@gmail.com',
             'password'       => bcrypt("aufadmin"),
             'user_dept_id'   => '2',
             'user_type_id'   => '2',
             'user_status_id' => '1',
             'user_tags'      => '[]'],
        ]);
    }
}
