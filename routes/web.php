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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/report', function () {
    return view('report');
});

Route::get('/','AdminController@index');


//login admin and user
Route::get('/login','UserController@showLoginForm');
Route::post('/checklogin','UserController@checklogin');
Route::get('/logout','UserController@logout');

// user add delete edit
Route::get('/add-user','UserController@show_add_user');
Route::get('/show-batch-upload','UserController@show_batch_upload');
Route::post('/save-user-batch-upload','UserController@save_user_batch_upload');
Route::post('/save-user','UserController@store_add_user');
Route::get('/all-user','UserController@all_user');
Route::get('/edit-user/{id}','UserController@edit_user');
Route::post('/update-user/{id}','UserController@update_user');
Route::get('/delete-user/{id}','UserController@delete_user');


Route::get('/excel','UserController@index');
Route::post('/import','UserController@import');
