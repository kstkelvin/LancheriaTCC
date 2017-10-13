<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use Illuminate\Support\Facades\Validator;

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
          Client::create([
            'name' => request('name'),
            'surname' => request('surname'),
            'setor' => request('setor'),
            'phone_number' => request('phone_number')
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
    public function show(Client $client)
    {
      return view('clients.show', compact('client'));
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
          return Redirect::to('clients/' . $id . '/edit')
              ->withErrors($validator);
      } else {
          // store
          $clients = Product::find($id);
          $clients->name         = request()->get('name');
          $clients->surname      = request()->get('surname');
          $clients->setor        = request()->get('setor');
          $clients->phone_number = request()->get('phone_number');
          $clients->save();

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
}
