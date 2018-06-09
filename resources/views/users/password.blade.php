@extends('layouts.master')
@section('content')
  <br>
  <div class="album">
    <div class="container">
      <div class="row form-body">
        <div class="col-md-6">
          <div class="card-body card box-shadow">
            <form method="POST" action="/senha" class="form-horizontal">
              {{ csrf_field() }}
              <fieldset>
                <div class="panel-body">
                  <div class="text-center mb-4">
                    <h1 class="h2 mb-3 font-weight-normal">Alterar a senha</h1>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group">
                      <label for="current-password" class="bmd-label-floating">Senha Atual</label>
                      <input type="password" class="form-control" id="current-password"
                      name="current-password" minlength="8" required autofocus>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group">
                      <label for="password" class="bmd-label-floating">Nova Senha</label>
                      <input type="password" class="form-control" id="password"
                      name="password" minlength="8" required autofocus>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group">
                      <label for="password_confirmation" class="bmd-label-floating">Confirme a nova senha</label>
                      <input type="password" class="form-control" id="password_confirmation"
                      name="password_confirmation" minlength="8" required autofocus>
                    </div>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block fm-button"  type="submit">Alterar Senha</button>
                  </div>
                </div>
              </fieldset>
            </form>
          </div>
          <br>
          @if(Auth::user()->custom_quest != null)
            <p class="text-center">
              <a class="intro_remember" href="/pergunta">
                Alterar a pergunta de recuperação de senha
              </a>
            </p>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection
