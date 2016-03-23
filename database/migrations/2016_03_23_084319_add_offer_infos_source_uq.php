<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOfferInfosSourceUq extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phone_infos', function (Blueprint $table) {
            $table->unique(['source_id', 'id_source'], 'source_uq');
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
            $table->dropUnique('source_uq');
        });
    }
}
