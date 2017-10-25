
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">

  <div>
    @if(Auth::check())
      <span class="navbar-link whitecolor ml-auto smfp">{{Auth::user()->username . ", "}}</span>
      <a href="/logout" class=" whitecolor ml-1 smfp">Logout</a>
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
  </div>
</nav>
