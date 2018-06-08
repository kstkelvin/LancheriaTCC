@extends('layouts.master')

@section('content')
  @if($counter > 0)
    <br>
    <div class="container">
      <div class="row form-body">
        <div class="col-md-12">
          <div class="card-body mb-0 text-center align-items-center d-flex alert alert-danger card box-shadow">
            {{"Você tem uma dívida de " . number_format($total->total, 2, ',', '.') . " R$ pendente para ser paga na lancheria. Efetue o pagamento da mesma o mais rápido possível. Obrigado."}}
          </div>
        </div>
      </div>
    </div>
  @endif
  <main role="main">
    <section class="jumbotron">
      <div class="container text-center">
        <h1 class="jumbotron-heading">LHManager</h1>
        <p class="lead text-muted">Gerenciamento da Lancheria do Hospital São Jerônimo</p>
        @if(Auth::user()->custom_quest == null)
          <div class="row form-body">
            <div class="col-lg-12">
              <div class="card-body mb-4 alert alert-danger card box-shadow">
                <p style="margin-bottom: 0;">
                  Você ainda não adicionou a pergunta para a recuperação de sua conta.
                  <a href="/adicionar-pergunta" class="link-hover" title="Adicionar Pergunta">Adicionar pergunta customizada</a>.
                </p>
              </div>
            </div>
          </div>
        @endif
      </div>
    </section>
  </main>
@endsection
