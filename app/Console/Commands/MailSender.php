<?php

namespace App\Console\Commands;

use App\Client;
use App\Item;
use App\User;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;



class MailSender extends Command
{
  /**
  * The name and signature of the console command.
  *
  * @var string
  */
  protected $signature = 'send:mail';

  /**
  * The console command description.
  *
  * @var string
  */
  protected $description = 'E-mails a cada trinta minutos.';

  /**
  * Create a new command instance.
  *
  * @return void
  */
  public function __construct()
  {
    parent::__construct();
  }

  /**
  * Execute the console command.
  *
  * @return mixed
  */
  public function handle()
  {
    // calculate new statistics
    $posts = Client::join('items', 'clients.id', '=', 'items.client_id')
    ->join('products', 'products.id', '=', 'items.product_id')
    ->select('clients.id as id',
    'clients.name as nome',
    'clients.surname as sobrenome',
    'clients.user_id as usuario'
    )
    ->where('items.created_at', '<', Carbon::now()->startOfMonth())
    ->where('is_paid', '=', '0')
    ->where('clients.user_id', '!=', 'NULL')
    ->groupBy('clients.id')
    ->orderBy('nome')
    ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
    ->get();

    // update statistics table
    foreach($posts as $post)
    {

      if($post->usuario != null){
        $total = Item::join('products', 'products.id', '=', 'items.product_id')
        ->select(DB::raw('sum(products.price * items.amount) AS total'))
        ->where('items.client_id', '=', $id)
        ->where('items.is_paid', '=', '0')
        ->getQuery()
        ->get()
        ->first();

        $user = User::findOrFail($post->user_id);

        $text = $user->name.', estamos enviando este e-mail para lhe alertar de que'
        .'você possui um débito de '.$total->total.'R$ na sua conta da lancheria.'
        .'É de vital importância que compareça para efetuar o pagamento do mesmo o mais rápido possível.';

        Mail::raw($text ,function ($message) use ($user, $text)
        {
          $message->to($user->email)->subject('Cobrança');
          $message->from('lancheriahospitalsj.cobrancas@gmail.com', 'Lancheria do Hospital');
          //
        });
      }
    }
    
  }

}
