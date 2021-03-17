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

Route::get('/user_update','App\Http\Controllers\UserController@updateUser');
Route::get('/add','App\Http\Controllers\BasketController@addElementToBasket' );
Route::get('/user_premium','App\Http\Controllers\UserController@buyPremium' );
Route::get('/score','App\Http\Controllers\BasketController@takeCountOfBasket' );
Route::get('/del','App\Http\Controllers\BasketController@deleteElementFromBasket' );

Route::middleware('auth')->group(function (){
    Route::get('/new_page','App\Http\Controllers\GoodsController@openNewPage' )->name('new');
    Route::get('/user_page','App\Http\Controllers\UserController@openUserPage')->name('user');
    Route::get('/home_page','App\Http\Controllers\GoodsController@openHomePage' )->name('home');
    Route::get('/user_setting','App\Http\Controllers\UserController@openUserSettingsPage')->name('user_s');
    Route::get('/dashboard', 'App\Http\Controllers\GoodsController@openHomePage')->name('dashboard');
    Route::get('/search_page','App\Http\Controllers\GoodsController@openSearchPage' )->name('search');
    Route::get('/basket_page','App\Http\Controllers\BasketController@openBasketPage' )->name('basket');
    Route::get('/brand_page','App\Http\Controllers\GoodsController@openSortByBrandPage' )->name('brand');
});

require __DIR__.'/auth.php';
