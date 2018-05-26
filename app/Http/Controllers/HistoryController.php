<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Item;
use App\User;
use App\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
  public function show($id)

  {
    $client = Client::findOrFail($id);
    if($client->user_id != 0){
      $user = User::findOrFail($client->user_id);
    }
    $items = Item::join('products', 'products.id', '=', 'items.product_id')
    ->select('products.name as name',
    'items.amount as amount',
    'items.created_at',
    'items.is_paid as pago',
    'items.id as id')
    ->where('client_id', '=', $id)
    ->orderBy('updated_at')
    ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
    ->get();

    if($client->user_id != 0){
      return view('clients.history', compact('client', 'items', 'user'));
    }else
    return view('clients.history', compact('client', 'items'));
  }

}
