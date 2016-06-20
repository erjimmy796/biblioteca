<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Saletable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale',function(Blueprint $table){
            $table->bigInteger('id',true,true);
            $table->bigInteger('idLibro')->unsigned();
            $table->string('price')->nullable();
            $table->integer('units')->nullable();
            $table->foreign('idLibro')->references('id')->on('books');
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
        Schema::drop('sale');
    }
}
