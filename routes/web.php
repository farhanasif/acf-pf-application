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

Route::get('/report', function () {
    return view('report');
});

Route::get('upload', 'TestController@importExport');
Route::post('import', 'TestController@import');

Route::get('provident-fund-report', 'TestController@providentFund');
Route::get('get-fund-data', 'TestController@getProvidentFund');
Route::get('ledger', 'TestController@view_ledger_report');
Route::get('ledger-report','Testcontroller@ledger_report');

Route::get('/blank', 'BankController@view_blank');
Route::get('/reconciliation', 'BankController@view_trancaction');
Route::get('/monthy-bank-book', 'BankController@get_monthly_bank_book');
Route::get('/save-monthly-bank-book', 'BankController@save_monthly_bank_book');


