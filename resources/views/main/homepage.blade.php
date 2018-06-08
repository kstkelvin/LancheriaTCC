@extends('layouts.master')

@section('content')
  <main role="main">
    <section class="jumbotron">
      <div class="container">
        <h1 class="jumbotron-heading text-center">LHManager</h1>
        <p class="lead text-muted text-center">Gerenciamento da Lancheria do Hospital São Jerônimo</p>
        @if(Auth::user()->custom_quest == null)
          <div class="row form-body">
            <div class="col-lg-12">
              <div class="card-body mb-4 alert alert-danger card box-shadow">
                <p style="margin-bottom: 0;">
                  Você ainda não adicionou a pergunta para a recuperação de sua conta.
                  <a href="/adicionar-pergunta" class="link-hover" title="Adicionar Pergunta">Adicionar pergunta customizada</a>.
                </p>
              </div>
            </div>
          </div>
        @endif
      </div>
      @if($count > 0)
        <h5 class="text-center">Débitos({{$count}})</h5>
        <br>
        <div class="album">
          <div class="container">
            @if($count > 3)
              <div class="row form-body justify-content-start">
              @else
                <div class="row form-body">
                @endif
                @foreach ($clientes as $cliente)
                  <div class="col-lg-4">
                    <div class="card-body mb-4 card box-shadow alert alert-danger">
                      <h6><a class="btn btn-danger btn-lg mr-4" style="padding: 2px; margin:0;" href="/cliente/{{$cliente->id}}">{{ $cliente->nome}}</a></h6>
                      <p style="padding: 0; padding-left: 2px; margin: 0;">{{"Total: " . number_format($cliente->total, 2, ',', '.') . " R$"}}</p>
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
                @endforeach
              </div>
            </div>
          </div>
        @endif
      </section>
    </main>
  @endsection
