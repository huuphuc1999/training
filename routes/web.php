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

Route::get(
    '/',
    function () {
        return Redirect()->route('login');
    }
);

Route::get(
    'logout', '\App\Http\Controllers\Auth\LoginController@logout',
    function () {
        session()->forget();
    }
)->name('logout');
// Backend section start

Route::group(
    ['prefix' => '/admin', 'middleware' => ['auth']], function () {

        Route::get('/', 'AdminController@index')->name('admin');
        // User route
        Route::resource('users', 'UserController');
        Route::post('users/status/{id}', 'UserController@userLockOrUnlock')->name('users.status');
        // Product route
        Route::get('products', 'ProductController@index')->name('products.index');
        Route::get('products/details/{product}', 'ProductController@show')->name('products.show');
        Route::post('products', 'ProductController@store')->name('products.store');
        Route::post('products/update/{product}', 'ProductController@update')->name('products.update');
        Route::delete('products/delete/{product}', 'ProductController@destroy')->name('products.destroy');

    }
);

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
