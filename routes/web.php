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

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/singin', function () {
    return view('singin');
})->name('singin');

Route::get('/user','App\Http\Controllers\UserController@openUserPage')->name('user');
Route::get('/user_update','App\Http\Controllers\UserController@updateUser');
Route::get('/add','App\Http\Controllers\BasketController@addElementToBasket' );
Route::get('/score','App\Http\Controllers\BasketController@takeCountOfBasket' );
Route::get('/del','App\Http\Controllers\BasketController@deleteElementFromBasket' );
Route::get('/new','App\Http\Controllers\GoodsController@openNewPage' )->name('new');
Route::get('/home','App\Http\Controllers\GoodsController@openHomePage' )->name('home');
Route::get('/more','App\Http\Controllers\ContactController@allData' )->name('contact-data');
Route::get('/basket','App\Http\Controllers\BasketController@openBasketPage' )->name('basket');
Route::get('/brand','App\Http\Controllers\GoodsController@openSortByBrandPage' )->name('brand');
Route::get('/searchForm','App\Http\Controllers\GoodsController@openSearchPage' )->name('search');
Route::post('/contact/submit','App\Http\Controllers\ContactController@submit' )->name('contact-form');

Route::middleware('auth')->group(function (){

});

Route::get('/dashboard', 'App\Http\Controllers\GoodsController@openHomePage')->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
