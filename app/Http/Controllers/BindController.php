<?php

namespace App\Http\Controllers;
use App\Client;
use App\User;
use App\Item;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class BindController extends Controller
{

  public function index($id)
  {
    $client = Client::findOrFail($id);
    $users = User::where('is_admin', '=', false)
    ->where('has_account', '=', false)
    ->orderBy('name', 'surname')->get();
    return view('users.index', compact('users'))->with('client', $client);
  }


  public function update($id)
  {
    $client = Client::find($id);
    $client->user_id = request()->get('user_id');
    $client->save();

    $user = User::find(request()->get('user_id'));
    $user->has_account = true;
    $user->save();

    return redirect('/');
  }

  public function show($id){
    $client = Client::where('user_id', '=', $id)->get()->first();
    if($client){
      $items = Item::join('products', 'products.id', '=', 'items.product_id')
      ->select('products.name as name',
      'products.price as price',
      'items.amount as amount',
      'items.created_at',
      'items.id as id')
      ->where('client_id', '=', $client->id)
      ->where('is_paid', '=', '0')
      ->orderBy('updated_at')
      ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
      ->get();
      $total = $this->total($client->id);
      return view('users.show', compact('client', 'items', 'total'));
    }else{
      return redirect('/home')->withErrors('Sentimos muito, mas esta conta ainda não foi vinculada. Aguarde ou contate a administradora da lancheria.');
    }
  }

  function total($id){
    $total = Item::join('products', 'products.id', '=', 'items.product_id')
    ->select(DB::raw('sum(products.price * items.amount) AS total'))
    ->where('items.client_id', '=', $id)
    ->where('items.is_paid', '=', '0')
    ->getQuery()
    ->get()
    ->first();
    return $total;
  }

  public function destroy($id)
  {

  }
}
