<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

  public function __construct()
  {
    $this->middleware('guest');
  }

  public function email()
  {
    return view('auth.passwords.email');
  }


  public function email_check()
  {
    $user = User::where('email', '=', request('email'))
    ->get()
    ->first();
    if($user != null){
      if($user->custom_quest != null){
        return $this->quest($user);
      }
      return redirect('/login')->withErrors('O e-mail foi encontrado. Entretanto, você não adicionou
      a pergunta de recuperação de senha. Contate o administrador do sistema caso você seja um funcionário
      do hospital.');
    }
    return redirect('/login')->withErrors('Este e-mail não consta no nosso servidor.');
  }

  public function quest($user)
  {
    return view('auth.passwords.confirm')->with('user', $user);
  }

  public function confirm_quest()
  {
    $user = User::where('email', '=', request('email'))
    ->get()
    ->first();
    if(request('custom_quest_answer') == $user->custom_quest_answer){
        return $this->reset($user);
    }
    return redirect('/email')
    ->withErrors('Resposta incorreta. Lembre-se de que o sistema
    diferencia entre maiúsculas e minúsculas.');
  }

  public function reset($user)
  {
    return view('auth.passwords.reset')->with('user', $user);
  }

  public function confirm_reset()
  {
    $rules = [
      'password' => 'required|min:8|confirmed',
    ];
    $messages = [
      'required' => 'Você deve preencher todos os campos.',
      'min' => 'A senha requer no mínimo oito dígitos.',
      'confirmed' => 'Você deve confirmar a sua senha.',
    ];
    $this->validate(request(), $rules, $messages);

    $user = User::where('email', '=', request('email'))
    ->get()
    ->first();
    $user->password = bcrypt(request('password'));
    $user->save();
    return redirect('/login')->with('success', 'Senha alterada com sucesso!');
  }


}
