<?php

Route::get('/', function () {
    return view('welcome');
});

/*
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
/*
 * 従業員情報の詳細
 */
Route::get('employees/{employeeNumber}', 'Employee\\EmployeeDetailController@detail')
    ->name('employees#detail');


/*
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
