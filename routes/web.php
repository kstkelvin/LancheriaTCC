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

Route::get('/', 'homeController@index'); //sujeito a modificações

//----------------------------Authentication-----------------------//

Auth::routes();
Route::get('/registrar', 'RegisterController@create');//redireciona para a tela de cadastro
Route::post('/registrar', 'RegisterController@store');//direciona os dados para o Eloquent
Route::get('/login', 'LoginController@create')->name('login');//redireciona para a tela de login
Route::post('/login', 'LoginController@store');//autentica e loga o usuário
Route::get('/logout', 'LoginController@destroy');//logout sem confirmação(sujeito a modificações)
Route::get('/editar', 'UserController@edit');//tela de edição - nome e sobrenome apenas
Route::post('/editar', 'UserController@update');//edita nome e sobrenome do cliente (sujeito a modificações)

//----------------------------Produtos-----------------------------//

Route::get('/produtos', 'productsController@index');//Search -- todos os produtos
Route::get('/produtos/adicionar', 'productsController@create');//Create -- tela de cadastro
Route::post('/produtos', 'productsController@store');//Create -- novo produto
Route::get('/produto/{product}/editar','productsController@edit');//editing -- produto selecionado
Route::get('/produto/{product}', 'productsController@show');//Search -- produto selecionado
Route::post('/produto/{product}', 'productsController@update');//Update -- produto selecionado
Route::post('produto/{product}/excluir', 'productsController@destroy');//Delete -- produto selecionado


//--------------------------Clientes-(Será modificada após a primeira sprint)-//

Route::get('/clientes', 'clientsController@index');
Route::get('/clientes/adicionar', 'clientsController@create');
Route::post('/clientes', 'clientsController@store');
Route::get('/cliente/{client}/editar', 'clientsController@edit');
Route::get('/cliente/{client}', 'clientsController@show');//Wildcard/Joker
Route::post('/cliente/{client}', 'clientsController@update');
Route::post('/cliente/{client}/excluir', 'clientsController@destroy');


//--------------------------Operação de Venda-(fase de testes)-------------//

Route::get('/venda', 'itemsController@create');
Route::post('/venda', 'itemsController@store');
Route::get('/cliente/{client}/pagamento', 'itemsController@edit');
Route::post('/venda/{client}/excluir', 'ItemsController@destroy');

//-------------------------Regras de Negócio-------------------------------//

Route::get('/produto/{product}/estoque', 'stockController@edit');//tela de estoque
Route::post('/produto/{product}/armazem', 'stockController@update');//adiciona a quantia no estoque
Route::get('/clientes/pesquisar', 'clientsController@search');
