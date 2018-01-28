<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\SystemSetting;

class DatabaseConfigProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if(\Schema::hasTable("system_settings")){
            $setting = SystemSetting::find(1);
            if(isset($setting)){
                config()->set([
                    'constants.SENDER_EMAIL' => $setting['sender_email'],
                    'constants.SENDER_NAME' => $setting['sender_name'],
                    'constants.COMPANY_NAME' => $setting['company_name'],
                    'constants.WEB_URL' => $setting['website_url'],
                    'constants.SUBSCRIBER_LIMIT' => $setting['subscribers_limit']
                ]);
                config(['mail.host' => $setting['host']]);
                config(['mail.port' => $setting['port']]);
                config(['mail.username' => $setting['username']]);
                config(['mail.password' => $setting['password']]);
                config(['mail.encryption' => $setting['encryption']]);
                config(['mail.from.address' => $setting['sender_email']]);
                config(['mail.from.name' => $setting['sender_name']]);
            }
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
