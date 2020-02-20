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
Route::get('/', ['uses'=>'UserController@showLoginForm']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/report', function () {
    return view('report');
});

// Route::get('/','AdminController@index');

// Route::get('/', [
// 	'uses'		=> 'AdminController@index',
// 	'as'		=> '/'
// ]);


Route::get('/login', [
	'uses'		=> 'UserController@showLoginForm',
	'as'		=> 'login'
]);
Route::post('/checklogin', [
	'uses'		=> 'UserController@checklogin',
	'as'		=> 'checklogin'
]);

Route::get('/logout', [
	'uses'		=> 'UserController@logout',
	'as'		=> 'logout'
]);


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

Route::post('/save-employee-batch-upload', [
	'uses'		=> 'EmployeeController@save_employee_batch_upload',
	'as'		=> 'save-employee-batch-upload'
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
Route::post('/save-provident-fund-batch-upload', [
	'uses'		=> 'ProvidentFundController@save_provident_fund_batch_upload',
	'as'		=> 'save-provident-fund-batch-upload'
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


//report provident fund report and others report

Route::get('/show-provident-fund-report', [
	'uses'		=> 'ReportController@show_provident_fund_report',
	'as'		=> 'show-provident-fund-report'
]);

Route::get('/admin-home',['middleware'=>'admin','uses'=>'AdminController@admin_home']);
Route::get('/user-home',['middleware'=>'user','uses'=>'AdminController@user_home']);

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});


