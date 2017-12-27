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

Route::get('/', 'TestController@welcome');
Auth::routes();

Route::get('/search', 'SearchController@show');
Route::get('/products/json', 'SearchController@data');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/products/{id}', 'ProductController@show'); 

Route::post('/cart', 'CartDetailController@store'); 
Route::delete('/cart', 'CartDetailController@destroy');

Route::post('/order', 'CartController@update'); 

Route::get('/categories/{category}', 'CategoryController@show'); 



Route::middleware(['auth','admin'])->prefix('admin')->namespace('Admin')->group(function(){
    //C
    Route::get('/products/create', 'ProductController@create'); //Mostrar formulario registro
    Route::post('/products', 'ProductController@store'); //registrar
    //R
    Route::get('/products', 'ProductController@index'); //Listar
    //U
    Route::get('/products/{id}/edit', 'ProductController@edit'); //Mostrar formulario de edición
    Route::post('/products/{id}/edit', 'ProductController@update'); //registrar
    //D
    Route::delete('/products/{id}', 'ProductController@destroy');

    Route::get('/products/{id}/images', 'ImageController@index');//Motrar imagenes
    Route::post('/products/{id}/images', 'ImageController@store');//Añadir nueva imagen
    Route::delete('/products/{id}/images', 'ImageController@destroy');//Eliminar imagen
    Route::get('/products/{id}/images/select/{image}', 'ImageController@select');//Destacar imagen

    
    Route::get('/categories/create', 'CategoryController@create'); 
    Route::post('/categories', 'CategoryController@store'); 
    Route::get('/categories', 'CategoryController@index'); 
    Route::get('/categories/{category}/edit', 'CategoryController@edit');
    Route::post('/categories/{category}/edit', 'CategoryController@update');
    Route::delete('/categories/{category}', 'CategoryController@destroy');
});