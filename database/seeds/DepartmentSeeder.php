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
            ['name' => 'College of Computer Studies', 'deletable' => 'true'],
            ['name' => 'Human Resources', 'deletable' => 'false'],
            ['name' => 'Office of the Total Quality', 'deletable' => 'false'],
            ['name' => 'Management Information Systems and Services', 'deletable' => 'false'],
        ]);
    }
}
