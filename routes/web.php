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


Route::resource('kategori', 'KategoriBarangController');
Route::resource('distributor', 'DistributorController');
Route::resource('umkm', 'UmkmController');

Route::group(['prefix' => 'pengelola', 'middleware' => 'Pengelola'], function (){
    Route::get('/', 'PengelolaController@index');
});

// Route::group(['prefix' => 'umkm', 'middleware' => 'Umkm'], function (){
//     Route::get('/', 'UmkmController@index');
// });

Route::get('/', 'dashboardController@index')->name('dashboard.index')->middleware('auth');

Auth::routes();

