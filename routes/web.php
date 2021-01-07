<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login',  'AuthController@loginForm')->name('login');
Route::post('/login',  'AuthController@login');

Route::get('/logout',  'AuthController@logout');

Route::group(['middleware' => 'auth'], function (){

    Route::get('/dashboard', 'PembelianController@index');

    Route::get('/barang', 'BarangController@index')->name('barang');
    Route::get('/add-barang', 'BarangController@add')->name('add-barang');
    Route::post('/store-barang', 'BarangController@store')->name('store-barang');
    Route::get('/show-barang/{id}', 'BarangController@show')->name('show-barang');
    Route::put('/update-barang/{id}', 'BarangController@update')->name('update-barang');
    Route::get('/delete-barang/{id}', 'BarangController@delete')->name('delete-barang');


    Route::get('/pelanggan', 'PelangganController@index')->name('pelanggan');
    Route::get('/add-pelanggan', 'PelangganController@add')->name('add-pelanggan');
    Route::post('/store-pelanggan', 'PelangganController@store')->name('store-pelanggan');
    Route::get('/show-pelanggan/{id}', 'PelangganController@show')->name('show-pelanggan');
    Route::put('/update-pelanggan/{id}', 'PelangganController@update')->name('update-pelanggan');
    Route::get('/delete-pelanggan/{id}', 'PelangganController@delete')->name('delete-pelanggan');

    Route::get('/supplier', 'SupplierController@index')->name('supplier');
    Route::get('/add-supplier', 'SupplierController@add')->name('add-supplier');
    Route::post('/store-supplier', 'SupplierController@store')->name('store-supplier');
    Route::get('/show-supplier/{id}', 'SupplierController@show')->name('show-supplier');
    Route::put('/update-supplier/{id}', 'SupplierController@update')->name('update-supplier');
    Route::get('/delete-supplier/{id}', 'SupplierController@delete')->name('delete-supplier');


    Route::get('/transaksi-pembelian', 'PembelianController@index')->name('transaksi-pembelian');
    Route::get('/transaksi-pembelian-supplier', 'PembelianController@supplier')->name('transaksi-pembelian-supplier');
    Route::get('/transaksi-pembelian-barang', 'PembelianController@barang')->name('transaksi-pembelian-barang');

    Route::post('/add-transaksi-pembelian', 'PembelianController@store')->name('add-transaksi-pembelian');
    Route::get('/show-transaksi-pembelian/{id}', 'PembelianController@show')->name('show-transaksi-pembelian');
    Route::post('/update-transaksi-pembelian/{id}', 'PembelianController@update')->name('update-transaksi-pembelian');
    Route::get('/delete-transaksi-pembelian/{id}', 'PembelianController@delete')->name('delete-transaksi-pembelian');
    

    Route::post('/get-master-barang', 'PembelianController@get_barang')->name('get-master-barang');
    

    Route::get('/transaksi-penjualan', 'PenjualanController@index')->name('transaksi-penjualan');
    Route::get('/transaksi-penjualan-pelanggan', 'PenjualanController@pelanggan')->name('transaksi-penjualan-pelanggan');
    Route::get('/transaksi-penjualan-barang', 'PenjualanController@barang')->name('transaksi-penjualan-barang');

    Route::post('/add-transaksi-penjualan', 'PenjualanController@store')->name('add-transaksi-penjualan');
    Route::get('/show-transaksi-penjualan/{id}', 'PenjualanController@show')->name('show-transaksi-penjualan');
    Route::post('/update-transaksi-penjualan/{id}', 'PenjualanController@update')->name('update-transaksi-penjualan');
    Route::get('/delete-transaksi-penjualan/{id}', 'PenjualanController@delete')->name('delete-transaksi-penjualan');
    
    Route::get('/laporan', 'PenjualanController@laporan')->name('laporan');

    Route::post('/get-master-barang', 'PenjualanController@get_barang')->name('get-master-barang');

});