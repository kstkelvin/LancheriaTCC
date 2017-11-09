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

Route::get('/', 'HomeController@homepage'); //sujeito a modificações
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

//----------------------------Produtos-----------------------------//

Route::get('/produtos', 'ProductsController@index');//Search -- todos os produtos
Route::get('/produtos/adicionar', 'ProductsController@create');//Create -- tela de cadastro
Route::post('/produtos', 'ProductsController@store');//Create -- novo produto
Route::get('/produto/{product}/editar','ProductsController@edit');//editing -- produto selecionado
Route::get('/produto/{product}', 'ProductsController@show');//Search -- produto selecionado
Route::post('/produto/{product}', 'ProductsController@update');//Update -- produto selecionado
Route::post('produto/{product}/excluir', 'ProductsController@destroy');//Delete -- produto selecionado


//--------------------------Clientes-(Será modificada após a primeira sprint)-//

Route::get('/clientes', 'ClientsController@index');
Route::get('/clientes/adicionar', 'ClientsController@create');
Route::post('/clientes', 'ClientsController@store');
Route::get('/cliente/{client}/editar', 'ClientsController@edit');
Route::get('/cliente/{client}', 'ClientsController@show');//Wildcard/Joker
Route::post('/cliente/{client}', 'ClientsController@update');
Route::post('/cliente/{client}/excluir', 'ClientsController@destroy');


//--------------------------Operação de Venda-(fase de testes)-------------//

Route::get('/venda', 'ItemsController@create');
Route::post('/venda', 'ItemsController@store');
Route::get('/cliente/{client}/pagamento', 'ItemsController@edit');
Route::post('/venda/{client}/excluir', 'ItemsController@destroy');

//-------------------------Regras de Negócio-------------------------------//

Route::get('/produto/{product}/estoque', 'StockController@edit');//tela de estoque
Route::post('/produto/{product}/armazem', 'StockController@update');//adiciona a quantia no estoque
Route::get('/clientes/pesquisar', 'ClientsController@search');
