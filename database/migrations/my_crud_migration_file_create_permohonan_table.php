<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermohonanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_permohonan', function (Blueprint $table) {
            $table->increments('p_id', 11);
            $table->text('p_keterangan')
                ->nullable();
            $table->text('p_alamat')
                ->nullable();
            $table->text('p_file')
                ->nullable();
            $table->string('p_status')
                ->nullable();
            $table->text('p_alasan')
                ->nullable();
            $table->integer('kelurahan_id')
                ->nullable();
            $table->integer('user_id')
                ->nullable();
            $table->double('p_lat')
                ->nullable();
            $table->double('p_lng')
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
        Schema::dropIfExists('_permohonan');
    }
}
