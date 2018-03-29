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

  //*public function debt_makers()
  //  {
  //    $debt_makers = Client::join('items', 'clients.id', '=', 'items.client_id')
  //    ->join('products', 'products.id', '=', 'items.product_id')
  //    ->select('client.name as nome',
  //    'client.email as email',
  //    'sum(products.price * items.amount) as total',
  //    'items.id as id')
  //    ->where('items.created_at', '>', NOW()-30)
  //    ->where('is_paid', '=', '0')
  //    ->groupBy('client.id')
  //    ->orderBy('updated_at')
  //    ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
  //    ->get();

  //  foreach($debt_makers as $debt_maker){
  //  if($debt_maker->email != null){
  //    $subject = 'Táis devendo dinero, sabias?';
  //      $mailmessage = $debt_maker->nome.' , Desculpas infortuná-lo em este momento, mas você deves um caralho
  //      de dinheiro. O total é de '.$debt_maker->total.'R$. Sugiro que pagues o mais rápido possível para evitar juros adicionais.
  //      got suckas.';
  //    mail($debt_maker->email,$subject,$mailmessage);
  //    }
  //    }

  //  }

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
