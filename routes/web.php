<?php
use Illuminate\Support\Facades\Auth;
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


Route::group(['middleware' => ['auth']], function () {
    Route::resource('kategori', 'KategoriBarangController');
    Route::resource('distributor', 'DistributorController');
    Route::resource('barang', 'BarangController');
    Route::resource('barang_keluar', 'BarangKeluarController');
    Route::resource('stok_opname', 'StokOpnameController');
    Route::resource('umkm', 'UmkmController');

    Route::group(['prefix' => 'kategori'], function () {
        Route::get('/{kategori}/barang', 'BarangController@perKategori')->name('barang.kategori');
    });

    Route::group(['prefix' => 'kategori'], function () {
        Route::get('/{kategori}/barang_keluar', 'BarangKeluarController@perKategori')->name('barang_keluar.kategori');
    });

    Route::group(['prefix' => 'kategori'], function () {
        Route::get('/{kategori}/stok_opname', 'StokOpnameController@perKategori')->name('stok_opname.kategori');
    });

    Route::get('/', 'DashboardController@index')->name('dashboard.index');
});


Route::group(['prefix' => 'pengelola', 'middleware' => 'Pengelola'], function (){
    Route::get('/', 'PengelolaController@index');
});

// Route::group(['prefix' => 'umkm', 'middleware' => 'Umkm'], function (){
//     Route::get('/', 'UmkmController@index');
// });

Auth::routes();

