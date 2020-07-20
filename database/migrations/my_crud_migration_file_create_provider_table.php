<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_provider', function (Blueprint $table) {
            $table->increments('provider_id', 11);
            $table->string('provider_name')
                ->nullable();
            $table->string('provider_type')
                ->nullable();
            $table->string('provider_color')
                ->nullable();
            $table->boolean('provider_operator')
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
        Schema::dropIfExists('tb_provider');
    }
}
