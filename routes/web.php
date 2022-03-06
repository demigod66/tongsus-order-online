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

Route::get('/', function () {
    return view('frontend.index');
});


Route::group(['middleware' => ['role:super-admin']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/admin/dashboard', function () {
        return view('backend.index');
    });



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
});



Auth::routes();
