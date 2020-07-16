<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTowerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_tower', function (Blueprint $table) {
            $table->increments('tower_id', 11);
            $table->integer('provider_id')
                ->nullable();
            $table->integer('kelurahan_id')
                ->nullable();
            $table->text('tower_address')
                ->nullable();
            $table->string('tower_kode')
                ->nullable();
            $table->text('tower_desc')
                ->nullable();
            $table->double('tower_lng')
                ->nullable();
            $table->double('tower_lat')
                ->nullable();
            $table->string('tower_status')
                ->nullable();
            $table->string('tower_size_type')
                ->nullable();
            $table->string('tower_owner_type')
                ->nullable();
            $table->string('tower_year', 4)
                ->nullable();
            $table->boolean('tower_is_active')
                ->nullable();
            $table->double('tower_height')
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
        Schema::dropIfExists('tb_tower');
    }
}
