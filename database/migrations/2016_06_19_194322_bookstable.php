<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Bookstable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'books' , function (Blueprint $table) {
            $table->bigInteger('id',true,true);
            $table->string('name')->nullable();
            $table->string('author')->nullable();
            $table->string('reference')->nullable();
            $table->integer('year')->nullable();
            $table->string('price')->nullable();
            $table->integer('inventory')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('books');
    }
}
