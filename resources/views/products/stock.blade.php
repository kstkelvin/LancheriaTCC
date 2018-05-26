@extends('layouts.master')
@section('content')
  <br>
  <div class="container">
    <div class="row form-body">
      <div class="col-md-6">
        <div class="card-body card mb-6 box-shadow">
          <form method="post" action="/produto/{{$product->id}}/armazem" class="form-horizontal">
            {{csrf_field()}}
            <fieldset>
              <div>
                <div class="text-center mb-4">
                  <h1 class="h2 mb-3 font-weight-normal">{{$product->name}} - Estoque</h1>
                  {{ 'Quantia atual: '. $product->stock}}
                </div>
                <div>
                  <div class="form-group">
                    <div class="form-label-group">
                      <input type="number" class="form-control " id="stock" placeholder="Quantia a ser adicionada"
                      name="stock" required autofocus>
                    </div>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block " type="submit">Adicionar ao Estoque</button>
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
