<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class insert_master_pelanggan extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pelanggan = [
          
            [
                'kode_pelanggan' => 'P001',
                'nama_pelanggan' => 'Henry',
                'no_telp_pelanggan' => '084675656752',
                'alamat_pelanggan' => 'tegal',
                

            ],
            [
                'kode_pelanggan' => 'P002',
                'nama_pelanggan' => 'Bayu Hidayat',
                'no_telp_pelanggan' => '087752752',
                'alamat_pelanggan' => 'yogyakarta',
                
    
            ],
            [
                'kode_pelanggan' => 'B003',
                'nama_pelanggan' => 'Aqila',
                'no_telp_pelanggan' => '08672757222 ',
                'alamat_pelanggan' => 'kediri',
                
    
            ]
        ];


      foreach($pelanggan as $data){
        DB::table('master_pelanggan')->insert([
            
            'kode_pelanggan' => $data['kode_pelanggan'],
            'nama_pelanggan' => $data['nama_pelanggan'],
            'no_telp_pelanggan' => $data['no_telp_pelanggan'],
            'alamat_pelanggan' => $data['alamat_pelanggan'],
        ]);
      }
    }
    
}
