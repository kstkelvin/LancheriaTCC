<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Item;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

  public function password()
  {
    return view('users.password');
  }

  public function change()
  {
    if (!(Hash::check(request('current-password'), Auth::user()->password))) {
      return view('users.password')->withErrors([
        'message' => 'A sua senha atual está incorreta. Tente novamente.'
      ]);
    } else if(strcmp(request('current-password'), request('password')) == 0){
      //Current password and new password are same
      return view('users.password')->withErrors([
        'message' => 'A sua nova senha não pode ser a mesma que a antiga.'
      ]);
    } else {
      $rules = [
        'current-password' => 'required|min:8',
        'password' => 'required|min:8|confirmed',
      ];
      $messages = [
        'required' => 'Você deve preencher todos os campos.',
        'min' => 'A senha requer no mínimo oito dígitos.',
        'confirmed' => 'Você deve confirmar a sua senha.',
      ];
      $this->validate(request(), $rules, $messages);
    }

    //Change Password
    $user = Auth::user();
    $user->password = bcrypt(request('password'));
    $user->save();
    return redirect("/")->with('success','Senha alterada com sucesso!');
  }

  public function quest()
  {
    return view('users.next');
  }

  public function add(){
    $rules = [
      'custom_quest' => 'required|string',
      'custom_quest_answer' => 'required|string',
    ];

    $messages = [
      'custom_quest.required' => 'Para facilitar a recuperação da sua senha no futuro
      , é necessária a inclusão da pergunta customizada.',
      'custom_quest_answer.required' => 'Para facilitar a recuperação da sua senha no futuro
      , é necessária a inclusão da resposta da pergunta customizada.',
    ];

    $this->validate(request(), $rules, $messages);

    $user = Auth::user();
    $user->custom_quest = request()->get('custom_quest');
    $user->custom_quest_answer = request()->get('custom_quest_answer');
    $user->save();

    if(Auth::user()->is_admin == true){
      return redirect('/')->with('success','Pergunta de recuperação de senha adicionada com sucesso!');
    }
    return redirect('/home')->with('success','Pergunta de recuperação de senha adicionada com sucesso!');
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

      return redirect('/')->with('success','As suas informações de usuário foram alteradas com sucesso.');
    }

  }

}
