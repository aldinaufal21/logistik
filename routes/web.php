<?php

use App\Http\Controllers\UmkmController;
use App\User;
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


Route::resource('kategori', 'KategoriBarangController')->middleware('auth');
Route::resource('distributor', 'DistributorController')->middleware('auth');
Route::resource('barang', 'BarangController')->middleware('auth');
Route::resource('barang_keluar', 'BarangKeluarController')->middleware('auth');
Route::resource('stok_opname', 'StokOpnameController')->middleware('auth');
Route::resource('umkm', 'UmkmController')->middleware('auth');

Route::group(['prefix' => 'pengelola', 'middleware' => 'Pengelola'], function (){
    Route::get('/', 'PengelolaController@index');
});

// Route::group(['prefix' => 'umkm', 'middleware' => 'Umkm'], function (){
//     Route::get('/', 'UmkmController@index');
// });

Route::get('/', 'DashboardController@index')->name('dashboard.index')->middleware('auth');

Auth::routes();

