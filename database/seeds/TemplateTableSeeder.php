<?php

use Illuminate\Database\Seeder;

class TemplateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('templates')->truncate();
        \DB::table('templates')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Custom',
                'slug' => 'custom',
                'status' => 1,
                'created_at' => '2017-10-09 09:19:28',
                'updated_at' => '2017-10-09 08:19:28',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Green',
                'slug' => 'green',
                'status' => 1,
                'created_at' => '2017-10-09 09:19:28',
                'updated_at' => '2017-10-09 08:19:28',
            )
        ));  
    }
}
