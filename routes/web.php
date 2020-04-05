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

// Route::get('/report', function () {
//     return view('report');
// });

// Route::get('/','AdminController@index');

// Route::get('/', [
// 	'uses'		=> 'AdminController@index',
// 	'as'		=> '/'
// ]);


// Route::get('/login', [
// 	'uses'		=> 'UserController@showLoginForm',
// 	'as'		=> 'login'
// ]);
// Route::post('/checklogin', [
// 	'uses'		=> 'UserController@checklogin',
// 	'as'		=> 'checklogin'
// ]);

// Route::get('/logout', [
// 	'uses'		=> 'UserController@logout',
// 	'as'		=> 'logout'
// ]);


// Mater Data Department Category ............. 
Route::group(['middleware' => 'admin'], function () {
//category add edit update delete......
		Route::get('/category/add-category', [
			'uses'		=> 'MasterController@add_category',
			'as'		=> 'add-category'
		]);
		Route::post('/category/save-category', [
			'uses'		=> 'MasterController@save_category',
			'as'		=> 'save-category'
		]);
		Route::get('/category/all-category', [
			'uses'		=> 'MasterController@all_category',
			'as'		=> 'all-category'
		]);
		Route::get('/category/edit-category/{id}', [
			'uses'		=> 'MasterController@edit_category',
			'as'		=> 'edit-category'
		]);
		Route::post('/category/update-category/{id}', [
			'uses'		=> 'MasterController@update_category',
			'as'		=> 'update-category'
		]);
		Route::get('/category/delete-category/{id}', [
			'uses'		=> 'MasterController@delete_category',
			'as'		=> 'delete-category'
		]);

		//level add edit update delete......level
		Route::get('/level/add-level', [
			'uses'		=> 'MasterController@add_level',
			'as'		=> 'add-level'
		]);
		Route::post('/level/save-level', [
			'uses'		=> 'MasterController@save_level',
			'as'		=> 'save-level'
		]);
		Route::get('/level/all-level', [
			'uses'		=> 'MasterController@all_level',
			'as'		=> 'all-level'
		]);
		Route::get('/level/edit-level/{id}', [
			'uses'		=> 'MasterController@edit_level',
			'as'		=> 'edit-level'
		]);
		Route::post('/level/update-level/{id}', [
			'uses'		=> 'MasterController@update_level',
			'as'		=> 'update-level'
		]);
		Route::get('/level/delete-level/{id}', [
			'uses'		=> 'MasterController@delete_level',
			'as'		=> 'delete-level'
		]);

		//sub location add edit update delete......
		Route::get('/sub-location/add-sub-location', [
			'uses'		=> 'MasterController@add_sub_location',
			'as'		=> 'add-sub-location'
		]);
		Route::post('/sub-location/save-sub-location', [
			'uses'		=> 'MasterController@save_sub_location',
			'as'		=> 'save-sub-location'
		]);
		Route::get('/sub-location/all-sub-location', [
			'uses'		=> 'MasterController@all_sub_location',
			'as'		=> 'all-sub-location'
		]);
		Route::get('/sub-location/edit-sub-location/{id}', [
			'uses'		=> 'MasterController@edit_sub_location',
			'as'		=> 'edit-sub-location'
		]);
		Route::post('/sub-location/update-sub-location/{id}', [
			'uses'		=> 'MasterController@update_sub_location',
			'as'		=> 'update-sub-location'
		]);
		Route::get('/sub-location/delete-sub-location/{id}', [
			'uses'		=> 'MasterController@delete_sub_location',
			'as'		=> 'delete-sub-location'
		]);

		//Work Place add edit update delete......
		Route::get('/work-place/add-work-place', [
			'uses'		=> 'MasterController@add_work_place',
			'as'		=> 'add-work-place'
		]);
		Route::post('/work-place/save-work-place', [
			'uses'		=> 'MasterController@save_work_place',
			'as'		=> 'save-work-place'
		]);
		Route::get('/work-place/all-work-place', [
			'uses'		=> 'MasterController@all_work_place',
			'as'		=> 'all-work-place'
		]);
		Route::get('/work-place/edit-work-place/{id}', [
			'uses'		=> 'MasterController@edit_work_place',
			'as'		=> 'edit-work-place'
		]);
		Route::post('/work-place/update-work-place/{id}', [
			'uses'		=> 'MasterController@update_work_place',
			'as'		=> 'update-work-place'
		]);
		Route::get('/work-place/delete-work-place/{id}', [
			'uses'		=> 'MasterController@delete_work_place',
			'as'		=> 'delete-work-place'
		]);

		// Department add edit delete update 
		Route::get('/add-department', [
			'uses'		=> 'MasterController@add_department',
			'as'		=> 'add-department'
		]);

		Route::get('/all-department', [
			'uses'		=> 'MasterController@all_department',
			'as'		=> 'all-department'
		]);
		Route::post('/save-department', [
			'uses'		=> 'MasterController@save_department',
			'as'		=> 'save-department'
		]);

		Route::get('/edit-department/{id}', [
			'uses'		=> 'MasterController@edit_department',
			'as'		=> 'edit-department'
		]);

		Route::post('/update-department/{id}', [
			'uses'		=> 'MasterController@update_department',
			'as'		=> 'update-department'
		]);

		Route::get('/delete-department/{id}', [
			'uses'		=> 'MasterController@delete_department',
			'as'		=> 'delete-department'
		]);

		//master data alert add edit update delete......
		Route::get('/add-office', [
			'uses'		=> 'MasterController@add_office',
			'as'		=> 'add-office'
		]);
		Route::post('/save-office', [
			'uses'		=> 'MasterController@save_office',
			'as'		=> 'save-office'
		]);
		Route::get('/all-office', [
			'uses'		=> 'MasterController@all_office',
			'as'		=> 'all-office'
		]);
		Route::get('/edit-office/{id}', [
			'uses'		=> 'MasterController@edit_office',
			'as'		=> 'edit-office'
		]);
		Route::post('/update-office/{id}', [
			'uses'		=> 'MasterController@update_office',
			'as'		=> 'update-office'
		]);
		Route::get('/delete-office/{id}', [
			'uses'		=> 'MasterController@delete_office',
			'as'		=> 'delete-office'
		]);

		// Department add edit delete update 

		Route::get('/add-department', [
			'uses'		=> 'MasterController@add_department',
			'as'		=> 'add-department'
		]);

		Route::get('/all-department', [
			'uses'		=> 'MasterController@all_department',
			'as'		=> 'all-department'
		]);
		Route::post('/save-department', [
			'uses'		=> 'MasterController@save_department',
			'as'		=> 'save-department'
		]);

		Route::get('/edit-department/{id}', [
			'uses'		=> 'MasterController@edit_department',
			'as'		=> 'edit-department'
		]);

		Route::post('/update-department/{id}', [
			'uses'		=> 'MasterController@update_department',
			'as'		=> 'update-department'
		]);

		Route::get('/delete-department/{id}', [
			'uses'		=> 'MasterController@delete_department',
			'as'		=> 'delete-department'
		]);

		//position add edit update delete......
		Route::get('/position/add-position', [
			'uses'		=> 'MasterController@add_position',
			'as'		=> 'add-position'
		]);
		Route::post('/position/save-position', [
			'uses'		=> 'MasterController@save_position',
			'as'		=> 'save-position'
		]);
		Route::get('/position/all-position', [
			'uses'		=> 'MasterController@all_position',
			'as'		=> 'all-position'
		]);
		Route::get('/position/edit-position/{id}', [
			'uses'		=> 'MasterController@edit_position',
			'as'		=> 'edit-position'
		]);
		Route::post('/position/update-position/{id}', [
			'uses'		=> 'MasterController@update_position',
			'as'		=> 'update-position'
		]);
		Route::get('/position/delete-position/{id}', [
			'uses'		=> 'MasterController@delete_position',
			'as'		=> 'delete-position'
		]);


		//base add edit update delete......
		Route::get('/base/add-base', [
			'uses'		=> 'MasterController@add_base',
			'as'		=> 'add-base'
		]);
		Route::post('/base/save-base', [
			'uses'		=> 'MasterController@save_base',
			'as'		=> 'save-base'
		]);
		Route::get('/base/all-base', [
			'uses'		=> 'MasterController@all_base',
			'as'		=> 'all-base'
		]);
		Route::get('/base/edit-base/{id}', [
			'uses'		=> 'MasterController@edit_base',
			'as'		=> 'edit-base'
		]);
		Route::post('/base/update-base/{id}', [
			'uses'		=> 'MasterController@update_base',
			'as'		=> 'update-base'
		]);
		Route::get('/base/delete-base/{id}', [
			'uses'		=> 'MasterController@delete_base',
			'as'		=> 'delete-base'
		]);

		//master data duration add edit update delete......
		Route::get('/add-duration', [
			'uses'		=> 'MasterController@add_duration',
			'as'		=> 'add-duration'
		]);
		Route::post('/save-duration', [
			'uses'		=> 'MasterController@save_duration',
			'as'		=> 'save-duration'
		]);
		Route::get('/all-duration', [
			'uses'		=> 'MasterController@all_duration',
			'as'		=> 'all-duration'
		]);
		Route::get('/edit-duration/{id}', [
			'uses'		=> 'MasterController@edit_duration',
			'as'		=> 'edit-duration'
		]);
		Route::post('/update-duration/{id}', [
			'uses'		=> 'MasterController@update_duration',
			'as'		=> 'update-duration'
		]);
		Route::get('/delete-duration/{id}', [
			'uses'		=> 'MasterController@delete_duration',
			'as'		=> 'delete-duration'
		]);

		//master user role add edit update delete......
		Route::get('/add-user-role', [
			'uses'		=> 'MasterController@add_user_role',
			'as'		=> 'add-user-role'
		]);
		Route::post('/save-user-role', [
			'uses'		=> 'MasterController@save_user_role',
			'as'		=> 'save-user-role'
		]);
		Route::get('/all-user-role', [
			'uses'		=> 'MasterController@all_user_role',
			'as'		=> 'all-user-role'
		]);
		Route::get('/edit-user-role/{id}', [
			'uses'		=> 'MasterController@edit_user_role',
			'as'		=> 'edit-user-role'
		]);
		Route::post('/update-user-role/{id}', [
			'uses'		=> 'MasterController@update_user_role',
			'as'		=> 'update-user-role'
		]);
		Route::get('/delete-user-role/{id}', [
			'uses'		=> 'MasterController@delete_user_role',
			'as'		=> 'delete-user-role'
		]);


		//master data alert add edit update delete......
		Route::get('/add-alert', [
			'uses'		=> 'MasterController@add_alert',
			'as'		=> 'add-alert'
		]);
		Route::post('/save-alert', [
			'uses'		=> 'MasterController@save_alert',
			'as'		=> 'save-alert'
		]);
		Route::get('/all-alert', [
			'uses'		=> 'MasterController@all_alert',
			'as'		=> 'all-alert'
		]);
		Route::get('/edit-alert/{id}', [
			'uses'		=> 'MasterController@edit_alert',
			'as'		=> 'edit-alert'
		]);
		Route::post('/update-alert/{id}', [
			'uses'		=> 'MasterController@update_alert',
			'as'		=> 'update-alert'
		]);
		Route::get('/delete-alert/{id}', [
			'uses'		=> 'MasterController@delete_alert',
			'as'		=> 'delete-alert'
		]);

		//master data pf_calculation add edit update delete......
		Route::get('/add-pf-calculation', [
			'uses'		=> 'MasterController@add_pf_calculation',
			'as'		=> 'add-pf-calculation'
		]);
		Route::post('/save-pf-calculation', [
			'uses'		=> 'MasterController@save_pf_calculation',
			'as'		=> 'save-pf-calculation'
		]);
		Route::get('/all-pf-calculation', [
			'uses'		=> 'MasterController@all_pf_calculation',
			'as'		=> 'all-pf-calculation'
		]);
		Route::get('/edit-pf-calculation/{id}', [
			'uses'		=> 'MasterController@edit_pf_calculation',
			'as'		=> 'edit-pf-calculation'
		]);
		Route::post('/update-pf-calculation/{id}', [
			'uses'		=> 'MasterController@update_pf_calculation',
			'as'		=> 'update-pf-calculation'
		]);
		Route::get('/delete-pf-calculation/{id}', [
			'uses'		=> 'MasterController@delete_pf_calculation',
			'as'		=> 'delete-pf-calculation'
		]);

		//time schedule add edit update delete......
		Route::get('/time-schedule/add-time-schedule', [
			'uses'		=> 'MasterController@add_time_schedule',
			'as'		=> 'add-time-schedule'
		]);
		Route::post('/time-schedule/save-time-schedule', [
			'uses'		=> 'MasterController@save_time_schedule',
			'as'		=> 'save-time-schedule'
		]);
		Route::get('/time-schedule/all-time-schedule', [
			'uses'		=> 'MasterController@all_time_schedule',
			'as'		=> 'all-time-schedule'
		]);
		Route::get('/time-schedule/edit-time-schedule/{id}', [
			'uses'		=> 'MasterController@edit_time_schedule',
			'as'		=> 'edit-time-schedule'
		]);
		Route::post('/time-schedule/update-time-schedule/{id}', [
			'uses'		=> 'MasterController@update_time_schedule',
			'as'		=> 'update-time-schedule'
		]);
		Route::get('/time-schedule/delete-time-schedule/{id}', [
			'uses'		=> 'MasterController@delete_time_schedule',
			'as'		=> 'delete-time-schedule'
		]);

		// Employee status insert update edit delete and excel upload
		Route::get('/add-employee-status', [
			'uses'		=> 'MasterController@add_employee_status',
			'as'		=> 'add-employee-status'
		]);

		Route::get('/all-employee-status', [
			'uses'		=> 'MasterController@all_employee_status',
			'as'		=> 'all-employee-status'
		]);

		Route::post('/save-employee-status', [
			'uses'		=> 'MasterController@save_employee_status',
			'as'		=> 'save-employee-status'
		]);
		Route::get('/edit-employee-status/{id}', [
			'uses'		=> 'MasterController@edit_employee_status',
			'as'		=> 'edit-employee-status'
		]);
		Route::post('/update-employee-status/{id}', [
			'uses'		=> 'MasterController@update_employee_status',
			'as'		=> 'update-employee-status'
		]);

		Route::get('/delete-employee-status/{id}', [
			'uses'		=> 'MasterController@delete_employee_status',
			'as'		=> 'delete-employee-status'
		]);

		// Interest source insert update edit delete and excel upload
		Route::get('/add-interest-source', [
			'uses'		=> 'MasterController@add_interest_source',
			'as'		=> 'add-interest-source'
		]);

		Route::get('/all-interest-source', [
			'uses'		=> 'MasterController@all_interest_source',
			'as'		=> 'all-interest-source'
		]);

		Route::post('/save-interest-source', [
			'uses'		=> 'MasterController@save_interest_source',
			'as'		=> 'save-interest-source'
		]);
		Route::get('/edit-interest-source/{id}', [
			'uses'		=> 'MasterController@edit_interest_source',
			'as'		=> 'edit-interest-source'
		]);
		Route::post('/update-interest-source/{id}', [
			'uses'		=> 'MasterController@update_interest_source',
			'as'		=> 'update-interest-source'
		]);

		Route::get('/delete-interest-source/{id}', [
			'uses'		=> 'MasterController@delete_interest_source',
			'as'		=> 'delete-interest-source'
		]);

		// user add delete edit update
		Route::get('/add-user', [
			'uses'		=> 'UserController@show_add_user',
			'as'		=> 'add-user'
		]);
		Route::get('/show-batch-upload', [
			'uses'		=> 'UserController@show_batch_upload',
			'as'		=> 'show-batch-upload'
		]);

		Route::post('/save-user-batch-upload', [
			'uses'		=> 'UserController@save_user_batch_upload',
			'as'		=> 'save-user-batch-upload'
		]);
		Route::post('/save-user', [
			'uses'		=> 'UserController@store_add_user',
			'as'		=> 'save-user'
		]);
		Route::get('/all-user', [
			'uses'		=> 'UserController@all_user',
			'as'		=> 'all-user'
		]);
		Route::get('/edit-user/{id}', [
			'uses'		=> 'UserController@edit_user',
			'as'		=> 'edit-user'
		]);
		Route::post('/update-user/{id}', [
			'uses'		=> 'UserController@update_user',
			'as'		=> 'update-user'
		]);
		Route::get('/delete-userr/{id}', [
			'uses'		=> 'UserController@delete_user',
			'as'		=> 'delete-user'
		]);

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

		Route::post('/custom-search-employee', [
			'uses'		=> 'EmployeeController@customSearchEmployee',
			'as'		=> 'custom-search-employee'
		]);



		//PF Deposit insert update edit and  excel upload
		Route::get('/add-provident-fund', [
			'uses'		=> 'ProvidentFundController@add_provident_fund',
			'as'		=> 'add-provident-fund'
		]);
		Route::post('/save-provident-fund', [
			'uses'		=> 'ProvidentFundController@save_provident_fund',
			'as'		=> 'save-provident-fund'
		]);
		// Route::get('/show-provident-fund-batch-upload', [
		// 	'uses'		=> 'ProvidentFundController@show_provident_fund_batch_upload',
		// 	'as'		=> 'show-provident-fund-batch-upload'
		// ]);
		Route::post('/save-pf-deposit-batch', [
			'uses'		=> 'ProvidentFundController@save_pf_deposit_batch',
			'as'		=> 'save-pf-deposit-batch'
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

		//provident fund  withdraw insert update edit and  excel upload
		Route::get('/add-pf-withdraw', [
			'uses'		=> 'PFWithdrawController@add_pf_withdraw',
			'as'		=> 'add-pf-withdraw'
		]);
		Route::post('/save-pf-withdraw', [
			'uses'		=> 'PFWithdrawController@save_pf_withdraw',
			'as'		=> 'save-pf-withdraw'
		]);
		Route::post('/save-pf-withdraw-batch-upload', [
			'uses'		=> 'PFWithdrawController@save_pf_withdraw_batch_upload',
			'as'		=> 'save-pf-withdraw-batch-upload'
		]);
		Route::get('/edit-pf-withdraw/{id}', [
			'uses'		=> 'PFWithdrawController@edit_pf_withdraw',
			'as'		=> 'edit-pf-withdraw'
		]);
		Route::post('/update-pf-withdraw/{id}', [
			'uses'		=> 'PFWithdrawController@update_pf_withdraw',
			'as'		=> 'update-pf-withdraw'
		]);
		Route::get('/all-pf-withdraw', [
			'uses'		=> 'PFWithdrawController@all_pf_withdraw',
			'as'		=> 'all-pf-withdraw'
		]);
		Route::get('/delete-pf-withdraw/{id}', [
			'uses'		=> 'PFWithdrawController@delete_pf_withdraw',
			'as'		=> 'delete-pf-withdraw'
		]);


		//provident fund  interest insert update edit and  excel upload
		Route::get('/add-pf-interest', [
			'uses'		=> 'PFInterestController@add_pf_interest',
			'as'		=> 'add-pf-interest'
		]);
		Route::post('/save-pf-interest', [
			'uses'		=> 'PFInterestController@save_pf_interest',
			'as'		=> 'save-pf-interest'
		]);
		Route::get('/all-pf-interest', [
			'uses'		=> 'PFInterestController@all_pf_interest',
			'as'		=> 'all-pf-interest'
		]);
		Route::post('/save-pf-interest-batch-upload', [
			'uses'		=> 'PFInterestController@save_pf_interest_batch_upload',
			'as'		=> 'save-pf-interest-batch-upload'
		]);
		Route::get('/edit-pf-interest/{id}', [
			'uses'		=> 'PFInterestController@edit_pf_interest',
			'as'		=> 'edit-pf-interest'
		]);
		Route::post('/update-pf-interest/{id}', [
			'uses'		=> 'PFInterestController@update_pf_interest',
			'as'		=> 'update-pf-interest'
		]);

		Route::get('/delete-pf-interest/{id}', [
			'uses'		=> 'PFInterestController@delete_pf_interest',
			'as'		=> 'delete-pf-interest'
		]);


		/*
		|--------------------------------------------------------------------------
		| Charts Of Accounts all Routes
		|--------------------------------------------------------------------------
		*/

		Route::get('/account/add-account-head', [
			'uses'		=> 'AccountHeadController@add_account_head',
			'as'		=> 'add-account-head'
		]);
		Route::post('/account/add-account-head', [
			'uses'		=> 'AccountHeadController@save_account_head',
			'as'		=> 'save-account-head'
		]);
		Route::get('/account/all-account-head', [
			'uses'		=> 'AccountHeadController@all_account_head',
			'as'		=> 'all-account-head'
		]);

		Route::get('/account/edit-account-head/{id}', [
			'uses'		=> 'AccountHeadController@edit_account_head',
			'as'		=> 'edit-account-head'
		]);
		Route::post('/account/update-account-head/{id}', [
			'uses'		=> 'AccountHeadController@update_account_head',
			'as'		=> 'update-account-head'
		]);

		Route::get('/account/delete-account-head/{id}', [
			'uses'		=> 'AccountHeadController@delete_account_head',
			'as'		=> 'delete-account-head'
		]);

		//-------------------RECONCILIATION ROUTES-------------------//
		Route::get('/reconciliation', 'BankController@view_transaction');
		Route::get('/monthy-bank-book', 'BankController@get_monthly_bank_book');
		Route::get('/save-monthly-bank-book', 'BankController@save_monthly_bank_book');
		//-------------------RECONCILIATION ROUTES-------------------//


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

		// report 
		Route::get('provident-fund-report', 'ProvidentFundController@providentFund');
		Route::get('get-fund-data', 'ProvidentFundController@getProvidentFund');

		Route::get('ledger', 'LedgerReportController@view_ledger_report');
		Route::get('ledger-report','LedgerReportController@ledger_report');



        Route::get('/create-loan', [
			'uses'		=> 'LoanController@create_loan',
			'as'		=> 'create-loan'
		]);

        Route::any('/loan-from-data', [
			'uses'		=> 'LoanController@loanFromData',
			'as'		=> 'loan-from-data'
		]);

        Route::any('/save-loan', [
			'uses'		=> 'LoanController@saveLoan',
			'as'		=> 'save-loan'
		]);

		Route::any('/all-loans', [
			'uses'		=> 'LoanController@allLoans',
			'as'		=> 'all-loans'
		]);
});