<?php

namespace App\Http\Controllers;

use App\Item;
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
    return view('vendas.create');
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
