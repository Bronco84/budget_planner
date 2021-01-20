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

	Route::resource('budget', 'BudgetController');

	Route::post('budget-link', 'BudgetLinkController@store_link')->name('budget.link.post');

	Route::get('budget-link/{budget?}', 'BudgetLinkController@show_link_form')->name('budget.link.form');

	Route::resource('budget.account-balance', 'AccountBalanceController');

	Route::resource('budget.transaction', 'TransactionController');

	Route::get('transaction/{transaction}/activity', 'TransactionController@activity')->name('transaction.activities');

	Route::get('budget/{budget}/transaction/{transaction}/duplicate', 'TransactionController@duplicate')->name('budget.transaction.duplicate');

});