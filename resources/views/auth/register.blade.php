@extends('layouts.master')

@section('content')
  <br>
  <div class="album">
    <div class="container">
      <div class="row form-body">
        <div class="col-lg-4">
          <div class="card-body card mb-4 box-shadow">
            <form method="POST" action="/registrar" class="form-horizontal form-signin">
              {{ csrf_field() }}
              <fieldset>
                <div class="text-center mb-4">
                  <h1 class="h3 mb-3 font-weight-normal">Cadastro</h1>
                </div>
                <div class="panel-body">
                  <div class="form-group">
                    <div class="form-label-group">
                      <input type="text" id="name" name="name" class="form-control " placeholder="Nome" required autofocus>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group">
                      <input type="text" class="form-control " id="surname" name="surname" placeholder="Sobrenome(Opcional)" autofocus>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group">
                      <input type="email" class="form-control " id="email" name="email" placeholder="Endereço de e-mail" required autofocus>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group">
                      <input type="password" class="form-control " id="password" name="password" minlength="8" placeholder="Senha" required autofocus>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group">
                      <input type="password" class="form-control " id="password_confirmation"
                      name="password_confirmation" minlength="8" maxlenght="40" placeholder="Repita a senha" required autofocus>
                    </div>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Cadastrar</button>
                  </div>
                </div>
              </fieldset>
              <p class="intro-login">Já possui uma conta? <a href="/login">Faça o seu login!</a></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
