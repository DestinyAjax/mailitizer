<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('system_settings')->truncate();
        \DB::table('system_settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'company_name' => "My Company",
                'subscribers_limit' => 5000,
                'login_notification' => 1,
                'bcc_enabled' => 0,
                'created_at' => '2017-10-09 09:19:28',
                'updated_at' => '2017-10-09 08:19:28',
            )
        ));  
    }
}
