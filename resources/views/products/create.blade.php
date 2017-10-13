@extends('layouts.master')

@section('content')
  <section class="jumbotron text-center">
    <h1>Cadastro de Produtos</h1>
    <hr>
  </section>
    <form method="POST" action="/products">
      {{ csrf_field() }}

      <div class="form-group">
        <label for="name">Nome do Produto</label>
        <input type="text" class="form-control" id="name" placeholder="Nome"
         name="name" required>
      </div>

      <div class="form-group">
        <label for="value">Preço</label>
        <input type="number" class="form-control" id="value" size="99" step="0.01"
        placeholder="0,00" name="value" required>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary">Adicionar</button>
      </div>

      @include('layouts.errors')
@endsection
