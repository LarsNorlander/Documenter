<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(DepartmentSeeder::class);
        $this->call(UserTypeSeeder::class);
        $this->call(UserStatusSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(DocTypesSeeder::class);
        Model::reguard();
    }
}
