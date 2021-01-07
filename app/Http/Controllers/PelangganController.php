<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\MasterPelanggan;

class PelangganController extends Controller
{
    public function index()
    {
        $master_pelanggan = DB::table('master_pelanggan')->paginate(3);

        return view('pelanggan.index', ['master_pelanggan' => $master_pelanggan]);
    }

    public function add()
    {
        return view('pelanggan.add');
    }

    public function store(Request $request)
    {
        $validate = $request->only(['nama_pelanggan', 'no_telfon', 'alamat']);
        
        $master_pelanggan = DB::table('master_pelanggan')->latest('kode_pelanggan')->first();
        
        $get_kode_pelanggan = $master_pelanggan ? $master_pelanggan->kode_pelanggan : 'P000';

        $split = $get_kode_pelanggan ? str_split($get_kode_pelanggan, 1) : [];
        $no = $split[count($split)-1] + 1;

        $kode_pelanggan = 'P00'.$no;
        

        $master_pelanggan = collect($validate)->only(['nama_pelanggan'])
        ->merge([
            'kode_pelanggan' => $kode_pelanggan,
            'no_telp_pelanggan' => $validate['no_telfon'],
            'alamat_pelanggan' => $validate['alamat'],
            ])->all();

        $pelanggan = MasterPelanggan::create($master_pelanggan);

        if($pelanggan){

            return redirect()->route('pelanggan');
        }
    }

    public function show($id)
    {
        $master_pelanggan = MasterPelanggan::where('kode_pelanggan', $id)->first();

        return view('pelanggan.update', ['master_pelanggan' => $master_pelanggan]);
    }

    public function update(Request $request, $id)
    {
        $validate = $request->only(['nama_pelanggan', 'no_telfon', 'alamat']);
        
        $master_pelanggan = MasterPelanggan::where('kode_pelanggan', $id)->first();
  
        $master_pelanggan->nama_pelanggan = $validate['nama_pelanggan'];
        $master_pelanggan->no_telp_pelanggan = $validate['no_telfon'];
        $master_pelanggan->alamat_pelanggan = $validate['alamat'];
        $master_pelanggan->save();

        if($master_pelanggan){

            return redirect()->route('pelanggan');
        }
    }

    public function delete($id)
    {
        $master_pelanggan = MasterPelanggan::find($id);

        if ($master_pelanggan) {
            $master_pelanggan->delete();
            
            return redirect()->route('pelanggan');

        }
    }


}
