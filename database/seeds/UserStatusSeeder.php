<?php

use Illuminate\Database\Seeder;

class UserStatusSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_user_status')->insert([
            ['name' => 'active'],
            ['name' => 'locked'],
        ]);
    }
}
