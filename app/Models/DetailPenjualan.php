<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    use HasFactory;

    protected $table = 'detail_penjualan';

    protected $primaryKey = 'kode_penjualan';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
      'kode_penjualan', 'kode_barang', 'harga_satuan', 'jumlah'
    ];

    public function penjualan()
    {
      return $this->belongsTo(Penjualan::class,'kode_penjualan');
    }

    public function master_barang()
    {
      return $this->belongsTo(MasterBarang::class,'kode_barang');
    }
}
