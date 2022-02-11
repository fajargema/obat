<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();

            $table->string('kode');
            $table->string('nama');
            $table->string('satuan');
            $table->integer('harga');
            $table->date('tgl_masuk');
            $table->date('tgl_edit')->nullable();
            $table->integer('stok');
            $table->string('produsen');
            $table->string('distributor');

            $table->unsignedBigInteger('categories_id');
            $table->unsignedBigInteger('users_id');

            $table->foreign('categories_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('users_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('medicines');
    }
}
