<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Login Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles authenticating users for the application and
  | redirecting them to your home screen. The controller uses a trait
  | to conveniently provide its functionality to your applications.
  |
  */

  use AuthenticatesUsers;

  /**
  * Where to redirect users after login.
  *
  * @var string
  */

  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct()
  {
    $this->middleware('guest', ['except' => 'destroy']);
  }

  public function create()
  {

    return view('auth.login');

  }

  public function store()
  {

    if (!auth()->attempt(request(['email', 'password'])))
    {
      return back()->withErrors([
        'message' => 'O e-mail e/ou senha foram digitados incorretamente.'
      ]);

    }
    if(Auth::user()->is_admin == true){
      return redirect('/');
    }
      return redirect('/home');
  }

  public function destroy()
  {
    //auth()->logout()->
    auth()->logout();
    session()->flush();
    session()->regenerate();
    return redirect('/login');
  }

}
