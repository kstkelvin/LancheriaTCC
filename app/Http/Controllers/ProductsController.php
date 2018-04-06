<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Client;
use App\Item;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Charts;

class ProductsController extends Controller
{

  public function __construct(){
    $this->middleware('auth');
  }

  public function index()

  {
    $products = Product::orderBy('name')->get();


    return view('products.index', compact('products'));

  }

  public function show($id) //Product::find(Joker/Wildcard);

  {
    $product = Product::findOrFail($id);

    $clients = Client::join('items', 'clients.id', '=', 'items.client_id', 'left outer')
    ->select('clients.name as name',
    DB::raw('coalesce(sum(items.amount), 0) as counter'))
    ->where('items.product_id','=', $id)
    ->groupBy('clients.id')
    ->orderBy('counter', 'desc')
    ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
    ->take(10)
    ->get();

    $chart_products = Charts::create('bar', 'highcharts')
    ->title('Estatísticas: Top 10 Compradores') // Título do gráfico
    ->labels($clients->pluck('name'))
    ->values($clients->pluck('counter'))
    ->dimensions(500, 300) // Dimensão = 500 largura x 300 altura
    ->responsive(true) // É utilizado para se adaptar ao tamanho do box que se encontra
    ->template("material")
    ->elementLabel("Top 10 Compradores do produto ".$product->name); // Legenda para o gráfico

    return view('products.show', compact('product', 'chart_products'));

  }

  public function search()
  {
    $products = Product::where('name', 'like', '%'. request()->search .'%')
    ->orderBy('name')->get();

    return view('products.index', compact('products'));
  }

  public function create()

  {

    return view('products.create');

  }

  public function store()

  {

    $rules = array(
      'name'       => 'required',
      'price' => 'required|numeric'
    );

    $messages = [
      'name.required'    => 'O nome é necessário.',
      'price.required'    => 'O preço é necessário.',
      'numeric'    => 'O preço só aceita digitos numerais.'
    ];

    $validator = Validator::make(request()->all(), $rules, $messages);

    // process the login
    if ($validator->fails()) {
      return redirect('produtos/adicionar')
      ->withErrors($validator);
    } else {

      Product::create([
        'name' => request('name'),
        'price' => request('price'),
        'stock' => '0'
      ]);

      return redirect('produtos');
    }
  }

  public function edit($id)
  {
    $product = Product::findOrFail($id);
    return view('products.edit')->with('product', $product);
  }

  public function update($id)
  {
    $rules = array(
      'name'       => 'required',
      'price' => 'required|numeric'
    );

    $messages = [
      'name.required'    => 'O nome é necessário.',
      'price.required'    => 'O preço é necessário.',
      'numeric'    => 'O preço só aceita digitos numerais.'
    ];

    $validator = Validator::make(request()->all(), $rules, $messages);

    // process the login
    if ($validator->fails()) {
      return redirect('produto/' . $id . '/editar')
      ->withErrors($validator);
    } else {
      // store
      $product = Product::find($id);
      $product->name       = request()->get('name');
      $product->price      = request()->get('price');
      $product->save();

      return redirect('produtos');
    }

  }


  public function destroy($id){
    Product::destroy($id);
    return redirect('/produtos');
  }



}
