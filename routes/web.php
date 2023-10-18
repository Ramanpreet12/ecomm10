<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CmsPageController;

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
    // Route::middleware(['guest'])->group(function () {
        Route::match(['get' , 'post'] ,'login' ,  'AdminController@login')->name('login')->middleware('guest');

    // });
    Route::middleware(['admin'])->group(function () {
        Route::get('dashboard' , 'AdminController@dashboard')->name('dashboard');
        Route::get('logout' , 'AdminController@logout')->name('logout');
        Route::match(['get' , 'post'] , 'password' , 'AdminController@AdminPassword')->name('password');
        Route::match(['get' , 'post'] , 'admin-details' , 'AdminController@adminDetails')->name('admin-details');
        Route::post('check-current-password' , 'AdminController@checkCurrentPassword')->name('check-current-password');

        Route::resource('cms-page', CmsPageController::class);
        Route::post('update-cms-page-status' , 'CmsPageController@updateCmsPageStatus')->name('update-cms-page-status');
        Route::get('cms-page/delete/{id}' , 'CmsPageController@delete');

        //subadmins
        Route::resource('subadmins', AdminController::class);
        Route::post('update-subadmin-status' , 'AdminController@updateSubadminStatus')->name('update-subadmin-status');
        Route::get('subadmin/delete/{id}' , 'AdminController@delete');
        Route::get('subadmins/roles/{id}' , 'AdminController@editSubadminRoles')->name('subadmins.roles');
        Route::post('subadmins/update/roles/{id}' , 'AdminController@updateSubadminRoles')->name('subadmins.update.roles');

    });



});
