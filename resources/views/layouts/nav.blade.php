<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="/"class="navbar-brand">LHManager</a>
    </div>

    <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1" aria-expanded="false" style="height: 1px;">
      @if(Auth::check())
        @if(Auth::user()->is_admin == true)
          <ul class="nav navbar-nav">
            <li class="active"><a href="/"><i class="fa fa-fw fa-home"></i> Home <span class="sr-only">(current)</span></a></li>
            <li><a href="/clientes"><i class="fa fa-fw fa-users"></i> Clientes</a></li>
            <li><a href="/produtos"><i class="fa fa-fw fa-cutlery"></i> Produtos</a></li>
            <li><a href="/venda"><i class="fa fa-fw fa-shopping-cart"></i> Nova Venda</a></li>
            <li><a href="/stats"><i class="fa fa-fw fa-line-chart"></i> Estatísticas</a></li>
            <li><a href="/sobre"><i class="fa fa-fw fa-info-circle"></i> Sobre</a></li>
          </ul>
        @else
          <ul class="nav navbar-nav">
            <li class="active"><a href="/"><i class="fa fa-fw fa-home"></i> Home <span class="sr-only">(current)</span></a></li>
            <li><a href="/cliente/{{Auth::user()->id}}/account"><i class="fa fa-fw fa-shopping-cart"></i> Compras</a></li>
            <li><a href="/sobre"><i class="fa fa-fw fa-info-circle"></i> Sobre</a></li>
          </ul>
        @endif
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"
            role="button" aria-expanded="false"><i class="fa fa-fw fa-user-circle-o"></i> {{Auth::user()->name}}
            <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="/editar"><i class="fa fa-fw fa-pencil"></i>Alterar dados</a></li>
              <li><a href="/logout"><i class="fa fa-fw fa-sign-out"></i>Logout</a><li>
              </ul>
            </li>
          </ul>
        </div>
      @else
        <ul class="nav navbar-nav navbar-right">
          <li><a href="/login"><i class="fa fa-fw fa-sign-in"></i> Login</a></li>
          <li><a href="/registrar"><i class="fa fa-fw fa-user-plus"></i> Cadastre-se</a></li>
        </ul>
      </div>
    @endif
  </div>
</nav>
