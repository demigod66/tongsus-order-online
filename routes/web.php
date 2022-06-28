<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', 'FrontEndController@index');
// Route::get('/halaman', 'FrontEndController@halaman');
// Route::get('/halaman/home', 'FrontEndController@home');
// Route::get('/halaman/produk', 'FrontEndController@produk');
// Route::get('/halaman/about/', 'FrontEndController@about');
Route::get('/halaman/list-produk','FrontEndController@list_produk');




Route::group(['middleware' => 'auth'], function () {
    Route::get('/halaman/produk/detail/{id}', 'FrontEndController@detail_produk');
    Route::post('/tambah-keranjang', 'KeranjangController@tambahKeranjang');
    Route::get('/lihat-keranjang', 'KeranjangController@lihatKeranjang');
    Route::post('/remove-keranjang', 'KeranjangController@removekeranjang');
    Route::post('/update-keranjang', 'KeranjangController@updatekeranjang');
    Route::post('/finish', 'KeranjangController@finish');

    Route::get('akun', 'AkunController@index');
    Route::get('akun/pesanan', 'AkunController@pesanan');
    Route::get('akun/pesanan/{no_trans}', 'AkunController@detail');
});

Route::group(['middleware' => ['role:super-admin']], function () {

    Route::get('/admin/dashboard', function () {
        return view('backend.index');
    });
    Route::get('/home', 'HomeController@index')->name('home');
    // kategori
    Route::resource('/admin/kategori', 'CategoryController');
    Route::post('admin/kategori/update/{id}', 'CategoryController@update');
    // produk
    Route::get('/admin/produk', 'ProdukController@index');
    Route::post('/admin/produk/store', 'ProdukController@store');
    Route::get('/admin/produk/edit/{id}', 'ProdukController@edit');
    Route::post('/admin/produk/update/{id}', 'ProdukController@update');
    Route::get('/admin/produk/destroy/{id}', 'ProdukController@destroy');

    // about

    Route::get('/admin/about', 'AboutController@index');
    Route::post('/admin/about/store', 'AboutController@store');
    Route::get('admin/about/edit/{id}', 'AboutController@edit');
    Route::post('/admin/about/update/{id}', 'Aboutcontroller@update');
    Route::get('/admin/about/destroy/{id}', 'AboutController@destroy');

    Route::get('/admin/slider', 'SliderController@index');
    Route::post('/admin/slider/store', 'SliderController@store');
    Route::get('/admin/slider/edit/{id}', 'SliderController@edit');
    Route::post('/admin/slider/update/{id}', 'SliderController@update');
    Route::get('/admin/slider/destroy/{id}', 'SliderController@destroy');


    Route::get('/admin/detail-transaksi','TransaksiAdminController@index');
});



Auth::routes();
