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

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {

	Route::resources([
		'user' => UserController::class,
		'budget' => BudgetController::class,
		'budget.transaction' => TransactionController::class,
        'statistics' => StatisticsController::class,
	]);

    Route::resource('budget.account-balance', AccountBalanceController::class)->only(['create', 'store']);

    Route::resource('budget-link', BudgetLinkController::class)->only(['create', 'store']);

	Route::get('transaction/{transaction}/activity', 'TransactionController@activity')->name('transaction.activities');

	Route::get('budget/{budget}/transaction/{transaction}/duplicate', 'TransactionController@duplicate')->name('budget.transaction.duplicate');

});
