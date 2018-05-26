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

class MailController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function send(Request $request)
  {
    $total = Item::join('products', 'products.id', '=', 'items.product_id')
    ->select(DB::raw('sum(products.price * items.amount) AS total'))
    ->where('items.client_id', '=', $id)
    ->where('items.is_paid', '=', '0')
    ->getQuery()
    ->get()
    ->first();

    Mail::send(['text'=>'emails.send'],['name', 'Kelvin'],function ($message)
    {
      $message->to('kstkelvin2@gmail.com')->subject('Cobrança');
      $message->from('lancheriahospitalsj.cobrancas@gmail.com', 'Lancheria do Hospital São Jerônimo');
    });
  }

}
