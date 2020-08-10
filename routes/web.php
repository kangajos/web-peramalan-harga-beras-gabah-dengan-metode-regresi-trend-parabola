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

// rout default //
Route::get('/', function () {
    return redirect("auth");
});

Route::get('dashboard', 'RegresiLinierController@index');
Route::get('transaksi', 'RegresiLinierController@transaksi');
Route::get('transaksi/delete_transaksi/{transaksi_id}', 'RegresiLinierController@delete_transaksi');
Route::get('transaksi/edit_transaksi/{transaksi_id}', 'RegresiLinierController@edit_transaksi');
Route::post('transaksi/update_transaksi', 'RegresiLinierController@update_transaksi');
Route::post('add_transaksi', 'RegresiLinierController@add_transaksi');
Route::get('dataset', 'RegresiLinierController@dataset')->name('dataset');
Route::post('add_dataset', 'RegresiLinierController@add_dataset')->name('add_dataset');
Route::get('deleted_dataset/{dataset_id}', 'RegresiLinierController@deleted_dataset')->name('deleted_dataset');
Route::post('regresi_linier', 'RegresiLinierController@regresi_linier')->name('regresi_linier');

// user
Route::get('/user', 'UserController@index');
Route::post('/user/add_user', 'UserController@add_user');
Route::get('/user/edit/{id}', 'UserController@edit')->name("edit_user");
Route::post('/user/update', 'UserController@update')->name("update_user");
Route::get('/user/delete/{id}', 'UserController@delete')->name("delete_user");

// login
Route::get('/auth', 'AuthController@index');
Route::post('/auth/check', 'AuthController@check')->name("auth_check");
Route::get('/auth/out', 'AuthController@out');
