<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrangeSubscribesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orange_subscribes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('msisdn',191);
            $table->integer('active')->comment('0-notactive 1-active');
            $table->integer('orange_notify_id')->comment('orange_webs_id / orange_notifies_id');
            $table->string('table_name',191);
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
        Schema::dropIfExists('orange_subscribes');
    }
}
