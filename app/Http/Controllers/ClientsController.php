<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Item;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ClientsController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {

    $clients = Client::orderBy('name')->get();
    return view('clients.index', compact('clients'));

  }

  public function bind()
  {
    $client = Client::findOrFail($id);
    return view('users.index')->with('client', $client);
  }


  public function search()
  {
    $clients = Client::where('name', 'like', '%'. request()->search .'%')
    ->orWhere('surname', 'like', '%'. request()->search .'%')
    ->orderBy('name')->get();

    return view('clients.index', compact('clients'));
  }

  public function create()
  {
    return view('clients.create');
  }

  public function store(Request $request)
  {
    $rules = array
    (
      'name'       => 'required',
      'surname'    => 'nullable',
      'setor'      => 'required',
      'phone_number' => 'nullable|numeric',
      'email' => 'nullable'
    );

    $messages = [
      'name.required'    => 'O nome é um atributo necessário.',
      'setor.required'    => 'O setor é um atributo necessário.',
      'numeric'    => 'O número de telefone só aceita digitos numerais.'
    ];

    $validator = Validator::make(request()->all(), $rules, $messages);


    if ($validator->fails()) {
      return redirect('clientes/adicionar')
      ->withErrors($validator);
    }
    else{
      $numero_formatado = $this->formatar_telefone_br(request()->get('phone_number'));
      if($numero_formatado == "0"){
        $numero_formatado = "-";
      }
      $client = Client::create([
        'name' => request('name'),
        'surname' => request('surname'),
        'setor' => request('setor'),
        'phone_number' => $numero_formatado,
        'email' => request('email'),
        'total' => '0.0'
      ]);
      return redirect('clientes');
    }
  }

  public function show($id)

  {
    $client = Client::findOrFail($id);
    if($client->user_id != 0){
      $user = User::findOrFail($client->user_id);
    }
    $items = Item::join('products', 'products.id', '=', 'items.product_id')
    ->select('products.name as name',
    'products.price as price',
    'items.amount as amount',
    'items.created_at',
    'items.id as id')
    ->where('client_id', '=', $id)
    ->where('is_paid', '=', '0')
    ->orderBy('updated_at')
    ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
    ->get();
    $total = $this->total($client->id);
    if($client->user_id != 0){
      return view('clients.show', compact('client', 'items', 'total', 'user'));
    }else
    return view('clients.show', compact('client', 'items', 'total'));
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $client = Client::findOrFail($id);
    return view('clients.edit')->with('client', $client);
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update($id)
  {
    $rules = array(
      'name'       => 'required',
      'surname'    => 'nullable',
      'setor'      => 'required',
      'phone_number' => 'nullable|numeric',
      'email'     => 'nullable',
    );

    $messages = [
      'name.required'    => 'O nome é um atributo necessário.',
      'setor.required'    => 'O setor é um atributo necessário.',
      'numeric'    => 'O número de telefone só aceita digitos numerais.'
    ];

    $validator = Validator::make(request()->all(), $rules, $messages);

    // process the login
    if ($validator->fails()) {
      return redirect('clientes/' . $id . '/editar')
      ->withErrors($validator);
    } else {
      // store
      $client = Client::find($id);
      $client->name         = request()->get('name');
      $client->surname      = request()->get('surname');
      $client->setor        = request()->get('setor');
      $numero_formatado = $this->formatar_telefone_br(request()->get('phone_number'));
      if($numero_formatado == "0"){
        $numero_formatado = "-";
      }
      $client->phone_number = $numero_formatado;
      $client->email = request()->get('email');
      $client->save();

      return redirect('clientes');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    //public function destroy($id)
    //{

    //}
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

  function formatar_telefone_br($phone_number) {

    // Checar se ja' estÃ¡ no padrao
    if (preg_match('/^\+55 \([\d]{2}\) ([\d]{4})\-([\d]{4})$/i', $phone_number)) {
      return $phone_number;
    }

    $len = strlen($phone_number);

    // Buscar apenas os numeros
    $total_numeros = 0;
    $numeros = '';
    for ($i = 0; $i < $len; $i++) {
      $c = $phone_number[$i];
      if (ctype_digit($c)) {
        $numeros .= $c;
        $total_numeros += 1;
      }
    }

    // Analisar de acordo com quantidade de numeros informados
    switch ($total_numeros) {

      case 13:
      if (preg_match('/^(55)([\d]{2})([\d]{5})([\d]{4})$/', $numeros, $match)) {
        return sprintf('+%02d (%02d) %05d-%04d', $match[1], $match[2], $match[3], $match[4]);
      } elseif (preg_match('/^[\d]{2}([\d]{2})([\d]{5})([\d]{4})$/', $numeros, $match)) {
        return sprintf('+55 (%02d) %05d-%04d', $match[1], $match[2], $match[3]);
      }
      return false;

      case 12:
      if (preg_match('/^(55)([\d]{2})([\d]{4})([\d]{4})$/', $numeros, $match)) {
        return sprintf('+%02d (%02d) %04d-%04d', $match[1], $match[2], $match[3], $match[4]);
      }
      return false;

      case 11:
      if (preg_match('/^([\d]{2})([\d]{5})([\d]{4})$/', $numeros, $match)) {
        return sprintf('+%02d (%02d) %04d-%04d', 55, $match[1], $match[2], $match[3]);
      }
      return false;

      case 10:
      if (preg_match('/^([\d]{2})([\d]{4})([\d]{4})$/', $numeros, $match)) {
        return sprintf('+%02d (%02d) %04d-%04d', 55, $match[1], $match[2], $match[3]);
      }
      return false;

      case 9:
      if (preg_match('/^([\d]{5})([\d]{4})$/', $numeros, $match)) {
        return sprintf('+%02d (%02d) %05d-%04d', 55, 51, $match[1], $match[2]);
      }
      return false;

      case 8:
      if (preg_match('/^([\d]{4})([\d]{4})$/', $numeros, $match)) {
        return sprintf('+%02d (%02d) %04d-%04d', 55, 51, $match[1], $match[2]);
      }
      return false;
    }
    return false;
  }

  public function destroy($id)
  {
    Client::destroy($id);
    return redirect('/clientes');
  }

}
