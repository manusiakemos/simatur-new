<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArsipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_arsip', function (Blueprint $table) {
            $table->increments('arsip_id', 11);
            $table->string('arsip_name', 190)
                ->nullable();
            $table->string('arsip_file', 190)
                ->nullable();
            $table->string('arsip_slug', 190)
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
        Schema::dropIfExists('_arsip');
    }
}
