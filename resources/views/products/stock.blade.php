@extends('layouts.master')
@section('content')
  <h1>Produto: {{$product->name}} - Adicionar ao estoque</h1>
  <div>
    <a href="/produto/{{$product->id}}" class="btn btn-success linkbutton linkmargin button-panel" title="Voltar">
      <span class="fa fa-long-arrow-left fa-fw" aria-hidden="true"></span> Produto: {{$product->name}}
    </a>
  </div>
  <br>
  <hr>
  <br>
  <form method="post" action="/produto/{{$product->id}}/armazem" class="form-horizontal">
    {{csrf_field()}}

    <fieldset>
      <div class="form-group">
        <label for="stock" class="col-lg-2 control-label">Quantia</label>
        <div class="col-lg-10">
          <input type="number" class="form-control" id="stock"
          name="stock" required>
          <br>
        </div>
      </div>

      <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
          <button type="reset" class="btn btn-default">Limpar</button>
          <button type="submit" class="btn btn-primary">Adicionar ao Estoque</button>
        </div>
      </div>
    </fieldset>
  </form>
</div>
@endsection
