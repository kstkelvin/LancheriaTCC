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

class ProductStatsController extends Controller
{
  public function statsProduct($id)
  {
    # code...
  }
  public function stats()
  {
    $alltimehigh = Product::join('items', 'products.id', '=', 'items.product_id', 'left outer')
    ->select('products.name as name',
    DB::raw('coalesce(sum(items.amount), 0) as counter'))
    ->groupBy('products.id')
    ->orderBy('counter', 'desc')
    ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
    ->take(5)
    ->get();

    $alltimelow = Product::join('items', 'products.id', '=', 'items.product_id', 'left outer')
    ->select('products.name as name',
    DB::raw('coalesce(sum(items.amount), 0) as counter'))
    ->groupBy('products.id')
    ->orderBy('counter', 'asc')
    ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
    ->take(5)
    ->get();

    $monthhigh = Product::join('items', 'products.id', '=', 'items.product_id', 'left outer')
    ->select('products.name as name',
    DB::raw('coalesce(sum(items.amount), 0) as counter'))
    ->where('items.created_at', '>', Carbon::now()->startOfMonth())
    ->groupBy('products.id')
    ->orderBy('counter', 'desc')
    ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
    ->take(5)
    ->get();

    $highkers = Client::join('items', 'clients.id', '=', 'items.client_id', 'left outer')
    ->join('products', 'products.id', '=', 'items.product_id', 'left outer')
    ->select('clients.name as name',
    DB::raw('coalesce(sum(products.price * items.amount),0) AS total'))
    ->where('items.is_paid', '=', '0')
    ->groupBy('clients.id')
    ->orderBy('total', 'desc')
    ->getQuery()
    ->take(5)
    ->get();

    $dopeflow = Client::join('items', 'clients.id', '=', 'items.client_id', 'left outer')
    ->join('products', 'products.id', '=', 'items.product_id', 'left outer')
    ->select('clients.name as name',
    DB::raw('coalesce(sum(products.price * items.amount), 0) AS total'))
    ->groupBy('clients.id')
    ->orderBy('total', 'desc')
    ->getQuery()
    ->take(5)
    ->get();

    return view('stats.demo', compact('alltimehigh', 'alltimelow', 'monthhigh', 'highkers', 'dopeflow'));
  }

}
