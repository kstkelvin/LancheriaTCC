
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="/storage/favicon.ico">
  <title>Lancheria do Hospital</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
  <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
  <link href="/css/template.css" rel="stylesheet">
  {!! Charts::styles() !!}
</head>
<body id="main">
  <div class="nav">
    @include('layouts.nav')
  </div>
  <div class="side-collapse-container">
    <div id="main_container">
      <div class="container">
        @include('layouts.dialog')
        @yield('content')
      </div>
    </div>
    <div>
      @include('layouts.footer')
    </div>
  </div>

  <!-- JS SCRIPTS FROM THE PROJECT -->
  <script src="/js/popup.js"></script>
  <script src="/js/popup_venda.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  {!! Charts::scripts() !!}
  <script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>
  <script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>
  <script src="/js/loader.js"></script>
</body>
</html>
