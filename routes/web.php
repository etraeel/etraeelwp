<?php

use Illuminate\Encryption\Encrypter;
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

Route::get('/', 'HomeController@index');

Auth::routes(['verify'=>true ]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/category/{category}', 'ProductController@index')->name('products');
Route::get('/product/list/{id}', 'ProductController@productlist');
Route::get('/product/{id}', 'ProductController@single')->name('product.single');
Route::post('/comment','HomeController@comment')->name('send.comment');
Route::post('/comment/like','HomeController@likeAndDislike')->name('like.dislike');
Route::post('/product/rate','ProductController@submitRate');
Route::get('/questions', 'HomeController@questions')->name('questions');
Route::get('/contactUs', 'HomeController@contactUs')->name('contactUs');
Route::get('/aboutUs', 'HomeController@aboutUs')->name('aboutUs');
Route::post('/search', 'HomeController@search')->name('search');
Route::get('/compare/{data}', 'HomeController@compare')->name('compare');

Route::get('/cart', 'CartController@index')->name('cart.index');
Route::patch('/cart/update', 'CartController@update')->name('cart.update');
Route::patch('/cart/delete', 'CartController@delete')->name('cart.delete');
Route::post('cart/add/' , 'CartController@addToCart')->name('cart.add');


Route::post('discount/check/{data}' , 'DiscountController@checkCode');

Route::middleware('auth')->group(function() {

    Route::get('cart/selectAddress' , 'CartController@selectAddress')->name('cart.selectAddress');
    Route::post('payment' , 'PaymentController@payment')->name('cart.payment');
    Route::get('payment/callback' , 'PaymentController@callback')->name('payment.callback');
    Route::get('profile' , 'ProfileController@index')->name('profile.index');
    Route::get('profile/addresses' , 'ProfileController@addresses')->name('profile.addresses');
    Route::get('profile/edit' , 'ProfileController@edit')->name('profile.edit');
    Route::get('profile/messages' , 'ProfileController@messages')->name('profile.messages');
    Route::get('profile/sendMessage' , 'ProfileController@sendMessage')->name('profile.sendMessage');
    Route::post('profile/sendMessageToAdmin' , 'ProfileController@sendMessageToAdmin')->name('profile.sendMessageToAdmin');
    Route::post('profile/showMessage' , 'ProfileController@showMessage')->name('profile.showMessage');
    Route::post('profile/edit/editUser' , 'ProfileController@editUser')->name('profile.editUser');
    Route::get('profile/getcities' , 'ProfileController@getCities')->name('profile.getcities');
    Route::post('profile/addAddress' , 'ProfileController@addAddress')->name('profile.addAddress');
    Route::post('profile/setDefaultAddress' , 'ProfileController@setDefaultAddress')->name('profile.setDefaultAddress');
    Route::get('profile/deleteAddress/{id}' , 'ProfileController@deleteAddress')->name('profile.deleteAddress');
    Route::get('profile/orders' , 'ProfileController@orders')->name('profile.orders');

});

