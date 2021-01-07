<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterSupplierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_supplier', function (Blueprint $table) {
            $table->string('kode_supplier', 50)->primary();
            $table->string('nama_supplier', 50)->nullable()->default(NULL);
            $table->string('no_telp_supplier', 15)->nullable()->default(NULL);
            $table->text('alamat_supplier')->nullable()->default(NULL);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_supplier');
    }
}
