<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterBarang extends Model
{
    use HasFactory;

    protected $table = 'master_barang';

    protected $primaryKey = 'kode_barang';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
      'kode_barang', 'nama_barang', 'deskripsi_barang', 'harga_satuan', 'stok'
    ];

    public function detail_penjualan()
    {
      return $this->hasMany(DetailPenjualan::class,'kode_barang');
    }

    public function detail_pembelian()
    {
      return $this->hasMany(DetailPembelian::class,'kode_barang');
    }
}
