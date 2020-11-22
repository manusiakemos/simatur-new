<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLatLngToSkpd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_skpd', function (Blueprint $table) {
            $table->double("skpd_lng")->after("skpd_nama");
            $table->double("skpd_lat")->after("skpd_nama");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_skpd', function (Blueprint $table) {
            $table->dropColumn("skpd_lat");
            $table->dropColumn("skpd_lng");
        });
    }
}
