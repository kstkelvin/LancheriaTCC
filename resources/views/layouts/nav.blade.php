<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">



  @if(Auth::check())

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="true" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand mr-auto ml-3" href="#">LHManager</a>
    <a href="/logout" class="nav-link ml-auto whitecolor">Logout</a>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/clientes">Clientes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/produtos">Produtos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/venda">Nova Venda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Sobre</a>
        </li>
      </ul>
    @else
      <a class="navbar-brand mr-auto ml-3" href="#">LHManager</a>
      <div class="navbar-nav navbar-right">
        <div class="nav-item">
          <a class="nav-link" href="/login">Login</a>
        </div>
        <div class="nav-item">
          <a class="nav-link" href="/registrar">Cadastre-se</a>
        </div>
      </ul>
    @endif
  </div>
</nav>
