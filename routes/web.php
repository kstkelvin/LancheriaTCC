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


//-----------------------------Welcome-Page--------------------------//

Route::get('/', 'usersController@index'); //sujeito a modificações

//----------------------------Authentication-----------------------//

Auth::routes();
Route::get('/register', 'RegisterController@create');//redireciona para a tela de cadastro
Route::post('/register', 'RegisterController@store');//direciona os dados para o Eloquent
Route::get('/login', 'LoginController@create');//redireciona para a tela de login
Route::post('/login', 'LoginController@store');//autentica e loga o usuário
Route::get('/logout', 'LoginController@destroy');//logout sem confirmação(sujeito a modificações)

//----------------------------Produtos-----------------------------//

Route::get('/products', 'productsController@index');//Search -- todos os produtos
Route::get('/products/create', 'productsController@create');//Create -- tela de cadastro
Route::post('/products', 'productsController@store');//Create -- novo produto
Route::get('/product/{product}/edit','productsController@edit');//editing -- produto selecionado
Route::get('/product/{product}', 'productsController@show');//Search -- produto selecionado
Route::post('/product/{product}', 'productsController@update');//Update -- produto selecionado
Route::delete('product/{product}', 'productsController@delete');//Delete -- produto selecionado

//--------------------------Clientes-(Será modificada após a primeira sprint)-//

Route::get('/clients', 'clientsController@index');
Route::get('/clients/create', 'clientsController@create');
Route::post('/clients', 'clientsController@store');
Route::get('/client/{client}/edit', 'clientsController@edit');
Route::get('/client/{client}', 'clientsController@show');//Wildcard/Joker
Route::patch('/client/{client}', 'clientsController@update');
Route::delete('/client/{client}', 'clientsController@delete');
