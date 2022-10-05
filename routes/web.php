<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', 'HomeController@redirectRoute');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout'); //phpcs:ignore
// Backend section start

Route::group(
    ['prefix' => '/admin', 'middleware' => ['auth']], function () {

        Route::get('/', 'AdminController@index')->name('admin');
        // User route
        Route::resource('users', 'UserController');
        Route::post('users/status/{id}', 'UserController@userLockOrUnlock')->name('users.status'); //phpcs:ignore
        // Product route
        Route::get('products', 'ProductController@index')->name('products.index');
        Route::get('products/details/{product}', 'ProductController@show')->name('products.show'); //phpcs:ignore
        Route::post('products', 'ProductController@store')->name('products.store');
        Route::post('products/update/{product}', 'ProductController@update')->name('products.update'); //phpcs:ignore
        Route::delete('products/delete/{product}', 'ProductController@destroy')->name('products.destroy'); //phpcs:ignore
        // Customer route
        Route::get('customers', 'CustomerController@index')->name('customers.index');
        Route::get('customers/details/{customers}', 'CustomerController@show')->name('customers.show'); //phpcs:ignore
        Route::post('customers', 'CustomerController@store')->name('customers.store'); //phpcs:ignore
        Route::post('customers/update/{customers}', 'CustomerController@update')->name('customers.update'); //phpcs:ignore
        // Customer route for excel
        Route::get('customers/export', 'CustomerController@export')->name('customers.export'); //phpcs:ignore
        Route::post('customers/import', 'CustomerController@import')->name('customers.import'); //phpcs:ignore

    }
);

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
