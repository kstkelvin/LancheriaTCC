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
      </div>
    </section>
  </main>
@endsection
