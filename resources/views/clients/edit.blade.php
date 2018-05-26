@extends('layouts.master')

@section('content')
<br>
  <div class="container">
    <div class="row form-body">
      <div class="col-md-6">
        <div class="card-body card mb-6 box-shadow">
          <form method="post" action="/cliente/{{$client->id}}">
            {{csrf_field()}}
            <fieldset>
              <div>
                <div class="text-center mb-4">
                  <h1 class="h2 mb-3 font-weight-normal">Editar: {{$client->name . " " . $client->surname}}</h1>
                </div>
                <div class="panel-body">
                  <div class="form-group">
                    <div class="form-label-group">
                      <input type="text" class="form-control " id="name" placeholder="Nome"
                      name="name" required autofocus>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group">
                      <input type="text" class="form-control " id="surname" name="surname"
                      placeholder="Sobrenome(Opcional)" autofocus>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="form-label-group">
                      <select name="setor" class="form-control " id="setor" required autofocus>
                        <option disabled selected value>Setor</option>
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
                  </div>

                  <div class="form-group">
                    <div class="form-label-group">
                      <input type="number" class="form-control " id="phone_number" name="phone_number"
                      placeholder="Número de Telefone(Opcional)" autofocus>
                    </div>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block " type="submit">Editar</button>
                  </div>
                </div>
              </div>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
