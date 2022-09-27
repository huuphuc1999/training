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
    '/', function () { 
        return view('welcome');
    }
);

Route::get(
    'logout', 
    '\App\Http\Controllers\Auth\LoginController@logout', function () {
        session()->forget();
    }
)->name('logout');
// Backend section start

Route::group(
    ['prefix'=>'/admin','middleware'=>['auth']], function () {

            Route::get(
                '/',
                'AdminController@index'
            )->name('admin');
            // User route
            Route::resource(
                'users',
                'UserController'
            );
    }
);

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
