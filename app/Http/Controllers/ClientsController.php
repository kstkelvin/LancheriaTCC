<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Item;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;

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
      'phone_number' => 'nullable|numeric'
    );

    $validator = Validator::make(request()->all(), $rules);


    if ($validator->fails()) {
      return Redirect::to('clients/' . $id . '/edit')
      ->withErrors($validator);
    }
    else{
      $numero_formatado = $this->formatar_telefone_br(request()->get('phone_number'));
      if($numero_formatado == "0"){
        $numero_formatado = "Não Consta";
      }
      $client = Client::create([
        'name' => request('name'),
        'surname' => request('surname'),
        'setor' => request('setor'),
        'phone_number' => $numero_formatado,
        'total' => '0.0'
      ]);
      return redirect('clients');
    }
  }
  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $client = Client::findOrFail($id);
    //$items = Item::where('client_id', '=', $id, 'AND', 'is_pago', '=', '0')
    //->orderBy('updated_at')
    //->get();

    $items = Item::join('products', 'products.id', '=', 'items.product_id')
    ->select('products.name as name',
    'products.value as value',
    'items.amount as amount',
    'items.created_at as time')
    ->where('client_id', '=', $id, 'AND', 'is_pago', '=', '0')
    ->orderBy('updated_at')
    ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
    ->get();
    return view('clients.show', compact('client', 'items'));


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
      'phone_number' => 'nullable|numeric'
    );
    $validator = Validator::make(request()->all(), $rules);

    // process the login
    if ($validator->fails()) {
      return redirect('client/' . $id . '/edit')
      ->withErrors($validator);
    } else {
      // store
      $client = Client::find($id);
      $client->name         = request()->get('name');
      $client->surname      = request()->get('surname');
      $client->setor        = request()->get('setor');
      $numero_formatado = $this->formatar_telefone_br(request()->get('phone_number'));
      if($numero_formatado == "0"){
        $numero_formatado = "Não Consta";
      }
      $client->phone_number = $numero_formatado;
      $client->save();

      return redirect('clients');
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
}
