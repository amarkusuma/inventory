<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian', function (Blueprint $table) {
            $table->string('kode_pembelian', 50)->primary();
            $table->date('tanggal_pembelian')->nullable()->default(NULL);
            $table->string('kode_supplier', 50)->nullable()->default(NULL);
            $table->double('total_biaya')->nullable()->default(NULL);
            $table->date('tanggal_dibuat')->nullable()->default(NULL);
            $table->string('dibuat_oleh', 50)->nullable()->default(NULL);
            
            $table->foreign('kode_supplier')->references('kode_supplier')->on('master_supplier')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembelian');
    }
}
