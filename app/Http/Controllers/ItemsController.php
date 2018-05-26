<?php

namespace App\Http\Controllers;

use App\Item;
use App\Client;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\NFeController;
use Illuminate\Support\Facades\File;

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
      'client_id.required'    => 'Selecione um cliente.',
      'product_id.required'    => 'Selecione um produto.',
      'amount.required'    => 'A quantidade é necessária.',
      'numeric'    => 'O campo quantidade só aceita números.'
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
          'is_paid' => 0,
          'total' => request('amount') * $product->price
        ]);

        $product->stock -= request('amount');
        $product->save();

        $client = Client::findOrFail(request('client_id'));
        $client->total += (request('amount') * $product->price);
        $client->save();

        return redirect('/')->with('success','A operação de venda foi realizada com sucesso.');

      }

    }

  }

  function edit(){
    $client = Client::findOrFail(request('id'));
    if(request('payment_option') == 2){
      NFeController::create(request('payment'));
      $client->total -= request('payment');
      $client->save();
      return redirect('pagamento')->with('success','O(a) cliente '. $client->name . 'pagou uma quantia parcial de ' . request('payment'). 'R$ com sucesso.');
    }else{
      NFeController::create($client->total);
      $client->total = 0.00;
      $client->save();
      Item::where('client_id', '=', request('id'))
      ->where('is_paid', '=', '0')
      ->update(['is_paid' => '1']);
      return redirect('pagamento')->with('success','O pagamento do(a) cliente '. $client->name . 'foi realizado com sucesso.');
    }
  }

  public function payment(){
    return view('vendas.payment');
  }

  public function open(){
    header('Content-Type: application/pdf');
    echo File::get(storage_path('nota.pdf'));
  }

  public function destroy($id){
    $item = Item::findOrFail($id);
    if($item->is_paid == 0){
      $client->total -= $item->total;
    }
    $client->save();
    Item::destroy($id);
    return redirect('clientes')->with('success','O item foi excluído da lista com sucesso.');
  }

}
