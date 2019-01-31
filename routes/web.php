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
    return view('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/charts', 'HomeController@charts')->name('charts');

   Route::get('/tables', 'HomeController@tables')->name('tables'); 
Route::get('/users/logout','Auth\LoginController@userLogout')->name('user.logout');


Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');    
    Route::get('/logout','Auth\AdminLoginController@logout')->name('admin.logout');    
    Route::post('/password/email','Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');   
    Route::get('/password/reset','Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset','Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}','Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
    
    
    Route::get('/charts', 'AdminController@charts')->name('charts');
   Route::get('/tables', 'AdminController@tables')->name('tables'); 
     Route::resource('admins', 'admin\AdminAdminsController'); 
      Route::resource('users', 'admin\AdminUsersController'); 
       Route::resource('users', 'admin\AdminUsersController'); 
     Route::get('/exportar', 'AdminController@export')->name('exportar'); 
    
});
