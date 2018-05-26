@extends('layouts.master')

@section('content')
<br>
  <div class="container">
    <div class="row form-body">
      <div class="col-md-6">
        <div class="card-body card mb-6 box-shadow">
          <form method="POST" action="/produtos" class="form-horizontal">
            {{ csrf_field() }}
            <fieldset>
              <div>
                <div class="text-center mb-4">
                  <h1 class="h2 mb-3 font-weight-normal">Cadastro de Produtos</h1>
                </div>
                <div class="panel-body">

                  <div class="form-group">
                    <div class="form-label-group">
                      <input type="text" class="form-control" id="name" placeholder="Nome"
                      name="name" required autofocus>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="form-label-group">
                      <input type="number" pattern="[0-9]+([,\.][0-9]+)?" min="0" step="any" class="form-control" id="price" size="99"
                      placeholder="Preço" name="price" required autofocus>
                    </div>
                  </div>

                  <div class="form-group">
                    <button class="btn btn-lg btn-success btn-block " type="submit">Cadastrar</button>
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
