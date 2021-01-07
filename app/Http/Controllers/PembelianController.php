<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use App\Models\MasterSupplier;
use App\Models\MasterBarang;
use App\Models\DetailPembelian;
use App\Models\Pembelian;

class PembelianController extends Controller
{

    public function index()
    {
        $detail_pembelian = DetailPembelian::get();
     
        $detail_pembelian = collect($detail_pembelian)->map(function($data){
            
            $data['nama_barang'] = $data->master_barang &&  $data->master_barang->nama_barang ? $data->master_barang->nama_barang : NULL;
            $data['sub_total'] = $data->harga_satuan && $data->jumlah ? $data->harga_satuan * $data->jumlah : 0;

            return $data;
        });

        return view('pembelian.index', ['detail_pembelian' => $detail_pembelian]);
    }

    public function store(Request $request)
    {
       $validate = $request->only(['date', 'supplier_id', 'barang_id', 'harga_satuan', 'jumlah']);

       $pembelian = DB::table('pembelian')->latest('kode_pembelian')->first();
        
       $get_kode_pembelian = $pembelian ? $pembelian->kode_pembelian : 'TB000';

       $split = $get_kode_pembelian ? str_split($get_kode_pembelian, 1) : [];
       $no = $split[count($split)-1] + 1;

       $kode_pembelian = 'TB00'.$no;

       $data_pembelian = [
           'kode_pembelian' => $kode_pembelian, 
           'tanggal_pembelian' => $validate['date'],
           'kode_supplier' => $validate['supplier_id'],
           'total_biaya' => $validate['harga_satuan'] * $validate['jumlah'],
           'tanggal_dibuat' => $validate['date'],
           'dibuat_oleh' => Auth::user()->username,
       ];

       $data_detail_pembelian = [
        'kode_pembelian' => $kode_pembelian, 
        'kode_barang' => $validate['barang_id'],
        'harga_satuan' => $validate['harga_satuan'],
        'jumlah' => $validate['jumlah'],
       ];
       
       // update stok barang
       $master_barang = MasterBarang::find($validate['barang_id']);

       $master_barang->stok = $master_barang->stok + $validate['jumlah'];
       $master_barang->save();

       $save_pembelian = Pembelian::create($data_pembelian);

       $save_detail_pembelian = DetailPembelian::create($data_detail_pembelian);

       if($save_detail_pembelian && $save_pembelian){

       return redirect()->route('transaksi-pembelian');
       }
    }


    public function show($id)
    {
        $pembelian = Pembelian::find($id);

        $detail_pembelian = DetailPembelian::find($id);

        $data = collect($pembelian)->merge([
              'nama_barang' => $detail_pembelian->master_barang &&  $detail_pembelian->master_barang->nama_barang ? $detail_pembelian->master_barang->nama_barang : null,
              'nama_supplier' => $pembelian->supplier && $pembelian->supplier->nama_supplier ? $pembelian->supplier->nama_supplier : null,
              'harga_satuan' => $detail_pembelian && $detail_pembelian->harga_satuan ? $detail_pembelian->harga_satuan : null,
              'kode_barang' =>  $detail_pembelian &&  $detail_pembelian->kode_barang ? $detail_pembelian->kode_barang : null,
              'jumlah' =>  $detail_pembelian &&  $detail_pembelian->jumlah ? $detail_pembelian->jumlah : null,
        ])->all();

        // dd($data);

        return view('pembelian.update', ['transaksi_pembelian' => $data]);
    }

    public function update(Request $request, $id)
    {
        $validate = $request->only(['date', 'supplier_id', 'barang_id', 'harga_satuan', 'jumlah']);
        
        // update pembelian
        $pembelian = Pembelian::find($id);
        $pembelian->tanggal_pembelian = $validate['date'];
        $pembelian->kode_supplier = $validate['supplier_id'];
        $pembelian->total_biaya = $validate['harga_satuan'] * $validate['jumlah'];
        $pembelian->tanggal_dibuat = $validate['date'];
        $pembelian->dibuat_oleh = Auth::user()->username ;
        $pembelian->save();

        $detail_pembelian = DetailPembelian::find($id);
        
        // update stok master barang
        $master_barang = MasterBarang::where('kode_barang', $detail_pembelian->kode_barang)->first();
        $master_barang->stok =  $master_barang->stok - $detail_pembelian->jumlah + $validate['jumlah'];
        $master_barang->save();
        
        // update detail pembelian
        $detail_pembelian->kode_barang = $validate['barang_id'];
        $detail_pembelian->harga_satuan = $validate['harga_satuan'];
        $detail_pembelian->jumlah = $validate['jumlah'];
        $detail_pembelian->save(); 

        return redirect()->route('transaksi-pembelian');

    }

    public function delete($id)
    {
        $detail_pembelian = DetailPembelian::find($id);

        $master_barang = MasterBarang::where('kode_barang', $detail_pembelian->kode_barang)->first();
        $master_barang->stok =  $master_barang->stok - $detail_pembelian->jumlah ;
        $master_barang->save();

        $pembelian = Pembelian::find($id);

        $detail_pembelian->delete();
        $pembelian->delete();

        return redirect()->route('transaksi-pembelian');

    }

    function get_barang(Request $request)
    {
        $master_barang = MasterBarang::find($request['kode_barang']);

        return response()->json([
            'succes' => true,
            'message' => 'get all data barang',
            'data' => $master_barang,
        ],200);
    }

    function supplier()
    {
        $supplier = MasterSupplier::get();

        return response()->json([
            'succes' => true,
            'message' => 'get all data supplier',
            'data' => $supplier,
        ],200);
    }

    function barang()
    {
        $barang = MasterBarang::get();

        return response()->json([
            'succes' => true,
            'message' => 'get all data barang',
            'data' => $barang,
        ],200);
    }
}
