
<div class="navbar navbar-dark bg-dark navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a href="/" class="navbar-brand">LHManager</a>
    </div>
    <div>
      @if(Auth::check())
        <a href="/clientes" class="navbar-brand small-font">Clientes</a>
        <a href="/produtos" class="navbar-brand small-font">Produtos</a>
        <a href="/venda" class="navbar-brand small-font">Nova Venda</a>
        <span class="navbar-brand ml-auto small-font">{{'Bem vindo(a), ' . Auth::user()->username}}</span>
        <span class="navbar-brand small-font">{{'|'}}</span>
        <a href="/logout" class="navbar-brand small-font">Sair</a>
      @else
        <a href="/login" class="navbar-brand ml-auto small-font">Login</a>
        <a href="/registrar" class="navbar-brand small-font">Cadastre-se</a>
      @endif
    </div>
  </div>
</div>

<nav class="navbar navbar-dark bg-dark navbar-static-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="collapse navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">Lancheria do Hospital</a>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">Page 1</a></li>
        <li><a href="#">Page 2</a></li>
        <li><a href="#">Page 3</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>
