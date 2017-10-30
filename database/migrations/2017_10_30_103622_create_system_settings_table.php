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
            $table->string('sender_email')->nullable();
            $table->string('sender_name')->nullable();
            $table->integer('template_enabled')->default(0);
            $table->string('number_of_subscribrs')->nullable();
            $table->integer('login_notification')->default(0);
            $table->integer('cc_enabled')->default(0);
            $table->integer('bcc_enabled')->default(0);
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
