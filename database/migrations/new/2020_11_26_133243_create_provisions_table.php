<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provisions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('req');
            $table->text('response');
            $table->string('spId',191);
            $table->string('spPassword',191);
            $table->string('timeStamp',191);
            $table->string('transactionId',191);
            $table->string('msisdn',191);
            $table->string('serviceId',191);
            $table->string('operationType',191);
            $table->string('createdTime',191);
            $table->text('msg');
            $table->string('resultCode',191);
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
        Schema::dropIfExists('provisions');
    }
}
