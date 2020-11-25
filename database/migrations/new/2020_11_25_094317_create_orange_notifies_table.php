<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrangeNotifiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orange_notifies', function (Blueprint $table) {
            $table->increments('id');
            $table->text('req');
            $table->text('response');
            $table->string('action',191);
            $table->string('msisdn',191);
            $table->string('service_id',191);
            $table->string('notification_result',191);
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
        Schema::dropIfExists('orange_notifies');
    }
}
