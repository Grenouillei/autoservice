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


Route::get('/add','App\Http\Controllers\BasketController@addToBasket' );
Route::get('/del','App\Http\Controllers\BasketController@delElBasket' );
Route::get('/score','App\Http\Controllers\BasketController@basketheader' );

Route::get('/brand','App\Http\Controllers\GoodsController@SortByBrand' )->name('brand');

Route::get('/basket','App\Http\Controllers\BasketController@basketOpen' )->name('basket');
Route::get('/searchForm','App\Http\Controllers\GoodsController@searchNew' )->name('search');
//Route::get('/search','App\Http\Controllers\SparepartsController@searchNew' )->name('search');
Route::get('/new','App\Http\Controllers\GoodsController@openNewBuyPage' )->name('new');
Route::get('/home','App\Http\Controllers\GoodsController@outPuttOnPageHome' )->name('home');

Route::get('/more','App\Http\Controllers\ContactController@allData' )->name('contact-data');
Route::post('/contact/submit','App\Http\Controllers\ContactController@submit' )->name('contact-form');

Route::middleware('auth')->group(function (){

});

Route::get('/dashboard', 'App\Http\Controllers\GoodsController@outPuttOnPageHome')->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
