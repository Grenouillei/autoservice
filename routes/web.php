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

Route::post('/confirm_order','App\Http\Controllers\GoodsController@createNewOrder' )->name('confirm_order');
Route::get('/change_admin_pass','App\Http\Controllers\UserController@updateAdminPassword')->name('change_pass');
Route::get('/currency_update','App\Http\Controllers\UserController@updateCurrencies')->name('update_curr');

Route::name('user.')->prefix('user')->group(function (){
    Route::get('/premium','App\Http\Controllers\UserController@buyUserPremium')->name('premium');
    Route::post('/create','App\Http\Controllers\UserController@createUser' )->name('create');
    Route::post('/admin','App\Http\Controllers\UserController@takeUserAdmin')->name('admin');
    Route::post('/update','App\Http\Controllers\UserController@updateUser')->name('update');
    Route::get('/remove','App\Http\Controllers\UserController@removeUser')->name('remove');
});

Route::name('product.')->prefix('product')->group(function (){
    Route::get('/change','App\Http\Controllers\GoodsController@changeAvailabilityOfGoods' )->name('change');
    Route::post('/create','App\Http\Controllers\GoodsController@createNewProduct' )->name('create');
    Route::get('/delete','App\Http\Controllers\GoodsController@removeProduct' )->name('delete');
});

Route::name('comment.')->prefix('comment')->group(function (){
    Route::post('/create','App\Http\Controllers\UserController@createComment')->name('create');
    Route::get('/update','App\Http\Controllers\UserController@updateComment')->name('update');
    Route::get('/delete','App\Http\Controllers\UserController@removeComment')->name('remove');
});

Route::name('favorite.')->prefix('favorite')->group(function (){
    Route::get('/delete','App\Http\Controllers\UserController@deleteFavorite')->name('delete');
    Route::get('/create','App\Http\Controllers\UserController@addFavorite')->name('create');
});

Route::name('cart.')->prefix('cart')->group(function (){
    Route::get('/delete','App\Http\Controllers\CartController@removeCart' )->name('delete');
    Route::get('/create','App\Http\Controllers\CartController@addCart' )->name('create');
});

Route::middleware('auth')->group(function (){
    Route::name('page.')->prefix('page')->group(function (){
        Route::get('/buy','App\Http\Controllers\CartController@openBuyPage' )->name('buy');
        Route::get('/new','App\Http\Controllers\GoodsController@openNewPage' )->name('new');
        Route::get('/user','App\Http\Controllers\UserController@openUserPage')->name('user');
        Route::get('/home','App\Http\Controllers\GoodsController@openHomePage' )->name('home');
        Route::get('/cart','App\Http\Controllers\CartController@openCartPage' )->name('basket');
        Route::get('/about','App\Http\Controllers\GoodsController@openAboutPage' )->name('about');
        Route::get('/search','App\Http\Controllers\GoodsController@openSearchPage' )->name('search');
        Route::get('/contact','App\Http\Controllers\GoodsController@openContactPage' )->name('contact');
        Route::get('/brand','App\Http\Controllers\GoodsController@openSortByBrandPage' )->name('brand');
        Route::get('/archive','App\Http\Controllers\GoodsController@openArchivePage' )->name('archive');
        Route::get('/user/new','App\Http\Controllers\UserController@openNewUserPage' )->name('user-new');
        Route::get('/product','App\Http\Controllers\GoodsController@openNewProductPage' )->name('product');
        Route::get('/user/setting','App\Http\Controllers\UserController@openUserSettingsPage')->name('user-set');
    });
});

require __DIR__.'/auth.php';
