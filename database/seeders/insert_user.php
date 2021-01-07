<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class insert_user extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
          
            [
                'username' => 'amar',
                'jabatan' => 'programmer',
                'password' => 'amar123',

            ],
            [
                'username' => 'umar',
                'jabatan' => 'androidDev',
                'password' => 'umar123',
    
            ],
            [
                'username' => 'amir',
                'jabatan' => 'fullstack',
                'password' => 'amir123',
    
            ]
        ];


      foreach($user as $data){
        DB::table('master_user')->insert([
            
            'username' => $data['username'],
            'jabatan' => $data['jabatan'],
            'password' => Hash::make($data['password']),
        ]);
      }
    }
}
