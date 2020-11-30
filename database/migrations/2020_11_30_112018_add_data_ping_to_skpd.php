<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDataPingToSkpd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('tb_skpd', 'data_ping')){
            Schema::table('tb_skpd', function (Blueprint $table) {
                $table->json('data_ping')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('skpd', function (Blueprint $table) {
            $table->dropColumn('data_ping');
        });
    }
}
