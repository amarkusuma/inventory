<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class insert_master_supplier extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $supplier = [
          
            [
                'kode_supplier' => 'S001',
                'nama_supplier' => 'PT agis',
                'no_telp_supplier' => '084675656752',
                'alamat_supplier' => 'boyolali',
                

            ],
            [
                'kode_supplier' => 'S002',
                'nama_supplier' => 'CV 99',
                'no_telp_supplier' => '087752752w',
                'alamat_supplier' => 'yogyakarta',
                
    
            ],
            [
                'kode_supplier' => 'S003',
                'nama_supplier' => 'PT Pelita Indah',
                'no_telp_supplier' => '08672757222 ',
                'alamat_supplier' => 'kediri',
                
    
            ]
        ];


      foreach($supplier as $data){
        DB::table('master_supplier')->insert([
            
            'kode_supplier' => $data['kode_supplier'],
            'nama_supplier' => $data['nama_supplier'],
            'no_telp_supplier' => $data['no_telp_supplier'],
            'alamat_supplier' => $data['alamat_supplier'],
        ]);
      }
    }
}
