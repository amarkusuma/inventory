<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->string('kode_penjualan', 50)->primary();
            $table->date('tanggal_penjualan')->nullable()->default(NULL);
            $table->string('kode_pelanggan')->nullable()->default(NULL);
            $table->double('total_biaya')->nullable()->default(NULL);
            $table->date('tanggal_dibuat')->nullable()->default(NULL);
            $table->string('dibuat_oleh', 50)->nullable()->default(NULL);

            $table->foreign('kode_pelanggan')->references('kode_pelanggan')->on('master_pelanggan')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penjualan');
    }
}
