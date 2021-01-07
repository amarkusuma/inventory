<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_penjualan', function (Blueprint $table) {
            $table->string('kode_penjualan', 50)->nullable()->default(NULL);
            $table->string('kode_barang', 50)->nullable()->default(NULL);
            $table->double('harga_satuan')->nullable()->default(NULL);
            $table->integer('jumlah')->nullable()->default(NULL);

            $table->foreign('kode_penjualan')->references('kode_penjualan')->on('penjualan')->onDelete('set null');
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
        Schema::dropIfExists('detail_penjualan');
    }
}
