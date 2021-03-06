@extends('layouts.master')

@section('content')
  <br>
  <div class="album">
    <div class="container">
      <div class="row form-body">
        <div class="col-lg-8">
          <div class="card-body card mb-1 box-shadow">
            <form method="POST" action="/prosseguir" class="form-horizontal">
              {{ csrf_field() }}
              <fieldset>
                <div class="mb-3 text-center">
                  <h1 class="h4 font-weight-normal">Recuperação de Senha - Pergunta Customizada</h1>
                  <p class="text-muted" style="font-size:11px;">
                    Em caso de perca frequente de senhas, sugerimos que você realize este passo.
                    <br>
                    (Requerido para recuperação de senha)
                  </p>
                </div>
                <div class="panel-body">
                  <div class="form-group">
                    <div class="form-label-group">
                      <label for="custom_quest" class="bmd-label-floating">Pergunta</label>
                      <input type="text" id="custom_quest" name="custom_quest" class="form-control" required autofocus>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group">
                      <label for="custom_quest_answer" class="bmd-label-floating">Resposta</label>
                      <input type="text" class="form-control" id="custom_quest_answer" name="custom_quest_answer" required autofocus>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group">
                      <label for="password" class="bmd-label-floating">Senha</label>
                      <input type="password" id="password" name="password" class="form-control" required autofocus>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-lg btn-primary btn-block fm-button" title="Adicionar pergunta customizada">
                      Prosseguir
                    </button>
                  </div>
                </div>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
