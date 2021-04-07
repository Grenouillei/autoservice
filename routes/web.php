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

Route::post('/create_product','App\Http\Controllers\GoodsController@createNewProduct' )->name('create_pr');
Route::get('/change','App\Http\Controllers\GoodsController@changeAvailabilityOfGoods' )->name('change');
Route::get('/delete_product','App\Http\Controllers\GoodsController@removeProduct' )->name('delete_pr');

Route::post('/create_comment','App\Http\Controllers\UserController@createComment')->name('create_com');
Route::post('/create_user','App\Http\Controllers\UserController@createUser' )->name('create_us');
Route::post('/user_admin','App\Http\Controllers\UserController@takeUserAdmin')->name('admin');
Route::post('/user_update','App\Http\Controllers\UserController@updateUser')->name('update');
Route::get('/update_comment','App\Http\Controllers\UserController@updateComment')->name('update_com');
Route::get('/delete_comment','App\Http\Controllers\UserController@removeComment')->name('remove_com');
Route::get('/del_favorite','App\Http\Controllers\UserController@deleteFavorite')->name('del_favor');
Route::get('/add_favorite','App\Http\Controllers\UserController@addFavorite')->name('add_favor');
Route::get('/change_admin_pass','App\Http\Controllers\UserController@updateAdminPassword')->name('change_pass');
Route::get('/update_currency','App\Http\Controllers\UserController@updateCurrencies')->name('update_curr');
Route::get('/user_remove','App\Http\Controllers\UserController@removeUser')->name('remove');
Route::get('/user_premium','App\Http\Controllers\UserController@buyUserPremium' );

Route::get('/del_cart','App\Http\Controllers\CartController@removeCart' )->name('del_cart');
Route::get('/add_cart','App\Http\Controllers\CartController@addCart' )->name('add_cart');

Route::middleware('auth')->group(function (){
    Route::get('/new_page','App\Http\Controllers\GoodsController@openNewPage' )->name('new');
    Route::get('/buy_page','App\Http\Controllers\CartController@openBuyPage' )->name('buy');
    Route::get('/user_page','App\Http\Controllers\UserController@openUserPage')->name('user');
    Route::get('/home_page','App\Http\Controllers\GoodsController@openHomePage' )->name('home');
    Route::get('/dashboard', 'App\Http\Controllers\GoodsController@openHomePage')->name('dashboard');
    Route::get('/search_page','App\Http\Controllers\GoodsController@openSearchPage' )->name('search');
    Route::get('/cart_page','App\Http\Controllers\CartController@openCartPage' )->name('basket');
    Route::get('/brand_page','App\Http\Controllers\GoodsController@openSortByBrandPage' )->name('brand');
    Route::get('/product_page','App\Http\Controllers\GoodsController@openNewProductPage' )->name('product');
    Route::get('/new_user','App\Http\Controllers\UserController@openNewUserPage' )->name('new_user');
    Route::get('/about_page','App\Http\Controllers\GoodsController@openAboutPage' )->name('about');
    Route::get('/contact_page','App\Http\Controllers\GoodsController@openContactPage' )->name('contact');
    Route::get('/user_setting','App\Http\Controllers\UserController@openUserSettingsPage')->name('user_s');
});

require __DIR__.'/auth.php';
