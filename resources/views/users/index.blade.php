@extends('layouts.master')

@section('content')
  <div>
    <h1>Lista de Usuários</h1>
    <hr>
    <div class="container">
      <div class="row">
        <form method="GET" class="input-group" action="/clientes/pesquisar">
          <input type="text" id="search" name="search" class="form-control"
          placeholder="Digite o nome do cliente" />
          <span class="input-group-btn">
            <button type="submit" class="btn btn-success" type="button">
              <span class="fa fa-search fa-fw" aria-hidden="true"></span>
            </button>
          </span>
        </form>
      </div>
    </div>
    <br>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Username ID</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
          <tr>
            <td>
              {{ $user->name . " " . $user->surname }}
            </td>
            <td>
              {{ $user->username }}
            </td>
            <td>
              <div class="form-group">
                <form action="/cliente/{{$client->id}}/bind" method="POST">
                  {{csrf_field()}}
                  <input type="hidden" name="id" value="{{$client->id}}" />
                  <input type="hidden" name="user_id" value="{{$user->id}}" />
                  <button type="submit" class="btn btn-success linkbutton button-panel" target="blank" title="Vincular">
                    <span class="fa fa-plus fa-fw" aria-hidden="true"></span>
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
