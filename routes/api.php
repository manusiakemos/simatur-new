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
Route::post('register', 'AuthController@register');
Route::get('konfirmasi/{token}', 'AuthController@konfirmasi')->name('konfirmasi');
Route::post('logout', 'AuthController@logout');

Route::middleware(['auth:sanctum'])->group(function () {
    /*base route*/
    Route::get('profile', 'ProfileController@edit')->name('profile.edit');
    Route::put('profile', 'ProfileController@update')->name('profile.update');
    Route::post('profile/avatar', 'ProfileController@avatar')->name('profile.avatar');
    /* my generated route */
    Route::apiResource('user', 'UserController');
    Route::apiResource('kategori', 'KategoriController');

    Route::apiResource('provider', 'ProviderController');
    Route::apiResource('towerprovider', 'TowerProviderController');
    Route::apiResource('kunjungan', 'KunjunganController');
    Route::apiResource('zona', 'ZonaController');

    Route::get('permohonan/download/{id}', 'PermohonanController@download')->name('permohonan.download');
    Route::apiResource('permohonan', 'PermohonanController');

    Route::apiResource('skpd', 'SkpdController');

    Route::get('backbone', 'BackboneController@index');
    Route::post('backbone', 'BackboneController@update');

});

Route::any('select/{type}', 'SelectController');

Route::apiResource('crudgenerator', 'CrudGeneratorController');

Route::any('chart/{case}', 'ChartController');

Route::post('map', 'MapController@towerProvider');

Route::any('mobile/{case}', 'MobileController');

//controller middleware
Route::apiResource('tower', 'TowerController');


Route::get('arsip/download/{slug}', 'ArsipController@download')->name('file.download');
Route::resource('arsip', 'ArsipController');

if(config('app.debug')){
    Route::get('/artisan/migrate', function(){
        \Illuminate\Support\Facades\Artisan::call('migrate');
    });
}


