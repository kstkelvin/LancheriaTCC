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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class LateController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {

    $count = Client::join('items', 'clients.id', '=', 'items.client_id')
    ->join('products', 'products.id', '=', 'items.product_id')
    ->select(DB::raw('count(clients) as counter'))
    ->where('items.created_at', '<', Carbon::now()->startOfMonth())
    ->where('is_paid', '=', '0')
    ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
    ->get()
    ->first();

    $clientes = Client::join('items', 'clients.id', '=', 'items.client_id')
    ->join('products', 'products.id', '=', 'items.product_id')
    ->select('clients.id as id',
    'clients.name as nome',
    'clients.surname as sobrenome',
    'clients.user_id as usuario'
    )
    ->where('items.created_at', '<', Carbon::now()->startOfMonth())
    ->where('is_paid', '=', '0')
    ->groupBy('clients.id')
    ->orderBy('nome')
    ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
    ->get();

    return view('main.homepage', compact('clientes', 'count'));

  }

  public function send($id)
  {

    $cliente = Client::findOrFail($id);
    if($cliente->user_id != null){
      $total = Item::join('products', 'products.id', '=', 'items.product_id')
      ->select(DB::raw('sum(products.price * items.amount) AS total'))
      ->where('items.client_id', '=', $id)
      ->where('items.is_paid', '=', '0')
      ->getQuery()
      ->get()
      ->first();
      $user = $this->user($cliente->user_id);
      
      $text = $user->name.', estamos enviando este e-mail para lhe alertar de que'
      .'você possui um débito de '.$total->total.'R$ na sua conta da lancheria.'
      .'É de vital importância que compareça para efetuar o pagamento do mesmo o mais rápido possível.';

      if($user != null){
        Mail::raw($text ,function ($message) use ($user, $text)
        {
          $message->to($user->email)->subject('Cobrança');
          $message->from('lancheriahospitalsj.cobrancas@gmail.com', 'Lancheria do Hospital');
          //
        });
        return redirect('/');
      }return redirect('/')->withErrors('Esta conta não foi vinculada ainda.');
    }return redirect('/')->withErrors('Deu problema grave');

    //Mail::send(['text'=>'emails.send'],['name', 'Kelvin'],function ($message)
    //{
    //$message->to('kstkelvin2@gmail.com')->subject('Cobrança');
    //$message->from('lancheriahospitalsj.cobrancas@gmail.com', 'Lancheria do Hospital São Jerônimo');
    //});
  }

  public function user($user)
  {
    $feedback = User::findOrFail($user);
    return $feedback;
  }

}
