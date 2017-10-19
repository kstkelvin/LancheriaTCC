<?php

namespace App\Http\Controllers;

use App\Item;
use App\Client;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    $rules = array
    (
      'client_id'       => 'required',
      'product_id'    => 'required',
      'amount'      => 'numeric|required|min:1'
    );

    $messages = [
      'required'    => 'O campo :attribute é necessário.',
      'numeric'    => 'O campo :attribute só aceita números',
      'min' => 'O campo :attribute requer no mínimo 1'
    ];

    $validator = Validator::make(request()->all(), $rules, $messages);

    if ($validator->fails()) {
      return redirect('/venda/create')
      ->withErrors($validator);
    } else {

      Item::create([
        'client_id' => request('client_id'),
        'product_id' => request('product_id'),
        'amount' => request('amount'),
        'is_paid' => 0
      ]);

      return redirect('/');

    }

  }

  function edit($id){
    Item::where('client_id', '=', $id)
    ->where('is_paid', '=', '0')
    ->update(['is_paid' => '1']);

    return redirect('client/' . $id);
  }

}
