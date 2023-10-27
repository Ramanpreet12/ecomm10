<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CmsPageController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;

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

        // Categories
        Route::resource('categories', CategoryController::class);
        Route::post('update-category-status' , 'CategoryController@updateCategoryStatus')->name('update-category-status');
        Route::get('category/delete/{id}' , 'CategoryController@delete');
        // delete category image from folder and db
        Route::get('category-image/delete/{id}' , 'CategoryController@deleteImage');

        // products
        Route::resource('products', ProductController::class);
        Route::post('update-product-status' , 'ProductController@updateProductStatus')->name('update-product-status');
        Route::get('product/delete/{id}' , 'ProductController@delete');
            // delete product video from folder and db
            Route::get('product-video/delete/{id}' , 'ProductController@deleteVideo');


    });



});
