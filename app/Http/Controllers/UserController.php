<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Item;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }






  public function edit()
  {
    return view('users.edit')->with('user', Auth::user());
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update()
  {
    $rules = array(
      'name'       => 'required',
      'surname'    => 'nullable',
    );

    $messages = [
      'name.required'    => 'O nome é um atributo necessário.',
    ];

    $validator = Validator::make(request()->all(), $rules, $messages);

    // process the login
    if ($validator->fails()) {
      return redirect('/editar')
      ->withErrors($validator);
    } else {
      // store
      $user = Auth::user();
      $user->name         = request()->get('name');
      $user->surname      = request()->get('surname');
      $user->save();

      return redirect('/');
    }

  }

}
