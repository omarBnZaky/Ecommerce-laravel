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

/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::resource('admin/categories', 'Admin\\CategoriesController');
Route::resource('admin/subcategories', 'Admin\\subcategoriesController');
Route::resource('admin/products', 'Admin\\ProductsController');
Auth::routes();

Route::get('/dashbord', 'HomeController@index')->name('admin');
Route::get('/ajax-subcat','Admin\\ProductsController@subcategories');


Route::get('/', 'PublicController@index')->name('public');
Route::get('/product/{id}', 'PublicController@show_product')->name('public');
Route::get('/payment/{id}','PublicController@payment_page');
//Route::post('/payment/{id}','PublicController@buyProduct');