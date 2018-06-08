<?php

namespace App\Http\Controllers;
use App\Client;
use App\User;
use App\Item;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BindController extends Controller
{

  public function index($id)
  {
    $client = Client::findOrFail($id);
    $users = User::where('is_admin', '=', false)
    ->where('has_account', '=', false)
    ->orderBy('name')->get();
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

  public function show(){
    $client = Client::where('user_id', '=', Auth::user()->id)->get()->first();
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
      return redirect('/home')->withErrors('Sentimos muito, mas esta conta ainda não foi vinculada.
      Se você for um funcionário do hospital, contate o administrador do sistema ou a dona da lancheria.');
    }
  }

  public function home()
  {
    $client = Client::where('user_id', '=', Auth::user()->id)->get()->first();
    $counter = 0;
    $total = 0;
    if($client != null){
      $counter = Item::join('products', 'products.id', '=', 'items.product_id')
      ->select(DB::raw('items.client_id AS itens'))
      ->where('items.client_id', '=', $client->id)
      ->where('items.is_paid', '=', '0')
      ->where('items.created_at', '<', Carbon::now()->startOfMonth())
      ->getQuery()
      ->get()
      ->first();
      $counter = count('itens');
      $total = $this->total($client->id);
    }
    return view('main.home', compact('total', 'counter'));
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

  public function history()
  {
    $client = Client::where('user_id', '=', Auth::user()->id)->get()->first();
    if($client){
      $items = Item::join('products', 'products.id', '=', 'items.product_id')
      ->select('products.name as name',
      'items.amount as amount',
      'items.created_at',
      'items.is_paid as pago',
      'items.id as id')
      ->where('client_id', '=', $client->id)
      ->orderBy('updated_at')
      ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
      ->get();
      return view('users.history', compact('client', 'items'));
    }else{
      return redirect('/home')->withErrors('Sentimos muito, mas esta conta ainda não foi vinculada.
      Se você for um funcionário do hospital, contate o administrador do sistema ou a dona da lancheria.');
    }
  }

  public function destroy($id)
  {

  }
}
