@extends('layouts.master')

@section('content')
  <br>
  <div class="album">
    <div class="container">
      <div class="row form-body">
        <div class="col-lg-4">
          <div class="card-body card mb-1 box-shadow">
            <form method="POST" action="/registrar" class="form-horizontal form-signin">
              {{ csrf_field() }}
              <fieldset>
                <div class="text-center mb-0">
                  <h1 class="h3 font-weight-normal">Cadastro</h1>
                </div>
                <div class="panel-body">
                  <div class="form-group">
                    <div class="form-label-group">
                      <label for="email" class="bmd-label-floating">E-mail</label>
                      <input type="email" class="form-control " id="email" name="email" required autofocus>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group">
                      <label for="name" class="bmd-label-floating">Nome</label>
                      <input type="text" id="name" name="name" class="form-control" required autofocus>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group">
                      <label for="surname" class="bmd-label-floating">Sobrenome</label>
                      <input type="text" class="form-control" id="surname" name="surname" autofocus>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group">
                      <label for="password" class="bmd-label-floating">Senha</label>
                      <input type="password" class="form-control " id="password" name="password" minlength="8" required autofocus>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group">
                      <label for="password_confirmation" class="bmd-label-floating">Confirme a Senha</label>
                      <input type="password" class="form-control " id="password_confirmation"
                      name="password_confirmation" minlength="8" maxlenght="40" required autofocus>
                    </div>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block fm-button" type="submit">Cadastrar</button>
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
