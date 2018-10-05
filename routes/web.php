<?php

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


Route::get('/', 'ProductController@index')->name('home');

Route::get('/add-to-cart/{id}', 'CartController@addToCart')->name('add.to.cart');
Route::get('/cart', 'CartController@index')->name('cart.view');
Route::get('/cart/{id}', 'CartController@deleteCartItem')->name('remove.cart');
Route::get('/cart/{id}/reduce', 'CartController@reduceCartItem')->name('reduce.cart');
Route::get('/cart/{id}/add', 'CartController@addCartItem')->name('add.cart');
Route::post('/cart/empty', 'CartController@emptyCart')->name('cart.empty');

Route::post('/add/cart','CartController@addCustomToCart')->name('custom.cart.add');

Auth::routes();

Route::get('/checkout','CheckOutController@checkOutView')->name('checkout.view');
Route::post('/checkout/order','CheckOutController@checkOut')->name('order.cart');

Route::group(['prefix'=>'user'],function(){

	Route::get('/profile','HomeController@myProfile')->name('profile');
	Route::get('/account','HomeController@myAccount')->name('account');
	Route::post('/credit/account','HomeController@creditAccount')->name('account.credit');

});

//orders
Route::get('/orders','OrderController@index')->name('my.orders');

Route::post('/confirm/order/{id}','OrderController@receive')->name('confirm.order');
Route::post('/reject/order/{id}','OrderController@rejectOrder')->name('reject.order');
Route::get('/delete/order/{id}','OrderController@deleteOrder')->name('delete.order');
Route::post('/comment/order','OrderController@commentOrder')->name('comment.order');

Route::get('/contact','HomeController@contact')->name('contact');


Route::get('/error',function(){
  return view('404');
})->name('error');

//////////////Admin//////////////////////

Route::group(['prefix'=>'admin'],function(){

	Route::get('/','AdminController@index')->name('admin');
	Route::get('/payments','AdminController@payments')->name('payments');


	//product
	Route::get('/products','ProductController@products')->name('products');
	Route::get('/product/{id}','ProductController@show')->name('product.show');
	Route::post('/product/{id}','ProductController@update')->name('product.edit');
	Route::post('/product/{id}/delete','ProductController@destroy')->name('product.delete');
	Route::get('/add/product','ProductController@create')->name('create.product.form');
	Route::post('/add/product','ProductController@store')->name('product.add');

	//tentsize
	Route::get('/tentsizes','TentSizeController@index')->name('tentsizes');
	Route::get('/tentsize/{id}','TentSizeController@show')->name('tentsize.show');
	Route::post('/tentsize/{id}','TentSizeController@update')->name('tentsize.edit');
	Route::post('/tentsize/{id}/delete','TentSizeController@destroy')->name('tentsize.delete');
	Route::get('/add/tentsize','TentsizeController@create')->name('create.tentsize.form');
	Route::post('/add/tentsize','TentSizeController@store')->name('tentsize.add');

	//order
    Route::get('/orders','OrderController@orders')->name('orders');
    Route::post('/confirm/{id}','OrderController@confirmOrder')->name('confirm');
    Route::post('/reject/{id}','OrderController@rejectOrder')->name('reject');
    Route::post('/ship/{id}','OrderController@ship')->name('ship');
	//items
	Route::get('/items','ItemController@index')->name('items');
	Route::get('/item/{id}','ItemController@show')->name('item.show');
	Route::post('/item/{id}','ItemController@update')->name('item.edit');
	Route::post('/item/{id}/delete','ItemController@destroy')->name('item.delete');
	Route::get('/add/item','ItemController@create')->name('create.item.form');
	Route::post('/add/item','ItemController@store')->name('item.add');

});