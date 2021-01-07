<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPembelianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pembelian', function (Blueprint $table) {
            $table->string('kode_pembelian', 50)->nullable()->default(NULL);
            $table->string('kode_barang', 50)->nullable()->default(NULL);
            $table->double('harga_satuan')->nullable()->default(NULL);
            $table->integer('jumlah')->nullable()->default(NULL);

            $table->foreign('kode_pembelian')->references('kode_pembelian')->on('pembelian')->onDelete('set null');
            $table->foreign('kode_barang')->references('kode_barang')->on('master_barang')->onDelete('set null');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pembelian');
    }
}
