@extends('layouts.master')

@section('content')
  <section class="jumbotron text-center">
    <div class="container">
      <h1 class="jumbotron-heading">LH Manager</h1>
      <p class="lead text-muted">Gerenciamento da Lancheria do Hospital São Jerônimo</p>
      @if(Auth::check())
      <p>
        <a href="#" class="btn btn-primary">Nova Venda</a>
        <a href="#" class="btn btn-success">Estatísticas</a>
      </p>
      @endif
    </div>
  </section>
@endsection
