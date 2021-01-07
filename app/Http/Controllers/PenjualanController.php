<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\MasterPelanggan;
use App\Models\MasterBarang;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;

class PenjualanController extends Controller
{
    public function index()
    {
        $detail_penjualan = DetailPenjualan::get();
     
        $detail_penjualan = collect($detail_penjualan)->map(function($data){
            
            $data['nama_barang'] = $data->master_barang &&  $data->master_barang->nama_barang ? $data->master_barang->nama_barang : NULL;
            $data['sub_total'] = $data->harga_satuan && $data->jumlah ? $data->harga_satuan * $data->jumlah : 0;

            return $data;
        });

        return view('penjualan.index', ['detail_penjualan' => $detail_penjualan]);
    }


    public function store(Request $request)
    {
       $validate = $request->only(['date', 'pelanggan_id', 'barang_id', 'harga_satuan', 'jumlah']);
        
       $master_barang = MasterBarang::find($validate['barang_id']);

       if($master_barang->stok - $validate['jumlah'] >= 0){

        // update stok barang
       $master_barang->stok = $master_barang->stok - $validate['jumlah'];
       $master_barang->save();

       $penjualan = DB::table('penjualan')->latest('kode_penjualan')->first();
        
       $get_kode_penjualan = $penjualan ? $penjualan->kode_penjualan : 'TJ000';

       $split = $get_kode_penjualan ? str_split($get_kode_penjualan, 1) : [];
       $no = $split[count($split)-1] + 1;

       $kode_penjualan = 'TJ00'.$no;

       $data_penjualan = [
           'kode_penjualan' => $kode_penjualan, 
           'tanggal_penjualan' => $validate['date'],
           'kode_pelanggan' => $validate['pelanggan_id'],
           'total_biaya' => $validate['harga_satuan'] * $validate['jumlah'],
           'tanggal_dibuat' => $validate['date'],
           'dibuat_oleh' => Auth::user()->username,
       ];

       $data_detail_penjualan = [
        'kode_penjualan' => $kode_penjualan, 
        'kode_barang' => $validate['barang_id'],
        'harga_satuan' => $validate['harga_satuan'],
        'jumlah' => $validate['jumlah'],
       ];

       Penjualan::create($data_penjualan);

       DetailPenjualan::create($data_detail_penjualan);

       return redirect()->route('transaksi-penjualan');

      }
      else{

      return redirect()->route('transaksi-penjualan')->with(['warning' => 'stok barang kurang dari jumlah yang di inginkan']);

      }

    }

    public function show($id)
    {
        $penjualan = Penjualan::find($id);

        $detail_penjualan = DetailPenjualan::find($id);

        $data = collect($penjualan)->merge([
              'nama_barang' => $detail_penjualan->master_barang &&  $detail_penjualan->master_barang->nama_barang ? $detail_penjualan->master_barang->nama_barang : null,
              'nama_pelanggan' => $penjualan->pelanggan && $penjualan->pelanggan->nama_pelanggan ? $penjualan->pelanggan->nama_pelanggan : null,
              'harga_satuan' => $detail_penjualan && $detail_penjualan->harga_satuan ? $detail_penjualan->harga_satuan : null,
              'kode_barang' =>  $detail_penjualan &&  $detail_penjualan->kode_barang ? $detail_penjualan->kode_barang : null,
              'jumlah' =>  $detail_penjualan &&  $detail_penjualan->jumlah ? $detail_penjualan->jumlah : null,
        ])->all();


        return view('penjualan.update', ['transaksi_penjualan' => $data]);
    }


    public function update(Request $request, $id)
    {
        $validate = $request->only(['date', 'pelanggan_id', 'barang_id', 'harga_satuan', 'jumlah']);
        
        // update penjualan
        $penjualan = Penjualan::find($id);
        $penjualan->tanggal_penjualan = $validate['date'];
        $penjualan->kode_pelanggan = $validate['pelanggan_id'];
        $penjualan->total_biaya = $validate['harga_satuan'] * $validate['jumlah'];
        $penjualan->tanggal_dibuat = $validate['date'];
        $penjualan->dibuat_oleh = Auth::user()->username ;
        $penjualan->save();

        $detail_penjualan = DetailPenjualan::find($id);
        
        // update stok master barang
        $master_barang = MasterBarang::where('kode_barang', $detail_penjualan->kode_barang)->first();
        $master_barang->stok =  $master_barang->stok + $detail_penjualan->jumlah - $validate['jumlah'];
        $master_barang->save();
        
        // update detail penjualan
        $detail_penjualan->kode_barang = $validate['barang_id'];
        $detail_penjualan->harga_satuan = $validate['harga_satuan'];
        $detail_penjualan->jumlah = $validate['jumlah'];
        $detail_penjualan->save(); 

        return redirect()->route('transaksi-penjualan');

    }

    public function delete($id)
    {
        $detail_penjualan = DetailPenjualan::find($id);

        $master_barang = MasterBarang::where('kode_barang', $detail_penjualan->kode_barang)->first();
        $master_barang->stok =  $master_barang->stok + $detail_penjualan->jumlah ;
        $master_barang->save();

        $penjualan = penjualan::find($id);

        $detail_penjualan->delete();
        $penjualan->delete();

        return redirect()->route('transaksi-penjualan');

    }


    public function laporan()
    {
        $data = DB::table('master_barang')
                ->select('master_barang.kode_barang', 'b.Transaksi', 'detail_pembelian.jumlah as masuk',
                'detail_penjualan.jumlah AS keluar', 'pembelian.tanggal_pembelian', 'penjualan.tanggal_penjualan')
                ->join(DB::raw('( SELECT kode_barang, kode_penjualan AS Transaksi FROM detail_penjualan
                UNION ALL
                SELECT kode_barang, kode_pembelian AS Transaksi FROM detail_pembelian) b'), 
                function($join)
                {
                   $join->on('master_barang.kode_barang', '=', 'b.kode_barang');
                })
                ->leftJoin('detail_penjualan', 'detail_penjualan.kode_penjualan', '=', 'b.Transaksi')
                ->leftJoin('detail_pembelian', 'detail_pembelian.kode_pembelian', '=', 'b.Transaksi')
                ->leftJoin('pembelian', 'pembelian.kode_pembelian', '=', 'b.Transaksi')
                ->leftJoin('penjualan', 'penjualan.kode_penjualan', '=', 'b.Transaksi')
                ->paginate(4);

        // dd($data);

        return view('laporan.index', ['laporan' => $data]);
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

    function pelanggan()
    {
        $pelanggan = MasterPelanggan::get();

        return response()->json([
            'succes' => true,
            'message' => 'get all data pelanggan',
            'data' => $pelanggan,
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
