<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    use HasFactory;

    protected $table = 'detail_pembelian';

    protected $primaryKey = 'kode_pembelian';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
     'kode_pembelian', 'kode_barang', 'harga_satuan', 'jumlah'
    ];

    public function pembelian()
    {
      return $this->belongsTo(Pembelian::class,'kode_pembelian');
    }

    public function master_barang()
    {
      return $this->belongsTo(MasterBarang::class,'kode_barang');
    }

}
