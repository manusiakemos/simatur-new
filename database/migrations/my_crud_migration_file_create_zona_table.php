<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_zona', function (Blueprint $table) {
            $table->increments('zona_id' ,11)
                        ;
                            $table->enum('zona_type' ,['rural', 'sub_urban'])
                        ->nullable();
                            $table->integer('kelurahan_id' )
                        ->nullable();
                $table->float('zona_lat')
                ->nullable();
                $table->float('zona_lng')
                ->nullable();
                $table->float('zona_sub_1')
                ->nullable();
                $table->float('zona_sub_2')
                ->nullable();
                $table->float('zona_rural')
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
        Schema::dropIfExists('tb_zona');
    }
}
