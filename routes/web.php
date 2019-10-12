<?php

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




Route::get('/', 'ImportController@getImport')->name('import');
Route::post('/import_parse', 'ImportController@parseImport')->name('import_parse');
Route::post('/import_process', 'ImportController@processImport')->name('import_process');

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
=======
Route::get('/', 'HomeController@index')->name('home'); 

// for uploading the file
Route::get('/uploadpage', 'PagesController@index')->name('uploadpage'); 
Route::post('/uploadFile', 'PagesController@uploadFile');

// member
Route::get('/member', 'MemberController@index')->name('member');
Route::post('/member', 'MemberController@store');

// transaction
Route::get('/transaction', 'TransactionController@index')->name('transaction');
Route::post('/transaction', 'TransactionController@store');

// enquiry
Route::get('/enquiry', 'EnquiryController@search')->name('enquiry');



>>>>>>> theRealQuestion_slow
