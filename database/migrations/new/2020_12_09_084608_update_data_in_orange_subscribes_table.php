<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDataInOrangeSubscribesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orange_subscribes', function (Blueprint $table) {
            $table->tinyInteger("free")->comment('1- free  | 0- not free');
            $table->renameColumn("orange_notify_id","orange_channel_id")->comment("orange_ussd_id | orange_web_id | orange_sms_id");
            $table->integer("service_id")->nullable();
            $table->date("subscribe_due_date")->nullable();
            $table->integer("last_charge_id")->nullable();
            $table->integer('active')->comment('0-pending | 1-active | 2- unsub')->change();
            $table->string("type")->nullable()->comment("ussd | web | sms | charging");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orange_subscribes', function (Blueprint $table) {
            //
        });
    }
}
