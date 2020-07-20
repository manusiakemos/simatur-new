<?php
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
|route for api single page apps admin
|
*/

use Illuminate\Support\Facades\Route;

Route::post('login', 'AuthController@login');
Route::post('logout', 'AuthController@logout');

Route::middleware(['auth:airlock'])->group(function(){
    /*base route*/
    Route::get('profile', 'ProfileController@edit')->name('profile.edit');
    Route::put('profile', 'ProfileController@update')->name('profile.update');
    Route::post('profile/avatar', 'ProfileController@avatar')->name('profile.avatar');
    /* my generated route */
    Route::apiResource('user', 'UserController');
    Route::apiResource('kategori', 'KategoriController');

    Route::apiResource('tower', 'TowerController');
    Route::apiResource('provider', 'ProviderController');
    Route::apiResource('towerprovider', 'TowerProviderController');
    Route::apiResource('kunjungan', 'KunjunganController');
});

Route::any('select/{type}', 'SelectController');

Route::apiResource('crudgenerator', 'CrudGeneratorController');


Route::any('chart/counterup', 'ChartController@counterup');
Route::any('chart/provider', 'ChartController@provider');
Route::any('chart/towerpertahun', 'ChartController@towerPertahun');
Route::any('chart/kecamatan', 'ChartController@kecamatan');
Route::any('chart/kelurahan', 'ChartController@kelurahan');
Route::any('chart/tipe_koneksi', 'ChartController@tipeKoneksi');

Route::any('map/towerprovider', 'MapController@towerProvider');

Route::any('mobile', 'MobileController');

 Route::apiResource('zona', 'ZonaController');