<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';

    protected $primaryKey = 'kode_penjualan';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
      'kode_penjualan', 'tanggal_penjualan', 'kode_pelanggan', 'total_biaya', 'tanggal_dibuat', 'dibuat_oleh'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(MasterPelanggan::class,'kode_pelanggan');
    }

    public function detail_penjualan()
    {
        return $this->hasMany(DetailPenjualan::class,'kode_penjualan');
    }

}
