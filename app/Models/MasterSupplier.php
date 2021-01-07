<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MasterSupplier extends Model
{
    use HasFactory;

    protected $table = 'master_supplier';

    protected $primaryKey = 'kode_supplier';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
     'kode_supplier', 'nama_supplier', 'no_telp_supplier', 'alamat_supplier'
    ];

    public function pembelian()
    {
        return $this->HasMany(Pembelian::class,'kode_supplier');
    }
}
