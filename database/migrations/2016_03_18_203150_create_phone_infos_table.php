<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhoneInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phone_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('phone_id');
            $table->string('source_id');
            $table->string('id_source');
            $table->text('data');
            $table->timestamps();

            $table->foreign('phone_id', 'phone_info_phone_fk')
                ->references('id')->on('phones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('phone_infos', function (Blueprint $table) {
            $table->dropForeign('phone_info_phone_fk');
        });
        Schema::drop('phone_infos');
    }
}
