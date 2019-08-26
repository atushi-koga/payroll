<?php

Route::get('/', function () {
    return view('index');
});

/**
 * 従業員の登録
 */
Route::group(['prefix' => 'employees/register'], function () {
    Route::get('form', 'Employee\\EmployeeRegisterController@showForm')
        ->name('employees-register#showForm');
    Route::post('confirm', 'Employee\\EmployeeRegisterController@confirm')
        ->name('employees-register#confirm');
    Route::post('/', 'Employee\\EmployeeRegisterController@registerThenRedirect')
        ->name('employees-register#registerThenRedirect');
    Route::get('complete', 'Employee\\EmployeeRegisterController@showComplete')
        ->name('employees-register#showComplete');
});

/**
 * 従業員の一覧
 */
Route::get('employees', 'Employee\\EmployeeListController@list')
    ->name('employees#list');

/**
 * 従業員情報の詳細
 */
Route::get('employees/{employeeNumber}', 'Employee\\EmployeeDetailController@detail')
    ->name('employees#detail');

/**
 * 時給の履歴
 */
Route::get('wages/{employeeNumber}', 'Wage\\WageHistoryController@history')
    ->name('wages#history');

/**
 * 時給の登録
 */
Route::group(['prefix' => 'wages/{employeeNumber}/register'], function () {
    Route::get('form', 'Wage\\WageRegisterController@showForm')
        ->name('wages-register#showForm');
    Route::post('confirm', 'Wage\\WageRegisterController@confirm')
        ->name('wages-register#confirm');
    Route::post('/', 'Wage\\WageRegisterController@registerThenRedirect')
        ->name('wages-register#registerThenRedirect');
    Route::get('complete', 'Wage\\WageRegisterController@showComplete')
        ->name('wages-register#showComplete');
});

/**
 * 勤務時間の登録
 */
Route::group(['prefix' => 'time-record'], function () {
    Route::get('register', 'TimeRecord\\TimeRecordRegisterController@showForm')
        ->name('time-record-register#showForm');
    Route::post('register', 'TimeRecord\\TimeRecordRegisterController@registerThenRedirect')
        ->name('time-record-register#registerThenRedirect');
});
