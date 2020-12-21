<?php


use Illuminate\Support\Facades\Route;

Route::get('/', 'AdminController@index')->name('admin');;
Route::resource('users','UsersController')->except('show');
Route::resource('products','ProductsController');
Route::resource('comments','CommentsController')->except(['show' , 'create' , 'store' , 'edit']);
Route::resource('products.gallery' , 'ProductGalleryController');
Route::resource('categories' , 'CategoryController');
Route::post('attribute/values' , 'AttributeController@getValues');
Route::resource('articles' , 'AdminArticleController');
Route::resource('message' , 'MessageController');
Route::get('receivedMessages' , 'receivedMessagesController@index')->name('receivedMessages');
Route::post('receivedMessages/replay' , 'receivedMessagesController@replay')->name('replay');

Route::get('/users/{user}/permissions', 'User\PermissionController@create')->name('users.permissions')->middleware('can:staff-user-permissions');
Route::post('/users/{user}/permissions', 'User\PermissionController@store')->name('users.permissions.store')->middleware('can:staff-user-permissions');
Route::resource('permissions', 'PermissionController');
Route::resource('roles', 'RoleController');

Route::resource('discount' , 'DiscountController')->except(['show']);

Route::resource('orders' , 'OrderController');
Route::get('orders/{order}/orders', 'OrderController@payments')->name('orders.payments');

Route::get('settings' , 'SettingsController@settings_show')->name('settings.show');
Route::post('settings/update' , 'SettingsController@settings_update')->name('settings.update');

Route::resource('banners' , 'BannersController');

Route::get('sortBannersIndex' , 'BannersController@sortBannersIndex')->name('banners.sortBannersIndex');
Route::post('sortBannersUpdate' , 'BannersController@sortBannersUpdate')->name('banners.sortBannersUpdate');

Route::get('settings/questions' , 'SettingsController@questions_show')->name('questions.show');
Route::patch('settings/questions/update' , 'SettingsController@questions_update')->name('questions.update');

Route::get('price/all' , 'PriceController@index')->name('price.all');
Route::get('price/singlePrice/products/{product}/edit' , 'PriceController@singlePriceEdit')->name('price.singlePrice.edit');
Route::post('price/singlePrice/update/products/{product}' , 'PriceController@singlePriceUpdate')->name('price.singlePrice.update');
Route::get('price/multiPrice/products/{product}/edit' , 'PriceController@multiPriceEdit')->name('price.multiPrice.edit');
Route::post('price/multiPrice/update/products/{product}' , 'PriceController@multiPriceUpdate')->name('price.multiPrice.update');
