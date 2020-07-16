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
    Route::any('select/{type}', 'SelectController');
    /* my generated route */
    Route::apiResource('user', 'UserController');
    Route::apiResource('kategori', 'KategoriController');
});

Route::apiResource('crudgenerator', 'CrudGeneratorController');

 Route::apiResource('tower', 'TowerController');
 Route::apiResource('provider', 'ProviderController');
 Route::apiResource('towerprovider', 'TowerProviderController');
 Route::apiResource('kunjungan', 'KunjunganController');