@extends('layouts.master')

@section('content')
  <section class="jumbotron text-center">
    <div class="container">
      <h1>LH Manager</h1>
      <p class="lead text-muted">Gerenciamento da Lancheria do Hospital São Jerônimo</p>
      @if(Auth::check())
        @if(Auth::user()->access_level == 1)
          <p>
            <a href="/venda/create" class="btn btn-primary">Nova Venda</a>
          </p>
        @endif
      @endif
    </div>
  </section>
@endsection
