<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'pembelian';

    protected $primaryKey = 'kode_pembelian';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
      'kode_pembelian', 'tanggal_pembelian', 'kode_supplier', 'total_biaya', 'tanggal_dibuat', 'dibuat_oleh'
    ];

    public function detail_pembelian()
    {
      return $this->hasMany(DetailPembelian::class,'kode_pembelian');
    }

    public function supplier()
    {
      return $this->belongsTo(MasterSupplier::class,'kode_supplier');
    }
}
