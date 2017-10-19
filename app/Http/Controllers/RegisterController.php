<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Controller de Cadastros.
  |--------------------------------------------------------------------------
  |
  */

  use RegistersUsers;

  public function __construct()
  {
    //Apenas visitantes podem ver este cadastro. Sujeito a modificações.
    $this->middleware('guest') ;
  }

  protected function store()
  {

    //autenticação dos dados do formulário. se suceder, o cadastro é completo.
    //caso contrário, o usuário será reenviado para o cadastro, e receberá
    //o feedback dos erros. (em inglês, sujeito a alteração).

    $rules = [
      'username' => 'required|string|max:60|unique:users',
      'password' => 'required|min:6|confirmed',
    ];

    $this->validate(request(), $rules);

    $user = User::create([
      'username' => request('username'),
      'password' => bcrypt(request('password'))
    ]);

    auth()->login($user);
    return redirect('/');
  }

  protected function create()
  {
    //encaminha o usuário para a tela de cadastro.
    return view('register.create');
  }
}
