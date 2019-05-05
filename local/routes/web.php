<?php
Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/mypdf', 'HomeController@mypdf')->name('mypdf');


Route::resource('users', 'UserController');
Route::resource('roles', 'RoleController');
Route::resource('permissions', 'PermissionController');
Route::resource('posts', 'PostController');
Route::resource('hotel', 'HotelController');
Route::resource('client', 'ClientController');
Route::resource('offers', 'OfferController');


Route::resource('room', 'RoomController');
Route::post('/getRoomsList','RoomController@getRoomsList')->name('getRoomsList'); //v2
Route::post('/deleteRoom','RoomController@deleteRoom')->name('deleteRoom'); //v2



//v2
Route::resource('client55', 'ClientController');
Route::resource('orders', 'OrderController');
Route::post('/getClientsList','HotelController@getClientsList')->name('getClientsList'); //v2
Route::post('/getClientData','ClientController@getClientData')->name('getClientData'); //v2
Route::post('/getClientsNotesList','ClientController@getClientsNotesList')->name('getClientsNotesList'); //v2
Route::post('/getSamplesList','SampleController@getSamplesList')->name('getSamplesList'); //v2
Route::post('/getSampleDetails','SampleController@getSampleDetails')->name('getSampleDetails'); //v2
Route::post('/getOffersList','OfferController@getOffersList')->name('getOffersList'); //v2




Route::post('/softdeleteClient','HotelController@softdeleteClient')->name('softdeleteClient');
Route::post('/getClientDetails','ClientController@getClientDetails')->name('getClientDetails');
Route::post('/edit/client','ClientController@edit_client')->name('edit_client');
Route::resource('sample', 'SampleController'); //v2
Route::resource('rawclientdata', 'RawClientDataController'); //v2

Route::post('import', 'RawClientDataController@import')->name('import'); //v2
Route::get('export', 'RawClientDataController@export')->name('export'); //v2
Route::get('export_sample', 'RawClientDataController@export_sample')->name('export_sample');//v2
Route::get('sample/print/{id}', 'SampleController@print')->name('print_sample');//v2
Route::get('sample.print.all', 'SampleController@print_all')->name('sample.print.all');//v2
Route::get('client.notes', 'ClientController@getClient_notes_view')->name('client.notes');//v2

Route::post('add.notes', 'ClientController@add_Note')->name('add.notes'); //v2
Route::post('delete.client', 'ClientController@deleteClientUser')->name('deleteClientUser'); //v2
Route::post('upload.dropzone', 'HomeController@UploadDropzone')->name('upload.dropzone'); //v2
Route::get('user.profile', 'UserController@userProfile')->name('user.profile'); //v2
Route::post('getOrdersList', 'OrderController@getOrdersList')->name('getOrdersList'); //v2
Route::post('getOrderData', 'OrderController@getOrderData')->name('getOrderData'); //v2
Route::post('getOrderMainList', 'OrderController@getOrderMainList')->name('getOrderMainList'); //v2
Route::post('getRawClientData', 'RawClientDataController@getRawClientData')->name('getRawClientData'); //v2








//v2
// Route::resource('client', 'ClientController');
// Route::resource('sample', 'SampleController');
// Route::get('/edit/sample/{userid}/{sampleid}','SampleController@edit_sample')->name('edit_sample');
// Route::get('/edit/samples/{sampleid}','SampleController@edit_samples')->name('edit_samples');
// Route::get('/delete/sample/{sampleid}','SampleController@delete_sample')->name('delete_sample');
// Route::get('/clientsd','UserController@clinetList')->name('users.clinetList');
// //usr row client list
//
//
// Route::get('/row/client','UserController@rowClientList')->name('users.rowclinetList');
//
// Route::get('/delete/clients/list','UserController@clinetListforDelete')->name('users.clinetListforDelete');
//
// Route::get('/samples','UserController@sampleList')->name('users.sampleList');
//
// Route::post('/samples/update','SampleController@samples_update')->name('samples_update');
// Route::post('/userLogin','UserController@userLogin')->name('users.userLogin');
// Route::post('/add/clients','UserController@add_ajax_clients')->name('clients.addnew');
// Route::post('/samples/edits/data','SampleController@samples_edit')->name('samples_edit');
// Route::post('/samples/edits/datainfo','SampleController@samples_edit_info')->name('samples_edit_info'); //edit by admin
//
 Route::post('/deleteSample','SampleController@deleteSample')->name('deleteSample'); //v2
// Route::post('/clients/edits/data','SampleController@clients_edit')->name('clients_edit');
//
// Route::post('/deleteClient','SampleController@deleteClient')->name('deleteClient');
// Route::post('/softdeleteClient','SampleController@softdeleteClient')->name('softdeleteClient');
// Route::post('/save/rowclient','UserController@saveRowClient')->name('saveRowClient');
// Route::post('/setContactClient','UserController@setContactClient')->name('setContactClient');
