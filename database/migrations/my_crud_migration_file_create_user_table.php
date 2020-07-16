<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id' ,11)
                        ;
                            $table->string('name' ,190)
                        ->nullable();
                            $table->string('email' ,190)
                        ->nullable();
                            $table->string('username' ,190)
                        ->nullable();
                            $table->string('avatar' ,190)
                        ->nullable();
                            $table->string('phone' ,190)
                        ->nullable();
                            $table->enum('role' ,['admin', 'super-admin'])
                        ->nullable();
                            $table->text('password' ,190)
                        ->nullable();
                            $table->text('api_token' ,190)
                        ->nullable();
                            $table->text('remember_token' ,190)
                        ->nullable();
                $table->timestamp('email_verified_at')
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
        Schema::dropIfExists('users');
    }
}
