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
Route::get('/', function () {
    return view('layout');
});
Route::get('/import_excel', 'ImportExcelController@index');
Route::post('/import_excel/import', 'ImportExcelController@import');


Route::get('/attendance', 'AttendanceController@home');
Route::get('/attendance/reports', 'AttendanceController@reports');
Route::get('/attendance/reports/{id}','AttendanceController@dateReport');


Route::post('/attendance/post', 'AttendanceController@postRegister');
