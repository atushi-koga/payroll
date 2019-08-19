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
