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
  | Controller de Cadastro de Usuários
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
      'username' => 'required|string|min:6|max:40|unique:users',
      'password' => 'required|min:8|confirmed',
    ];

    $messages = [
      'username.required'    => 'O nome de usuário é necessário.',
      'password.required'    => 'A senha é necessária.',
      'username.min' => 'O nome de usuário requer no mínimo seis dígitos.',
      'password.min' => 'A senha requer no mínimo oito dígitos.',
      'max' => 'O nome de usuário não pode ter mais de quarenta dígitos.',
      'confirmed' => 'Você deve confirmar a sua senha.',
      'unique' => 'O nome de usuário já foi utilizado.'
    ];

    $this->validate(request(), $rules, $messages);

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
