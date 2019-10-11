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


Route::get('/', 'HomeController@index')->name('home'); 

// for uploading the file
Route::get('/uploadpage', 'PagesController@index')->name('uploadpage'); 
Route::post('/uploadFile', 'PagesController@uploadFile');

// member
Route::get('/member', 'MemberController@index')->name('member');
Route::post('/member', 'MemberController@store');




