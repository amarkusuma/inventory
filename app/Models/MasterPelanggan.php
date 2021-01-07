<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPelanggan extends Model
{
    use HasFactory;

    protected $table = 'master_pelanggan';

    protected $primaryKey = 'kode_pelanggan';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
     'kode_pelanggan', 'nama_pelanggan', 'no_telp_pelanggan', 'alamat_pelanggan'
    ];

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class,'kode_pelanggan');
    }
}
