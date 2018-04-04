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
  protected $signature = 'email:test';

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
    Mail::send(['text'=>'emails.test'],['name', 'Kelvin'],function ($message)
    {
    $message->to('kstkelvin2@gmail.com')->subject('Teste');
    $message->from('lancheriahospitalsj.cobrancas@gmail.com', 'Lancheria do Hospital São Jerônimo');
    });


  }

}
