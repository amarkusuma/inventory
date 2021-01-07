<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MasterBarang;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    
    public function index()
    {
        $master_barang = DB::table('master_barang')->paginate(3);

        return view('barang.index', ['master_barang' => $master_barang]);
    }

    public function add()
    {
        return view('barang.add');
    }

    public function store(Request $request)
    {
        $validate = $request->only(['nama_barang', 'deskripsi', 'harga', 'stok']);
        
        $master_barang = DB::table('master_barang')->latest('kode_barang')->first();
        
        $get_kode_barang = $master_barang ? $master_barang->kode_barang : 'B000';

        $split = $get_kode_barang ? str_split($get_kode_barang, 1) : [];
        $no = $split[count($split)-1] + 1;

        $kode_barang = 'B00'.$no;
        

        $master_barang = collect($validate)->only(['nama_barang'])
        ->merge([
            'kode_barang' => $kode_barang,
            'deskripsi_barang' => $validate['deskripsi'],
            'harga_satuan' => $validate['harga'],
            'stok' => $validate['stok']
            ])->all();
        // dd($master_barang);

        $barang = MasterBarang::create($master_barang);

        if($barang){

            return redirect()->route('barang');
        }
    }

    public function show($id)
    {
        $master_barang = MasterBarang::where('kode_barang', $id)->first();

        return view('barang.update', ['master_barang' => $master_barang]);
    }

    public function update(Request $request, $id)
    {
        $validate = $request->only(['kode_barang','nama_barang', 'deskripsi', 'harga', 'stok']);
        
        $master_barang = MasterBarang::where('kode_barang', $id)->first();
  
        $master_barang->nama_barang = $validate['nama_barang'];
        $master_barang->deskripsi_barang = $validate['deskripsi'];
        $master_barang->harga_satuan = $validate['harga'];
        $master_barang->stok = $validate['stok'];
        $master_barang->save();

        if($master_barang){

            return redirect()->route('barang');
        }
    }

    public function delete($id)
    {
        $master_barang = MasterBarang::find($id);

        if ($master_barang) {
            $master_barang->delete();
            
            return redirect()->route('barang');

        }
    }
}
