
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">

  @if(Auth::check())

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="true" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand mr-auto ml-3" href="#">LHManager</a>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active d-flex justify-content-center">
          <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item d-flex justify-content-center">
          <a class="nav-link" href="/clientes">Clientes</a>
        </li>
        <li class="nav-item d-flex justify-content-center">
          <a class="nav-link" href="/produtos">Produtos</a>
        </li>
        <li class="nav-item d-flex justify-content-center">
          <a class="nav-link" href="/venda">Nova Venda</a>
        </li>
        <li class="nav-item d-flex justify-content-center">
          <a class="nav-link" href="#">Sobre</a>
        </li>
      </ul>
    </div>
    <span class="navbar-link whitecolor ml-auto smfp">{{Auth::user()->username . ", "}}</span>
    <a href="/logout" class=" whitecolor ml-1 mr-2 smfp">Sair</a>
  @else
    <div class="navbar-nav mr-auto">
      <a href="/" class="navbar-brand">LHManager</a>
    </div>
    <div class="navbar-nav ml-auto">
      <div class="nav-item">
        <a href="/login" class="navbar-link whitecolor smfp">Login</a>
      </div>
    </div>
    <div class="navbar-nav">
      <div class="nav-item">
        <a href="/registrar" class="navbar-link ml-2 whitecolor smfp">Cadastre-se</a>
      </div>
    </div>
  @endif

</nav>
