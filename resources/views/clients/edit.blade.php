@extends('layouts.master')

@section('content')
  <h1>Cliente: {{$client->name . " " . $client->surname}} - Editar</h1>
  <hr>
  <form method="post" action="/cliente/{{$client->id}}">
    {{csrf_field()}}
    <fieldset>
      <div class="form-group">
        <label for="name" class="col-lg-2 control-label">Nome</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" id="name" placeholder="Nome"
          name="name" required>
          <br>
        </div>
      </div>
      <div class="form-group">
        <label for="surname" class="col-lg-2 control-label">Sobrenome</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" id="surname" name="surname"
          placeholder="Sobrenome(Opcional)">
          <br>
        </div>
      </div>

      <div class="form-group">
        <label for="setor" class="col-lg-2 control-label">Setor</label>
        <div class="col-lg-10">
          <select name="setor" class="form-control" id="setor" required>
            <option disabled selected value>Selecione o setor</option>
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
          <br>
        </div>
      </div>

      <div class="form-group">
        <label for="phone_number" class="col-lg-2 control-label">Telefone</label>
        <div class="col-lg-10">
          <input type="number" class="form-control" id="phone_number" name="phone_number"
          placeholder="(Opcional)">
          <br>
        </div>
      </div>

      <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
          <button type="reset" class="btn btn-default">Cancelar</button>
          <button type="submit" class="btn btn-primary">Editar</button>
        </div>
      </div>
    </fieldset>
  </form>
@endsection
