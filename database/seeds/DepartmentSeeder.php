<?php

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Seeder for populating the departments table
        DB::table('tbl_departments')->insert([
            ['name' => 'College of Computer Studies'],
            ['name' => 'College of Allied Medical Professions'],
            ['name' => 'Administration'],
        ]);
    }
}
