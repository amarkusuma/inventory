<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\MasterSupplier;

class SupplierController extends Controller
{
    
    public function index()
    {
        $master_supplier = DB::table('master_supplier')->paginate(3);

        return view('supplier.index', ['master_supplier' => $master_supplier]);
    }

    public function add()
    {
        return view('supplier.add');
    }

    public function store(Request $request)
    {
        $validate = $request->only(['nama_supplier', 'no_telfon', 'alamat']);
        
        $master_supplier = DB::table('master_supplier')->latest('kode_supplier')->first();
        
        $get_kode_supplier = $master_supplier ? $master_supplier->kode_supplier : 'S000';

        $split = $get_kode_supplier ? str_split($get_kode_supplier, 1) : [];
        $no = $split[count($split)-1] + 1;

        $kode_supplier = 'S00'.$no;
        

        $master_supplier = collect($validate)->only(['nama_supplier'])
        ->merge([
            'kode_supplier' => $kode_supplier,
            'no_telp_supplier' => $validate['no_telfon'],
            'alamat_supplier' => $validate['alamat'],
            ])->all();

        $supplier = MasterSupplier::create($master_supplier);

        if($supplier){

            return redirect()->route('supplier');
        }
    }

    public function show($id)
    {
        $master_supplier = MasterSupplier::where('kode_supplier', $id)->first();

        return view('supplier.update', ['master_supplier' => $master_supplier]);
    }

    public function update(Request $request, $id)
    {
        $validate = $request->only(['nama_supplier', 'no_telfon', 'alamat']);
        
        $master_supplier = MasterSupplier::where('kode_supplier', $id)->first();
  
        $master_supplier->nama_supplier = $validate['nama_supplier'];
        $master_supplier->no_telp_supplier = $validate['no_telfon'];
        $master_supplier->alamat_supplier = $validate['alamat'];
        $master_supplier->save();

        if($master_supplier){

            return redirect()->route('supplier');
        }
    }

    public function delete($id)
    {
        $master_supplier = MasterSupplier::find($id);

        if ($master_supplier) {
            $master_supplier->delete();
            
            return redirect()->route('supplier');

        }

    }
}
