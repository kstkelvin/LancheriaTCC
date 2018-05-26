@extends('layouts.master')

@section('content')
  <main role="main">
    <section class="jumbotron">
      <div class="container text-center">
        <h1 class="jumbotron-heading">LHManager</h1>
        <p class="lead text-muted">Gerenciamento da Lancheria do Hospital São Jerônimo</p>
      </div>
      @if($count > 0)
        <h5 class="text-center">Débitos({{$count}})</h5>
        <br>
        <div class="album">
          <div class="container">
            <div class="row form-body">
              @foreach ($clientes as $cliente)
                @if($cliente->usuario != null)
                  <form action="/mail/{{$cliente->usuario}}" id="mailsend_dorkadory" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$cliente->usuario}}"></input>
                  </form>
                  <div class="col-lg-4">
                    <div class="card-body mb-3 card box-shadow alert alert-danger">
                      @if($cliente->nome != null)
                        <h5><a class="btn btn-danger btn-lg mr-4" style="padding: 0;" href="/cliente/{{$cliente->id}}">{{ $cliente->nome . " " . $cliente->sobrenome }}</a></h5>
                      @else
                        <h5><a class="btn btn-danger btn-lg mr-4" style="padding: 0;" href="/cliente/{{$cliente->id}}">{{ $cliente->nome}}</a></h5>
                      @endif
                      <p class="card-text">{{"Total: " . number_format($cliente->total, 2, ',', '.') . " R$"}}</p>
                      <div class="d-flex justify-content-end align-items-center">
                        <div class="form-inline">
                          <div class="btn-group">
                            <button onclick="window.location.href='/cliente/{{$cliente->id}}'" class="btn btn-sm btn-danger mr-1" title="Visualizar">
                              Visualizar
                            </button>
                            <button type="submit" form="mailsend_dorkadory" formmethod="post" class="btn btn-sm btn-danger" title="Enviar">
                              Enviar E-mail
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @else
                  <div class="col-lg-4">
                    <div class="card-body mb-3 card box-shadow alert alert-danger">
                      @if($cliente->nome != null)
                        <h6><a class="btn btn-danger btn-lg mr-4" style="padding: 0;"href="/cliente/{{$cliente->id}}">{{ $cliente->nome . " " . $cliente->sobrenome }}</a></h6>
                      @else
                        <h6><a class="btn btn-danger btn-lg mr-4" style="padding: 0;" href="/cliente/{{$cliente->id}}">{{ $cliente->nome}}</a></h6>
                      @endif
                      <p class="card-text">{{"Total: " . number_format($cliente->total, 2, ',', '.') . " R$"}}</p>
                      <div class="d-flex justify-content-end align-items-center">
                        <div class="form-inline">
                          <div class="btn-group">
                            <button onclick="window.location.href='/cliente/{{$cliente->id}}'" class="btn btn-sm btn-danger" title="Visualizar">
                              Visualizar
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @endif
              @endforeach
            </div>
          </div>
        </div>
      @endif
    </section>
  </main>
@endsection
