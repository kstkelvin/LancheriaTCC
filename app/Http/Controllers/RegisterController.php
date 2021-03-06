<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;

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
      'name' => 'required|string|max:20',
      'surname' => 'nullable|string|max:50',
      'password' => 'required|min:8|confirmed',
      'email' => 'required|unique:users',
      'custom_quest' => 'nullable|string',
      'custom_quest_answer' => 'nullable|string',
    ];

    $messages = [
      'password.required'    => 'A senha é necessária.',
      'email.required' => 'É necessária a inclusão de um endereço de e-mail.',
      'name.required'    => 'Especifique o seu nome',
      'name.max' => 'O nome não pode ter mais de trinta dígitos.',
      'surname.max' => 'O sobrenome ultrapassou a quantia tolerada de dígitos.',
      'password.min' => 'A senha requer no mínimo oito dígitos.',
      'username.max' => 'O nome de usuário não pode ter mais de quarenta dígitos.',
      'confirmed' => 'Você deve confirmar a sua senha.',
      'username.email' => 'Este endereço de e-mail já foi utilizado.'
    ];

    $this->validate(request(), $rules, $messages);

    $user = User::create([
      'name' => request('name'),
      'surname' => request('surname'),
      'email' => request('email'),
      'password' => bcrypt(request('password')),
    ]);

    auth()->login($user);
    if(Auth::user()->is_admin == true){
      return redirect('/');
    }
    return redirect('/home');

  }

  protected function create()
  {
    //encaminha o usuário para a tela de cadastro.
    return view('auth.register');
  }
}
