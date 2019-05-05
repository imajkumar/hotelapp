<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/getSampleList/{userid}','SampleController@getSampleList')->name('getSampleList');
Route::post('/getSamplesList','SampleController@getSamplesList')->name('getSamplesList');
Route::post('/getClientList/{userid}','SampleController@getClientList')->name('getClientList');
Route::post('/getClientsList','SampleController@getClientsList')->name('getClientsList');
Route::post('/getROWClientsList','SampleController@getROWClientsList')->name('getROWClientsList');

Route::get('/getCity','UserController@getCity')->name('getCity'); //v2
Route::get('/getCountry/{id}','UserController@getCountry')->name('getCountry'); //v2



Route::get('/getClientAddress','SampleController@getClientAddress')->name('getClientAddress');
Route::post('/getSampleDetails','SampleController@getSampleDetails')->name('getSampleDetails');
Route::post('/saveSampleCourier','SampleController@saveSampleCourier')->name('saveSampleCourier');
//Route::get('/delete_sample/{userid}','SampleController@delete_sample')->name('delete_sample');
Route::post('/getClientDetails','SampleController@getClientDetails')->name('getClientDetails');
Route::post('/getClientsListforDelete','SampleController@getClientsListforDelete')->name('getClientsListforDelete');
Route::get('/getPrintSampleList','SampleController@getPrintSampleList')->name('getPrintSampleList');
Route::get('/getPrintSampleList/{userid}','SampleController@getPrintSampleListOwn')->name('getPrintSampleListOwn');
Route::post('/getRawClientData','RawClientDataController@getRawClientData')->name('getRawClientData');
