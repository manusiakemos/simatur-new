<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkpdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_skpd', function (Blueprint $table) {
            $table->increments('skpd_id')
                ;
                            $table->string('skpd_nama' ,190)
                        ->nullable();
                $table->boolean('skpd_status')
                ->nullable();
                            $table->string('skpd_ip' ,190)
                        ->nullable();
                $table->string('skpd_tipe')
                ->nullable();
                            $table->string('skpd_kode' ,190)
                        ->nullable();
                $table->text('skpd_keterangan')
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
        Schema::dropIfExists('tb_skpd');
    }
}
