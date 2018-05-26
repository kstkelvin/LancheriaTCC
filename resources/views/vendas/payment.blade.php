@extends('layouts.master')

@section('content')
  <br>
  <div class="album">
    <div class="container">
      <div class="row form-body">
        <div class="col-md-12">
          <div class="card-body card mb-4 box-shadow">
            <div class="text-center">
              <h1 class="h3 mb-3 font-weight-normal">O pagamento foi realizado com sucesso.</h1>
              <p>Confira os dados da nota fiscal (homologada) abaixo.</p>
              <br>
              <object data="/pagamento/abrir" type="application/pdf" width="100%" height="1000px">
                <iframe src="/pagamento/abrir" width="100%" height="100%" style="border: none;">
                  Este browser não suporta PDFs. <a href="/pagamento/abrir">Download PDF</a>
                </iframe>
              </object>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
