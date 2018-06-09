<header>
  <nav class="navbar navbar-expand-md navbar-dark navbar-fixed-top">
    <a class="navbar-brand" href="/" aria-label="LHManager"> LHManager </a>
    <button class="navbar-toggler" style="border:none; padding-top:3px;padding-right:0;" type="button" data-toggle="collapse-side" data-target=".side-collapse" data-target-2=".side-collapse-container" type="button">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="side-collapse in navbar-collapse">
      @if(Auth::check())
        <div class="nav-mobile">
          <ul class="navbar-nav">
            <div class="nav-link sidetitle">
              <br>
              <i class="fa fa-fw fa-user-circle-o" style="font-size: 80px;"></i>
              <br><br>
              @if(Auth::user()->surname != null)
                {{Auth::user()->name . " " . Auth::user()->surname}}
              @else
                {{Auth::user()->name}}
              @endif
              <div class="form-body">
                <a class="nav-link" style="font-size:10px;" href="/editar"><i class="fa fa-fw fa-pencil"></i>Editar</a>
                <a class="nav-link" style="font-size:10px;" href="/senha">Alterar senha</a>
                <a class="nav-link" style="font-size:10px;" href="/logout"><i class="fa fa-fw fa-sign-out"></i>Logout</a>
              </div>
            </div>
          </ul>
          <hr style="color:white; background-color:#888888;">
        </div>
        @if(Auth::user()->is_admin == true)
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="/"><i class="fa fa-fw fa-home"></i> Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/clientes"><i class="fa fa-fw fa-users"></i> Clientes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/produtos"><i class="fa fa-fw fa-cutlery"></i> Produtos</a>
            </li>
            <li class="nav-item">
              <span class="nav-link" style="cursor:pointer" id="myBtn3"><i class="fa fa-fw fa-shopping-cart"></i> Vendas</span>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/stats"><i class="fa fa-fw fa-line-chart"></i> Estatísticas</a>
            </li>
          </ul>
        @else
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="/"><i class="fa fa-fw fa-home"></i> Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/conta"><i class="fa fa-fw fa-shopping-cart"></i> Compras</a>
            </li>
          </ul>
        @endif
        <ul class="navbar-nav nav-screen">
          <li class="nav-item">
            <span class="nav-link dropbtn dropdown-toggle" style="cursor:pointer" onclick="myFunction()"><i class="fa fa-fw fa-user-circle-o"></i> {{Auth::user()->name}}</span>
          </li>
          <div id="mySidenav" class="sidenav ml-auto card card-body box-shadow">
            <a href="/editar"><i class="fa fa-fw fa-pencil"></i>EDITAR DADOS</a>
            <br>
            <a href="/senha">ALTERAR SENHA</a>
            <br>
            <a href="/logout"><i class="fa fa-fw fa-sign-out"></i>LOGOUT</a>
          </div>
        </ul>
      @else
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="/login"><i class="fa fa-fw fa-sign-in"></i> Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/registrar"><i class="fa fa-fw fa-user-plus"></i> Cadastre-se</a>
          </li>
        </ul>
      @endif
    </ul>
  </div>
</nav>
</header>
<div id="myModal3" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h2>Nova Venda</h2>
      <span class="close">&times;</span>
    </div>
    <div class="modal-body">
      <div class="form-group text-center">
        <p>Selecione o tipo de cliente:</p>
        <div class="btn-group d-flex justify-content-center form-inline">
          <a href="/venda" class="btn btn-md btn-primary"><i class="fa fa-fw fa-arrow-left"></i> Venda para funcionários</a>
          <a href="/visitantes" class="btn btn-md btn-primary"> Venda para visitantes <i class="fa fa-fw fa-arrow-right"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
