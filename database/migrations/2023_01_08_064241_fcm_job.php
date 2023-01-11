<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FcmJob extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fcm_job', function (Blueprint $table) {
            $table->increments('fj_id')->comment('primary id');
            $table->string('identifier', 64)->comment('messaging identifier');
            $table->json('message')->comment('message info');
            $table->json('fcm_result')->comment('fcm result');
            $table->dateTime('deliver_at')->comment('deliver time (Y-m-d H:i:s)');
            $table->integer('created_at')->unsigned();
            $table->integer('updated_at')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fcm_job');
    }
}
