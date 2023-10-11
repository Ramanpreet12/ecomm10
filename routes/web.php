<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->namespace('App\Http\Controllers\Admin')->group(function(){
    Route::match(['get' , 'post'] ,'login' ,  'AdminController@login')->name('login');
    Route::middleware(['admin'])->group(function () {
        Route::get('dashboard' , 'AdminController@dashboard')->name('dashboard');
        Route::get('logout' , 'AdminController@logout')->name('logout');
        Route::match(['get' , 'post'] , 'password' , 'AdminController@AdminPassword')->name('password');
        Route::match(['get' , 'post'] , 'admin-details' , 'AdminController@adminDetails')->name('admin-details');
        Route::post('check-current-password' , 'AdminController@checkCurrentPassword')->name('check-current-password');
    });



});
