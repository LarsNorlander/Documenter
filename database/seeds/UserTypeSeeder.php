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
            ['name' => 'super_admin'],
            ['name' => 'org_head'],
            ['name' => 'dept_head'],
            ['name' => 'dept_mem'],
        ]);
    }
}
