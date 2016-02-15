<?php

use Illuminate\Database\Seeder;

class DocTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_doc_types')->insert([
            ['name' => 'Document'],
            ['name' => 'Achievement'],
            ['name' => 'Memo'],
        ]);
    }
}
