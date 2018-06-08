@extends('layouts.master')

@section('content')
  <br>
  <div class="album">
    <div class="container">
      <div class="row form-body">
        <div class="col-md-4">
          <div class="card-body card mb-4 box-shadow">
            <form class="form-horizontal form-signin" method="POST" action="/confirm">
              {{ csrf_field() }}
              <div class="text-center mb-4">
                <h1 class="h5 mb-1 font-weight-normal">Recuperação de Senha -  Segunda Etapa</h1>
                <p class="mb-0" id="email">{{$user->email}}</p>
              </div>
              Pergunta: {{$user->custom_quest}}
              <div class="form-group">
                <div class="form-label-group">
                  <input type="hidden" id="email" name="email" value="{{$user->email}}">
                  <label for="custom_quest_answer" class="bmd-label-floating">Resposta</label>
                  <input type="text" id="custom_quest_answer" name="custom_quest_answer" class="form-control" required autofocus>
                </div>
              </div>
              <div class="form-group">
                <button class="btn btn-lg btn-primary btn-block fm-button" type="submit">Próxima Etapa</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
