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
// Route::get('/update',['as'=>'update','middleware'=>'auth','uses'=>'UpdateController@index']);
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

// user add delete edit update
Route::get('/add-user','UserController@show_add_user');
Route::get('/show-batch-upload','UserController@show_batch_upload');
Route::post('/save-user-batch-upload','UserController@save_user_batch_upload');
Route::post('/save-user','UserController@store_add_user');
Route::get('/all-user','UserController@all_user');
Route::get('/edit-user/{id}','UserController@edit_user');
Route::post('/update-user/{id}','UserController@update_user');
Route::get('/delete-user/{id}','UserController@delete_user');

// Employee insert update edit delete and excel upload
Route::get('/add-employee', [
	'uses'		=> 'EmployeeController@add_employee',
	'as'		=> 'add-employee'
]);

Route::get('/all-employee', [
	'uses'		=> 'EmployeeController@all_employee',
	'as'		=> 'all-employee'
]);

Route::get('/employee-batch-upload', [
	'uses'		=> 'EmployeeController@employee_batch_upload',
	'as'		=> 'employee-batch-upload'
]);

Route::post('/save-employee', [
	'uses'		=> 'EmployeeController@save_employee',
	'as'		=> 'save-employee'
]);
Route::get('/edit-employee/{id}', [
	'uses'		=> 'EmployeeController@edit_employee',
	'as'		=> 'edit-employee'
]);
Route::post('/update-employee/{id}', [
	'uses'		=> 'EmployeeController@update_employee',
	'as'		=> 'update-employee'
]);

Route::get('/delete-employee/{id}', [
	'uses'		=> 'EmployeeController@delete_employee',
	'as'		=> 'delete-employee'
]);

//provident fund insert update edit and  excel upload
Route::get('/add-provident-fund', [
	'uses'		=> 'ProvidentFundController@add_provident_fund',
	'as'		=> 'add-provident-fund'
]);
Route::post('/save-provident-fund', [
	'uses'		=> 'ProvidentFundController@save_provident_fund',
	'as'		=> 'save-provident-fund'
]);
Route::get('/show-provident-fund-batch-upload', [
	'uses'		=> 'ProvidentFundController@show_provident_fund_batch_upload',
	'as'		=> 'show-provident-fund-batch-upload'
]);
Route::get('/edit-provident-fund/{id}', [
	'uses'		=> 'ProvidentFundController@edit_provident_fund',
	'as'		=> 'edit-provident-fund'
]);
Route::post('/update-provident-fund/{id}', [
	'uses'		=> 'ProvidentFundController@update_provident_fund',
	'as'		=> 'update-provident-fund'
]);
Route::get('/all-provident-fund', [
	'uses'		=> 'ProvidentFundController@all_provident_fund',
	'as'		=> 'all-provident-fund'
]);

// test excel upload
Route::get('/excel','UserController@index');
Route::post('/import','UserController@import');
