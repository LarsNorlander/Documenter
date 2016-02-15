<?php

use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seeder for populating the UserTypeSeeder
        DB::table('tbl_user_types')->insert([
            ['name' => 'Super Admin'],
            ['name' => 'Department Head'],
            ['name' => 'Department Member'],
        ]);
    }
}
