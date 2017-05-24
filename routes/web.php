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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/enrollment_wizard', function (){
        return view('wizard');
    });
    Route::get('/enrollments', function (){
        return view('vendor.enrollments.index');
    });
//    Route::get('user', 'UserController@fetchUsers');
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
});

Route::get('/users/pdf', 'PDFController@users');
Route::get('/users/pdf/{id}', 'PDFController@user');
Route::get('/users/pdf/view', 'PDFController@users_view');
