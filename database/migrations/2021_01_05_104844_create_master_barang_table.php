<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_barang', function (Blueprint $table) {
            $table->string('kode_barang', 50)->primary()->unique();
            $table->string('nama_barang', 50)->nullable()->default(NULL);
            $table->text('deskripsi_barang')->nullable()->default(NULL);
            $table->double('harga_satuan')->nullable()->default(NULL);
            $table->integer('stok')->nullable()->default(NULL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_barang');
    }
}
