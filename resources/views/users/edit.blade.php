@extends('layouts.master')

@section('content')
  <br>
  <div class="container">
    <div class="row form-body">
      <div class="col-md-6">
        <div class="card-body card mb-4 box-shadow">
          <form method="POST" action="/editar" class="form-horizontal">
            {{ csrf_field() }}
            <fieldset>
              <div class="text-center mb-4">
                <h1 class="h2 mb-3 font-weight-normal">Edição de dados</h1>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <label for="name" class="bmd-label-floating">Nome</label>
                  <input type="text" class="form-control" id="name"
                  name="name" required autofocus>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <label for="surname" class="bmd-label-floating">Sobrenome</label>
                  <input type="text" class="form-control" id="surname" name="surname"
                  autofocus>
                </div>
              </div>

              <div class="form-group">
                <button class="btn btn-lg btn-primary btn-block fm-button" type="submit">Editar</button>
              </div>

            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
