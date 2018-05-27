
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../../../../favicon.ico">

  <title>Lancheria do Hospital</title>

  <!--link href="/css/navbar.css" rel="stylesheet"-->



  <!-- CSS FONTS FROM OUTSIDE PROJECT -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
  <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">

  <!-- CSS FONTS FROM THE PROJECT -->
  <link href="/css/template.css" rel="stylesheet">
  <link href="/css/layout.css" rel="stylesheet"> <!--to jogando o que eu achar utilizável aqui-->
  <link href="/css/popup.css" rel="stylesheet">   <!--popup de pagamento-->
  <link href="/css/searchbar.css" rel="stylesheet"> <!--barra de pesquisas-->
  <link href="/css/sidebar.css" rel="stylesheet">
  <link href="/css/navbar.css" rel="stylesheet">
  <link href="/css/footer.css" rel="stylesheet">
  <link href="/css/components.css" rel="stylesheet">

  {!! Charts::styles() !!}

  <!-- GOOGLE SIGN-IN META -->
  <meta name="google-signin-client_id" content="495111472213-2102ip6l0rrqj9s7urmvgfprfi10s7u9.apps.googleusercontent.com">

</head>
<body id="main">
  <div class="nav">
    @include('layouts.nav')
  </div>
  <div id="main_container">
    <div class="container">
      @include('layouts.dialog')
      @yield('content')
    </div>
  </div>
  <div>
    @include('layouts.footer')
  </div>

  <!-- JS SCRIPTS FROM OUTSIDE PROJECT -->
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>

  <!-- JS SCRIPTS FROM THE PROJECT -->
  <script src="/js/popup.js"></script>
  <script src="/js/popup_venda.js"></script>
  <script src="/js/popup_visitor.js"></script>
  <script src="/js/confirm_action.js"></script>
  <script src="/js/sidebar.js"></script>
  <script src="/js/navbar.js"></script>

  {!! Charts::scripts() !!}

</body>
</html>
