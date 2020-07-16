<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKunjunganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kunjungan', function (Blueprint $table) {
            $table->increments('kunjungan_id' ,11)
                        ;
                $table->date('kunjungan_tanggal')
                ->nullable();
                            $table->integer('tower_id' )
                        ->nullable();
                            $table->string('kunjungan_gambar' ,190)
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
        Schema::dropIfExists('tb_kunjungan');
    }
}
