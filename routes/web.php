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

Route::group(['namespace' => 'App\Http\Controllers'], function(){ 

	// route for user after login
	Route::controller(UserController::class)->group(function() {

		Route::group(['middleware' => ['auth']], function() {
			
			Route::get('/dashboard', 'dashboard')->name('dashboard');

			Route::get('/deposit', 'deposit')->name('deposit');
			Route::post('/deposit', 'depositMoney')->name('depositMoney');
			
			Route::get('/withdraw', 'withdraw')->name('withdraw');
			Route::post('/withdrawMoney', 'withdrawMoney')->name('withdrawMoney');
			
			Route::get('/transfer', 'transfer')->name('transfer');
			Route::post('/transfer', 'transferMoney')->name('transferMoney');


			Route::get('/statement', 'statement')->name('statement');
		});	
	});

	// route for home page or main website available before/after login as well
	Route::controller(HomeController::class)->group(function() {

		    Route::get('/terms', 'terms')->name('terms');	
	});

	// route which available based for auth funcnality
	Route::controller(Auth\LoginRegisterController::class)->group(function() {
		// route which available Before login only
		Route::group(['middleware' => ['guest']], function() {
		    Route::get('/register', 'register')->name('register');
		    Route::post('/store', 'store')->name('store');
		    Route::get('/', 'login')->name('login');
		    Route::post('/authenticate', 'authenticate')->name('authenticate');
		});

		Route::group(['middleware' => ['auth']], function() {

		    Route::get('/logout', 'logout')->name('logout');
		});
	});
});