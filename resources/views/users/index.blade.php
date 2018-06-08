@extends('layouts.master')

@section('content')
  <br>
  <div class="album">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card-body card box-shadow">
            <h1>Lista de Usuários</h1>
            <br>
            <table class="table table-hover table-striped">
              <thead>
                <tr>
                  <th><p class="table-header-wordwrap">NOME</p></th>
                  <th><p class="table-header-wordwrap">E-MAIL</p></th>
                  <th><p class="table-header-wordwrap"></p></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                  <form id="binder_{{$client->id}}" action="/cliente/{{$client->id}}/bind" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$client->id}}" />
                    <input type="hidden" name="user_id" value="{{$user->id}}" />
                  </form>
                  <tr>
                    <td>
                      @if($user->surname != null)
                        {{ $user->name . " " . $user->surname }}
                      @else
                        {{ $user->name }}
                      @endif
                    </td>
                    <td>
                      {{ $user->email }}
                    </td>
                    <td>
                      <button type="submit" form="binder_{{$client->id}}" formmethod="POST" class="btn btn-secondary button-link button-panel" target="blank" title="Vincular">
                        <span class="fa fa-plus fa-fw" aria-hidden="true"></span>
                      </button>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
