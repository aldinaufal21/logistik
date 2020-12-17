<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('harga_beli');
            $table->string('jumlah');
            $table->timestamps();
            $table->bigInteger('kategori_id')->unsigned();
            $table->bigInteger('distributor_id')->unsigned();
            $table->foreign('kategori_id')->references('id')->on('kategori');  
            $table->foreign('distributor_id')->references('id')->on('distributor');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang');
    }
}
