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

//sujeito a modificações
//sobre a lancheria


Route::group(array('middleware' => ['auth', 'admin']), function ()
{
  //US01: Produtos------------------------------------------------------------//
  Route::get('/produtos', 'ProductsController@index');
  Route::get('/produtos/adicionar', 'ProductsController@create');
  Route::post('/produtos', 'ProductsController@store');
  Route::get('/produto/{product}/editar','ProductsController@edit');
  Route::post('/produto/{product}', 'ProductsController@update');
  Route::get('/produto/{product}', 'ProductsController@show');
  Route::post('produto/{product}/excluir', 'ProductsController@destroy');

});

Route::group(array('middleware' => ['auth', 'admin']), function ()
{
  //US02: Clientes------------------------------------------------------------//
  Route::get('/clientes', 'ClientsController@index');
  Route::get('/clientes/adicionar', 'ClientsController@create');
  Route::post('/clientes', 'ClientsController@store');
  Route::get('/cliente/{client}/editar', 'ClientsController@edit');
  Route::post('/cliente/{client}', 'ClientsController@update');
  Route::get('/cliente/{client}', 'ClientsController@show');//Wildcard/Joker
  Route::post('/cliente/{client}/excluir', 'ClientsController@destroy');
  Route::get('/cliente/{client}/historico', 'HistoryController@show');


});

Route::group(array('middleware' => ['auth', 'admin']), function ()
{//US03: Venda para funcionários----------------------------------------------//

  Route::get('/venda', 'ItemsController@create');
  Route::post('/venda', 'ItemsController@store');
  Route::post('/venda/{id}/excluir', 'ItemsController@destroy');


});

//US04/05: Acesso de administrador/Acesso de usuário--------------------------//
Route::get('/registrar', 'RegisterController@create');//redireciona para a tela de cadastro
Route::post('/registrar', 'RegisterController@store');//direciona os dados para o Eloquent
Route::get('/login', 'LoginController@create')->name('login');//redireciona para a tela de login
Route::post('/login', 'LoginController@store');//autentica e loga o usuário
Route::get('/logout', 'LoginController@destroy');//logout sem confirmação(sujeito a modificações)

Route::get('/email', 'AuthController@email');
Route::post('/email', 'AuthController@email_check');
Route::post('/confirm', 'AuthController@confirm_quest');
Route::post('/reset', 'AuthController@confirm_reset');

Route::group(array('middleware' => ['auth']), function ()
{
  Route::get('/sobre', 'HomeController@about');
  Route::get('/senha', 'UserController@password');
  Route::post('/senha', 'UserController@change');
  Route::get('/editar', 'UserController@edit');
  Route::post('/editar', 'UserController@update');
  Route::get('/pergunta', 'UserController@quest');
  Route::post('/prosseguir', 'UserController@add');
});

Route::group(array('middleware' => ['auth', 'user']), function ()
{
  Route::get('/home', 'HomeController@index');
  Route::get('/conta', 'BindController@show');
  Route::get('/historico', 'BindController@history');
  Route::any('/home', array('uses' => 'BindController@home'));

});

Route::group(array('middleware' => ['auth', 'admin']), function ()
{
  Route::get('/cliente/{client}/bind', 'BindController@index');
  Route::post('/cliente/{client}/bind', 'BindController@update');
  Route::get('/', 'HomeController@homepage');
});

Route::group(array('middleware' => ['auth', 'admin']), function ()
{
  //US06: Estatísticas--------------------------------------------------------//
  Route::get('/stats', 'StatsController@stats');
  //US07: Alerta de débito----------------------------------------------------//
  Route::any('/', array('uses' => 'LateController@index'));
  //US08:Barra de pesquisar para clientes-------------------------------------//
  Route::get('/clientes/pesquisar', 'ClientsController@search');
  //US09:Produtos:Estoque-----------------------------------------------------//
  Route::get('/produto/{product}/estoque', 'StockController@edit');
  Route::post('/produto/{product}/armazem', 'StockController@update');
  //US11:Nota Fiscal Eletrônica: Pagamento------------------------------------//
  Route::post('/cliente/{client}/pagamento', 'ItemsController@edit');
  Route::get('/pagamento', 'ItemsController@payment');
  Route::get('/pagamento/abrir', 'ItemsController@open');
  //US12:Barra de pesquisar para produtos-------------------------------------//
  Route::get('/produtos/pesquisar', 'ProductsController@search');
  //US13:Alerta para funcionários---------------------------------------------//
  Route::post('/mail/{usuario}', 'LateController@send');
  //US14:Venda para visitantes/pagamento para visitantes----------------------//
  Route::get('/visitantes', 'VisitorController@show');
  Route::post('/visitantes', 'VisitorController@store');
  Route::post('/visitantes/pagamento', 'VisitorController@edit');
  Route::post('/visitantes/cancelar', 'VisitorController@delete');
  Route::post('/visitantes/{item}/excluir', 'VisitorController@destroy');
});
