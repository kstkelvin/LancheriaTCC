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
                      <input type="password" class="form-control" id="current-password" placeholder="Senha Atual"
                      name="current-password" minlength="8" required autofocus>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group">
                      <input type="password" class="form-control" id="password" placeholder="Nova senha"
                      name="password" minlength="8" required autofocus>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group">
                      <input type="password" class="form-control" id="password_confirmation" placeholder="Repita a nova senha"
                      name="password_confirmation" minlength="8" required autofocus>
                    </div>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block"  type="submit">Alterar Senha</button>
                  </div>
                </div>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
