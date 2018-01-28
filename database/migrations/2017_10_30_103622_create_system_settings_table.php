<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name')->nullable();
            $table->string('website_url')->nullable();
            $table->string('logo')->nullable();
            $table->integer('login_notification')->default(0);
            $table->string('sender_email')->nullable();
            $table->string('sender_name')->nullable();
            $table->string('subscribers_limit')->nullable();
            $table->string('host')->nullable();
            $table->string('encryption')->nullable();
            $table->integer('port')->nullable();
            $table->integer('bcc_enabled')->default(0);
            $table->string('signature')->nullable();
            $table->string('service_provider')->nullable();
            $table->string('api_key')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('googleplus')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_settings');
    }
}
