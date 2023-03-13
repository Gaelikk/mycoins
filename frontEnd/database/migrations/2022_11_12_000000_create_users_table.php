<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nickname')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('avatar');
            $table->string('isAdmin')->default(0);
            //$table->unsignedBigInteger('collection_id');
            $table->unsignedBigInteger('country_id');
            //$table->foreign('collection_id')->references('collection_id')->on('collection');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->timestamp('email_verified_at')->nullable();
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

;
