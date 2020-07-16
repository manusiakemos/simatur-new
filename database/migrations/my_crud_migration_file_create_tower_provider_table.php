<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTowerProviderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_tower_provider', function (Blueprint $table) {
            $table->increments('tp_id', 11);
            $table->integer('tower_id')
                ->nullable();
            $table->integer('provider_id')
                ->nullable();
            $table->string('koneksi_tipe')
                ->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('tb_tower_provider');
    }
}
