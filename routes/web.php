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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', 'UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
    Route::post('/search', 'UserController@search')->name('user.search');
});

Route::group(['prefix' => 'bank', 'middleware' => 'auth'], function () {
    Route::get('/', 'BankController@index')->name('bank.index');
    Route::get('/create', 'BankController@create')->name('bank.create');
    Route::post('/store', 'BankController@store')->name('bank.store');
    Route::get('/edit/{id}', 'BankController@edit')->name('bank.edit');
    Route::put('/update/{id}', 'BankController@update')->name('bank.update');
    Route::get('/show/{id}', 'BankController@show')->name('bank.show');
    Route::get('/destroy/{id}', 'BankController@destroy')->name('bank.destroy');
    Route::post('/search', 'BankController@search')->name('bank.search');
});

Route::group(['prefix' => 'transacao', 'middleware' => 'auth'], function () {
    Route::get('/deposito/{saldo}', 'BankController@deposito')->name('transacao.deposito');
    Route::get('/saque/{id}', 'BankController@saque')->name('transacao.saque');
    Route::get('/transferenca/{id}', 'BankController@transferencia')->name('transacao.transferencia');
});