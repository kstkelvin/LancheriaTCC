<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <span class="navbar-brand">LHManager</span>
    </div>
    @if(Auth::check())
      <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1" aria-expanded="false" style="height: 1px;">
        <ul class="nav navbar-nav">
          <li class="active"><a href="/">Home <span class="sr-only">(current)</span></a></li>
          <li><a href="/clientes">Clientes</a></li>
          <li><a href="/produtos">Produtos</a></li>
          <li><a href="/venda">Nova Venda</a></li>
          <li class="disabled"><a href="#">Estatísticas</a></li>
          <li class="disabled"><a href="#">Sobre</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"
            role="button" aria-expanded="false">{{Auth::user()->username}}
            <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li class="disabled"><a href="#"><i class="fa fa-fw fa-pencil"></i>Alterar dados</a></li>
              <li><a href="/logout"><i class="fa fa-fw fa-sign-out"></i>Logout</a><li>
              </ul>
            </li>
          </ul>
        </div>
      @else
        <ul class="nav navbar-nav navbar-right">
          <li><a href="/login">Login</a></li>
          <li><a href="/registrar">Cadastre-se</a></li>
        </ul>
      </div>
    @endif
  </div>
</nav>
