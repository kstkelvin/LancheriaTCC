@extends('layouts.master')

@section('content')
  <div class="marging-padding">
    <h3>Cadastro de Clientes</h3>

    <form method="POST" action="/clientes">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="name">Nome do Cliente</label>
        <input type="text" class="form-control" id="name" placeholder="Nome"
        name="name" required>
      </div>
      <div class="form-group">
        <label for="surname">Sobrenome</label>
        <input type="text" class="form-control" id="surname" name="surname"
        placeholder="Sobrenome(Opcional)">
      </div>
      <div class="form-group">
        <label for="setor">Setor</label>
        <select name="setor" class="form-control" id="setor">
          <option value="" placeholder="Setor" required></option>
          <option value="Cozinha">Cozinha</option>
          <option value="Copa">Copa</option>
          <option value="Lavanderia">Lavanderia</option>
          <option value="Higiene">Higiene</option>
          <option value="Recepção">Recepção</option>
          <option value="Centro Clínico">Centro Clínico</option>
          <option value="Farmácia">Farmácia</option>
          <option value="Administrativo">Administrativo</option>
          <option value="Recursos Humanos">Recursos Humanos</option>
          <option value="Financeiro">Financeiro</option>
          <option value="Raio X">Raio X</option>
          <option value="1° Andar">1° Andar</option>
          <option value="2° Andar">2° Andar</option>
          <option value="Maternidade">Maternidade</option>
        </select>
      </div>



      <div class="form-group">
        <label for="phone_number">Telefone</label>
        <input type="number" class="form-control" id="phone_number" name="phone_number">
      </div>

      <div class="form-group  d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Adicionar</button>
      </div>
    </div>
  @endsection
