<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori', function (Blueprint $table) {
            $table->increments('kategori_id' ,11)
                        ;
                            $table->string('kategori_nama' ,190)
                        ->nullable();
                            $table->string('kategori_slug' ,190)
                        ->nullable();
                            $table->boolean('kategori_status' ,10)
                        ->nullable();
                            $table->string('kategori_gambar' ,190)
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
        Schema::dropIfExists('kategori');
    }
}
