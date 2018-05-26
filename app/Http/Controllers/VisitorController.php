<?php

namespace App\Http\Controllers;

use App\Item;
use App\Client;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\NFeController;
use Illuminate\Support\Facades\File;

class VisitorController extends Controller
{

  public function __construct(){
    $this->middleware('auth');
  }

  public function create()
  {
    $products = Product::orderBy('name')->get();
    return view('vendas.visitor', compact('products'));
  }

  public function show()
  {

    $items = Item::join('products', 'products.id', '=', 'items.product_id')
    ->select('products.name as name',
    'products.price as price',
    'items.amount as amount',
    'items.created_at',
    'items.id as id')
    ->where('client_id', '=', null)
    ->where('is_paid', '=', '0')
    ->orderBy('updated_at')
    ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
    ->get();

    $total = Item::select(DB::raw('sum(items.total) AS total'))
    ->where('client_id', '=', null)
    ->where('is_paid', '=', '0')
    ->getQuery()
    ->get()
    ->first();

    $products = Product::orderBy('name')->get();

    return view('vendas.visitor', compact('items', 'total', 'products'));
  }

  public function store()
  {

    $rules = array
    (
      'product_id'    => 'required',
      'amount'      => 'numeric|required'
    );

    $messages = [
      'product_id.required'    => 'Selecione um produto.',
      'amount.required'    => 'A quantidade é necessária.',
      'numeric'    => 'O campo quantidade só aceita números.'
    ];

    $validator = Validator::make(request()->all(), $rules, $messages);

    if ($validator->fails()) {
      return redirect('/visitantes')
      ->withErrors($validator);
    } else {

      $product = Product::findOrFail(request('product_id'));
      if($product->stock < request('amount')){

        return redirect('/visitantes')
        ->withErrors('O estoque é incapaz de suprir tal quantia.');

      } else {

        Item::create([
          'client_id' => null,
          'product_id' => request('product_id'),
          'amount' => request('amount'),
          'is_paid' => 0,
          'total' => request('amount') * $product->price
        ]);

        $product->stock -= request('amount');
        $product->save();

        return redirect('/visitantes');

      }

    }

  }

  function edit(){
    $total = Item::select(DB::raw('sum(items.total) AS total'))
    ->where('client_id', '=', null)
    ->where('is_paid', '=', '0')
    ->getQuery()
    ->get()
    ->first();
    NFeController::create($total->total);
    Item::where('is_paid', '=', '0')
    ->where('client_id', '=', null)
    ->update(['is_paid' => '1']);
    return redirect('pagamento');
  }

  public function destroy($id){
    Item::destroy($id);
    return redirect('visitantes');
  }

  public function delete(){
    Item::where('is_paid', '=', '0')
    ->where('client_id', '=', null)
    ->delete();
    return redirect('visitantes');
  }

}
