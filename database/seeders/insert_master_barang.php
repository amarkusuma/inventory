<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class insert_master_barang extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $barang = [
          
            [
                'kode_barang' => 'B001',
                'nama_barang' => 'Printer L300',
                'deskripsi_barang' => 'printer warna',
                'harga_satuan' => '1000000',
                'stok' => '3'

            ],
            [
                'kode_barang' => 'B002',
                'nama_barang' => 'Hardist 500gb',
                'deskripsi_barang' => 'hardist external',
                'harga_satuan' => '500000',
                'stok' => '2'
    
            ],
            [
                'kode_barang' => 'B003',
                'nama_barang' => 'Ram 8 gb',
                'deskripsi_barang' => 'ram vgen ',
                'harga_satuan' => '700000',
                'stok' => '3'
    
            ]
        ];


      foreach($barang as $data){
        DB::table('master_barang')->insert([
            
            'kode_barang' => $data['kode_barang'],
            'nama_barang' => $data['nama_barang'],
            'deskripsi_barang' => $data['deskripsi_barang'],
            'harga_satuan' => $data['harga_satuan'],
            'stok' => $data['stok'],
        ]);
      }
    }
}
