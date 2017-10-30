<?php

use Illuminate\Database\Seeder;

class UserSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->truncate();
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '247ureports Admin',
                'email' => 'admin@247ureport.com',
                'password' => bcrypt('MoneyTime'),
                'created_at' => '2017-03-09 09:19:28',
                'updated_at' => '2017-03-09 08:19:28',
            )
        ));  
    }
}
