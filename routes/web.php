<?php


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Auth::routes();

Route::resource('dropbox', 'DropboxController');
Route::get('dropbox/{filetitle}','DropboxController@show');
Route::get('dropbox/{filetitle}/download','DropboxController@download');