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

Route::get('/', function () {
   return redirect()->route('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {

	Route::resource('/transaction', 'TransactionController');

	Route::get('/transaction/{transaction}/duplicate', 'TransactionController@duplicate')->name('transaction.duplicate');

	Route::get('/budget', 'BudgetController@show')->name('budget');

});