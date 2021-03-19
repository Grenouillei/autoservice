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
    return view('welcome');
})->name('welcome');

Route::get('/about_page', function () {
    return view('about');
})->name('about');

Route::get('/contact_page', function () {
    return view('contact');
})->name('contact');

Route::post('/user_update','App\Http\Controllers\UserController@updateUser')->name('update');
Route::get('/user_admin','App\Http\Controllers\UserController@takeUserAdmin');
Route::get('/del','App\Http\Controllers\BasketController@deleteElementFromBasket' );
Route::get('/user_premium','App\Http\Controllers\UserController@buyUserPremium' );
Route::get('/score','App\Http\Controllers\BasketController@takeCountOfBasket' );
Route::get('/add','App\Http\Controllers\BasketController@addElementToBasket' );

Route::middleware('auth')->group(function (){
    Route::get('/new_page','App\Http\Controllers\GoodsController@openNewPage' )->name('new');
    Route::get('/user_page','App\Http\Controllers\UserController@openUserPage')->name('user');
    Route::get('/home_page','App\Http\Controllers\GoodsController@openHomePage' )->name('home');
    Route::get('/dashboard', 'App\Http\Controllers\GoodsController@openHomePage')->name('dashboard');
    Route::get('/search_page','App\Http\Controllers\GoodsController@openSearchPage' )->name('search');
    Route::get('/basket_page','App\Http\Controllers\BasketController@openBasketPage' )->name('basket');
    Route::get('/brand_page','App\Http\Controllers\GoodsController@openSortByBrandPage' )->name('brand');
    Route::get('/user_setting','App\Http\Controllers\UserController@openUserSettingsPage')->name('user_s');
});

require __DIR__.'/auth.php';
