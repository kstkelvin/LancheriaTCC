<?php

namespace App\Http\Controllers;

use App\Item;
use App\Client;
use App\Product;
use Illuminate\Http\Request;

class ItemsController extends Controller
{

  public function __construct(){
    $this->middleware('auth');
  }

  //public function index()
  //{
  //
  //}

  public function create()
  {
    $clients = Client::orderBy('name')->get();
    $products = Product::orderBy('name')->get();
    return view('vendas.create', compact('clients', 'products'));
  }

  public function store()
  {
    Item::create([
      'client_id' => request('client_id'),
      'product_id' => request('product_id'),
      'amount' => request('amount'),
      'is_pago' => 0
    ]);

    return redirect('/');
  }

  public function show($id)
  {
    $items = Item::where('client_id', '=', $id)->orderBy('updated_at')->get();
    return $items;
  }

  //public function edit(Item $item)
  //{
  //
  //}
  //public function update(Request $request, Item $item)
  //{
  //
  //}

  //public function destroy(Item $item)
  //{
  //
  //}
}
