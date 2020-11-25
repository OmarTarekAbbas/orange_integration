<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrangeWebsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orange_webs', function (Blueprint $table) {
            $table->increments('id');
            $table->text('req');
            $table->text('response');
            $table->string('spId',191);
            $table->string('sp_password',191);
            $table->string('time_stamp',191);
            $table->string('service_number',191);
            $table->string('calling_party_id',191);
            $table->string('selfcare_command',191);
            $table->string('on_bearer_type',191);
            $table->string('on_result_code',191);
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
        Schema::dropIfExists('orange_webs');
    }
}
