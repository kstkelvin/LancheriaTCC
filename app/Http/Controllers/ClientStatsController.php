<?php

namespace App\Http\Controllers;

use App\Item;
use App\Client;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ClientStatsController extends Controller
{

  public function statsClient($id)
  {
    $top5 = Product::join('items', 'products.id', '=', 'items.product_id', 'left outer')
    ->select('products.name as name',
    DB::raw('coalesce(sum(items.amount), 0) as counter'))
    ->where('items.client_id','=', $id)
    ->groupBy('products.id')
    ->orderBy('counter', 'desc')
    ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.

    ->get();

  }

  public function stats(){

    $highest_rakers = Item::join('products', 'products.id', '=', 'items.product_id')
    ->join('clients', 'clients.id', '=', 'items.client_id')
    ->select('clients.name as name',
    DB::raw('coalesce(sum(products.price * items.amount), 0) AS total'))
    ->where('items.is_paid', '=', '0')
    ->groupBy('clients.id')
    ->orderBy('total', 'desc')
    ->getQuery()
    ->take(5)
    ->get();

  }

}
