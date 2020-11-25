<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrangeUssdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orange_ussds', function (Blueprint $table) {
            $table->increments('id');
            $table->text('req');
            $table->text('response');
            $table->string('language',191);
            $table->string('msisdn',191);
            $table->string('service_id',191);
            $table->string('host',191);
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
        Schema::dropIfExists('orange_ussds');
    }
}
