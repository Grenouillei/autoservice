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

Route::get('/change_admin_pass','App\Http\Controllers\Admin\ACurrencyController@updateAdminPassword')->name('change_pass');
Route::get('/currency_update','App\Http\Controllers\Admin\ACurrencyController@updateCurrencies')->name('update_curr');
Route::post('/confirm_order','App\Http\Controllers\OrderController@createNewOrder' )->name('confirm_order');

Route::name('user.')->prefix('user')->group(function (){
    Route::get('/premium','App\Http\Controllers\PremiumController@buyUserPremium')->name('premium');
    Route::post('/create','App\Http\Controllers\Admin\AUsersController@createUser' )->name('create');
    Route::post('/admin','App\Http\Controllers\Admin\AUsersController@takeUserAdmin')->name('admin');
    Route::get('/remove','App\Http\Controllers\Admin\AUsersController@removeUser')->name('remove');
    Route::post('/update','App\Http\Controllers\UserController@updateUser')->name('update');
});

Route::name('product.')->prefix('product')->group(function (){
    Route::get('/change','App\Http\Controllers\Admin\AGoodsController@changeAvailableProduct' )->name('change');
    Route::post('/create','App\Http\Controllers\Admin\AGoodsController@createProduct' )->name('create');
    Route::post('/update','App\Http\Controllers\Admin\AGoodsController@updateProduct' )->name('update');
    Route::get('/delete','App\Http\Controllers\Admin\AGoodsController@removeProduct' )->name('delete');
});

Route::name('comment.')->prefix('comment')->group(function (){
    Route::post('/create','App\Http\Controllers\CommentController@createComment')->name('create');
    Route::get('/update','App\Http\Controllers\CommentController@updateComment')->name('update');
    Route::get('/delete','App\Http\Controllers\CommentController@removeComment')->name('remove');
});

Route::name('favorite.')->prefix('favorite')->group(function (){
    Route::get('/delete','App\Http\Controllers\FavoriteController@deleteFavorite')->name('delete');
    Route::get('/create','App\Http\Controllers\FavoriteController@addFavorite')->name('create');
});

Route::name('cart.')->prefix('cart')->group(function (){
    Route::get('/delete','App\Http\Controllers\CartController@removeCart' )->name('delete');
    Route::get('/create','App\Http\Controllers\CartController@addCart' )->name('create');
});

Route::middleware('auth')->group(function (){
    Route::name('page.')->prefix('page')->group(function (){
        Route::get('/buy','App\Http\Controllers\CartController@openBuyPage' )->name('buy');
        Route::get('/user','App\Http\Controllers\UserController@openUserPage')->name('user');
        Route::get('/home','App\Http\Controllers\GoodsController@openHomePage' )->name('home');
        Route::get('/cart','App\Http\Controllers\CartController@openCartPage' )->name('basket');
        Route::get('/brand','App\Http\Controllers\GoodsController@openBrandPage' )->name('brand');
        Route::get('/about','App\Http\Controllers\GoodsController@openAboutPage' )->name('about');
        Route::get('/search','App\Http\Controllers\GoodsController@openSearchPage' )->name('search');
        Route::get('/contact','App\Http\Controllers\GoodsController@openContactPage' )->name('contact');
        Route::get('/archive','App\Http\Controllers\OrderController@openArchivePage' )->name('archive');
        Route::get('/product','App\Http\Controllers\GoodsController@openProductPage' )->name('product');
        Route::get('/premium','App\Http\Controllers\PremiumController@openPremiumPage')->name('premium');
        Route::get('/user/setting','App\Http\Controllers\UserController@openUserSettingsPage')->name('user-set');
        Route::middleware('admin')->group(function (){
            Route::get('/user/new','App\Http\Controllers\Admin\AUsersController@openNewUserPage' )->name('user-new');
            Route::get('/product/create','App\Http\Controllers\Admin\AGoodsController@openNewProductPage' )->name('product-create');
            Route::get('/product/update','App\Http\Controllers\Admin\AGoodsController@openUpdateProductPage' )->name('product-update');
        });
    });
});

require __DIR__.'/auth.php';
