@extends('layouts.master')

@section('content')
  <br>
  <div class="container">
    <div class="row form-body">
      <div class="col-lg-4">
        <div class="card-body card mb-4 box-shadow">
          <form method="post" action="/login" class="form-signin">
            {{ csrf_field() }}

            <div class="text-center mb-4 ">
              <h1 class="h3 mb-3 font-weight-normal">Login</h1>
            </div>
            <div class="panel-body">
              <div class="form-group">
                <div class="form-label-group">
                  <input type="email" id="email" name="email" class="form-control" placeholder="Endereço de e-mail" required autofocus>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input type="password" id="password" class="form-control " name="password" minlength="8" placeholder="Senha" required autofocus>
                </div>
              </div>
              <div class="form-group">
                <button class="btn btn-lg btn-primary btn-block box-shadow" type="submit">Efetuar Login</button>
              </div>
              <div class="g-signin2" data-onsuccess="onSignIn" style="display:none;"></div>
              <script type="text/javascript">
              function onSignIn(googleUser) {
                var profile = googleUser.getBasicProfile();
                console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
                console.log('Name: ' + profile.getName());
                console.log('Image URL: ' + profile.getImageUrl());
                console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
              }
              var id_token = googleUser.getAuthResponse().id_token;
              console.log("ID Token: " + id_token);
              </script>
              <p class="intro_remember">Esqueceu a sua senha? <a href="{{ route('password.request') }}">Recupere a sua senha aqui</a>.</p>
            </div>
            <p class="intro-login">Não possui uma conta? <a href="/registrar">Cadastre-se</a>.</p>


          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
