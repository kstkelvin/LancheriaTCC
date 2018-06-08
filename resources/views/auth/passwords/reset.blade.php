@extends('layouts.master')

@section('content')
  <br>
  <div class="album">
    <div class="container">
      <div class="row form-body">
        <div class="col-md-4">
          <div class="card-body card mb-4 box-shadow">
            <form class="form-horizontal form-signin" method="POST" action="/reset">
              <div class="text-center mb-4">
                <h1 class="h5 mb-1 font-weight-normal">Recuperação de Senha - Etapa Final</h1>
                <p class="mb-0" id="email">{{$user->email}}</p>
              </div>
              {{ csrf_field() }}
              <div class="form-group">
                <div class="form-label-group">
                  <input type="hidden" name="email" value="{{$user->email}}"></input>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <label for="password" class="bmd-label-floating">Nova Senha</label>
                  <input id="password" type="password" class="form-control" name="password" required>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <label for="password-confirm" class="bmd-label-floating">Repita a nova senha</label>
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
              </div>
              <div class="form-group">
                <button class="btn btn-lg btn-primary btn-block fm-button" type="submit">Alterar Senha</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
