<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
  @if(Auth::check())
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="true" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-nav mr-auto">
      <a href="/" class="navbar-brand">LHManager</a>
    </div>
    <div class="navbar-nav ml-auto navbar-right">

    </div>
    <div class="navbar-nav">
      <div class="nav-item">

      </div>
    </div>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active d-flex justify-content-center">
          <a class="nav-link" href="/">{{Auth::user()->username}}<span class="sr-only">(current)</span></a>
          <li class="dropdown nav-item d-flex justify-content-center">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="#">Action</a></li>
            </ul>
          </li>
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
      <ul class="navbar-nav ml-auto">
        <li class="nav-item d-flex justify-content-center">
          <span class="nav-link mr-1"></span>
          <a class="nav-link" href="/logout">Sair</a>
        </li>
      </ul>
    </div>
  @else
    <div class="navbar-nav mr-auto navbar-right">
      <a href="/" class="navbar-brand">LHManager</a>
    </div>
    <div class="navbar-nav ml-auto">
      <div class="nav-item">
        <a href="/login" class="nav-link smfp">Login</a>
      </div>
    </div>
    <div class="navbar-nav">
      <div class="nav-item">
        <a href="/registrar" class="nav-link ml-2 smfp">Cadastre-se</a>
      </div>
    </div>
  @endif
</nav>
