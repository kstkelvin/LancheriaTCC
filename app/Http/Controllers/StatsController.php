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
use Charts;

class StatsController extends Controller
{
  public function statsProduct($id)
  {
    # code...
  }

  public function stats()
  {
    $product_chart_a = Product::join('items', 'products.id', '=', 'items.product_id', 'left outer')
    ->select('products.name as name',
    DB::raw('coalesce(sum(items.amount), 0) as counter'))
    ->groupBy('products.id')
    ->orderBy('counter', 'desc')
    ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
    ->take(5)
    ->get();

    $product_chart_b = Product::join('items', 'products.id', '=', 'items.product_id', 'left outer')
    ->select('products.name as name',
    DB::raw('coalesce(sum(items.amount), 0) as counter'))
    ->groupBy('products.id')
    ->orderBy('counter', 'asc')
    ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
    ->take(5)
    ->get();

    $product_chart_c = Product::join('items', 'products.id', '=', 'items.product_id', 'left outer')
    ->select('products.name as name',
    DB::raw('coalesce(sum(items.amount), 0) as counter'))
    ->where('items.created_at', '>', Carbon::now()->startOfMonth())
    ->groupBy('products.id')
    ->orderBy('counter', 'desc')
    ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
    ->take(5)
    ->get();

    $product_chart_d = Client::join('items', 'clients.id', '=', 'items.client_id', 'left outer')
    ->join('products', 'products.id', '=', 'items.product_id', 'left outer')
    ->select('clients.name as name',
    DB::raw('coalesce(sum(products.price * items.amount), 0) AS total'))
    ->groupBy('clients.id')
    ->orderBy('total', 'desc')
    ->getQuery()
    ->take(5)
    ->get();

    $chart1 = Charts::create('bar', 'highcharts')
    ->title('Produtos mais vendidos') // Título do gráfico
    ->labels($product_chart_a->pluck('name'))
    ->values($product_chart_a->pluck('counter'))
    ->dimensions(500, 300) // Dimensão = 500 largura x 300 altura
    ->responsive(true) // É utilizado para se adaptar ao tamanho do box que se encontra
    ->template("material")
    ->elementLabel("Top 5 Produtos vendidos"); // Legenda para o gráfico

    // Título do gráfico

    // Legenda para o gráfico

    $chart2 = Charts::create('bar', 'highcharts')
    ->title('Produtos menos vendidos')
    ->labels($product_chart_b->pluck('name'))
    ->values($product_chart_b->pluck('counter'))
    ->dimensions(500, 300) // Dimensão = 500 largura x 300 altura
    ->responsive(true) // É utilizado para se adaptar ao tamanho do box que se encontra
    ->template("material")
    ->elementLabel("Top 5 Produtos menos vendidos");

    $chart3 = Charts::create('bar', 'highcharts')
    ->title('Produtos mais vendidos do mês')
    ->labels($product_chart_c->pluck('name'))
    ->values($product_chart_c->pluck('counter'))
    ->dimensions(500, 300) // Dimensão = 500 largura x 300 altura
    ->responsive(true) // É utilizado para se adaptar ao tamanho do box que se encontra
    ->template("material")
    ->elementLabel("Produtos mais vendidos do mês");

    $chart4 = Charts::create('bar', 'highcharts')
    ->title('Top 5 Contas de clientes')
    ->labels($product_chart_d->pluck('name'))
    ->values($product_chart_d->pluck('total'))
    ->dimensions(500, 300) // Dimensão = 500 largura x 300 altura
    ->responsive(true) // É utilizado para se adaptar ao tamanho do box que se encontra
    ->template("material")
    ->elementLabel("Top 5 Contas");

    return view('stats.stats', compact('chart1', 'chart2', 'chart3', 'chart4'));

    //return $product_chart_b;
  }

}
