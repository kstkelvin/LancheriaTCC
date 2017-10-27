<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
  @if(Auth::check())
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="true" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-nav mr-auto">
      <a href="/" class="navbar-brand ml-2">LHManager</a>
    </div>
    <div class="navbar-nav ml-auto navbar-right">
      <a class="nav-link active" href="/">{{Auth::user()->username}}</a>
    </div>
    <div class="navbar-nav">
      <div class="nav-item">

      </div>
    </div>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
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
        <li class="nav-item">
          <span class="nav-link"></span>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="/logout"><i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  @else
    <div class="navbar-nav mr-auto navbar-right">
      <a href="/" class="navbar-brand">LHManager</a>
    </div>
    <div class="navbar-nav ml-auto">
      <div class="nav-item">
        <a href="/login" class="nav-link">Login</a>
      </div>
    </div>
    <div class="navbar-nav">
      <div class="nav-item">
        <a href="/registrar" class="nav-link ml-2">Cadastre-se</a>
      </div>
    </div>
  @endif
</nav>
