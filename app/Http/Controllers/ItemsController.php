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
      'amount'      => 'numeric|required'
    );

    $messages = [
      'required'    => 'O campo :attribute é necessário.',
      'numeric'    => 'O campo :attribute só aceita números'
    ];

    $validator = Validator::make(request()->all(), $rules, $messages);

    if ($validator->fails()) {
      return redirect('/venda')
      ->withErrors($validator);
    } else {

      $product = Product::findOrFail(request('product_id'));
      if($product->stock < request('amount')){

        return redirect('/venda')
        ->withErrors('O estoque é incapaz de suprir tal quantia.');

      } else {

      Item::create([
        'client_id' => request('client_id'),
        'product_id' => request('product_id'),
        'amount' => request('amount'),
        'is_paid' => 0
      ]);

      $product->stock -= request('amount');
      $product->save();

      return redirect('/');

    }

    }

  }

  function edit($id){
    Item::where('client_id', '=', $id)
    ->where('is_paid', '=', '0')
    ->update(['is_paid' => '1']);

    return redirect('cliente/' . $id);
  }

  public function destroy($id){
    Item::destroy($id);
    return redirect('clientes');
  }

}
