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
Route::get('/sobre', 'HomeController@about'); //sobre a lancheria

//----------------------------Authentication-----------------------//

Auth::routes();
Route::get('/registrar', 'RegisterController@create');//redireciona para a tela de cadastro
Route::post('/registrar', 'RegisterController@store');//direciona os dados para o Eloquent
Route::get('/login', 'LoginController@create')->name('login');//redireciona para a tela de login
Route::post('/login', 'LoginController@store');//autentica e loga o usuário
Route::get('/logout', 'LoginController@destroy');//logout sem confirmação(sujeito a modificações)
Route::get('/editar', 'UserController@edit');//tela de edição - nome e sobrenome apenas
Route::post('/editar', 'UserController@update');//edita nome e sobrenome do cliente (sujeito a modificações)
Route::get('/home', 'HomeController@index');
Route::get('/conta', 'BindController@show');//Wildcard/Joker
Route::get('/historico', 'BindController@history');
Route::get('/senha', 'UserController@password');
Route::post('/senha', 'UserController@change');

Route::group(array('middleware' => ['auth', 'admin']), function ()
{
  //----------------------------Produtos-----------------------------//
  Route::get('/produtos', 'ProductsController@index');//Search -- todos os produtos
  Route::get('/produtos/adicionar', 'ProductsController@create');//Create -- tela de cadastro
  Route::post('/produtos', 'ProductsController@store');//Create -- novo produto
  Route::get('/produto/{product}/editar','ProductsController@edit');//editing -- produto selecionado
  Route::get('/produto/{product}', 'ProductsController@show');//Search -- produto selecionado
  Route::post('/produto/{product}', 'ProductsController@update');//Update -- produto selecionado
  Route::post('produto/{product}/excluir', 'ProductsController@destroy');//Delete -- produto selecionado
  Route::get('/produto/{product}/estoque', 'StockController@edit');//tela de estoque
  Route::post('/produto/{product}/armazem', 'StockController@update');//adiciona a quantia no estoque
  Route::get('/produtos/pesquisar', 'ProductsController@search');

  //--------------------------Clientes-(Será modificada após a primeira sprint)-//

  Route::get('/clientes/adicionar', 'ClientsController@create');
  Route::post('/clientes', 'ClientsController@store');
  Route::get('/cliente/{client}/editar', 'ClientsController@edit');
  Route::get('/cliente/{client}', 'ClientsController@show');//Wildcard/Joker
  Route::post('/cliente/{client}', 'ClientsController@update');
  Route::post('/cliente/{client}/excluir', 'ClientsController@destroy');
  Route::get('/clientes', 'ClientsController@index');
  Route::get('/cliente/{client}/historico', 'HistoryController@show');
  Route::get('/clientes/pesquisar', 'ClientsController@search');
  Route::post('/cliente/{client}/pagamento', 'ItemsController@edit');

  //--------------------------Operação de Venda-(fase de testes)-------------//

  Route::get('/venda', 'ItemsController@create');
  Route::post('/venda', 'ItemsController@store');
  Route::post('/venda/{item}/excluir', 'ItemsController@destroy');
  Route::get('/pagamento', 'ItemsController@payment');
  Route::get('/pagamento/abrir', 'ItemsController@open');

  //--------------------------Operação de Venda-(Visitantes)-------------//

  Route::get('/visitantes', 'VisitorController@show');
  Route::get('/visitantes/adicionar', 'VisitorController@create');
  Route::post('/visitantes', 'VisitorController@store');
  Route::post('/visitantes/pagamento', 'VisitorController@edit');
  Route::post('/visitantes/cancelar', 'VisitorController@delete');
  Route::post('/visitantes/{item}/excluir', 'VisitorController@destroy');


  //----------------Regra de Negócio (Vínculo entre contas)-----------------//

  Route::get('/cliente/{client}/bind', 'BindController@index');
  Route::post('/cliente/{client}/bind', 'BindController@update');
  Route::post('/mail/{usuario}', 'LateController@send');
  Route::get('/', 'HomeController@homepage');
  Route::any('/', array('uses' => 'LateController@index'));
  Route::get('/stats', 'StatsController@stats');


});
