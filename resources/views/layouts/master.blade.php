
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../../../../favicon.ico">

  <title>Lancheria do Hospital</title>

  <!-- Bootstrap min CSS -->
  <!--link href="/css/bootstrap.min.css" rel="stylesheet"-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <link href="/css/template.css" rel="stylesheet">

</head>

<body>

  @include('layouts.nav')

  <div class="container">
    @yield('content')

  </div>

  @include('layouts.footer')

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="/js/vendor/jquery.min.js"><\/script>')</script>
  <script src="/js/popper.min.js"></script>
  <script src="/js/bootstrap.min.js"></script>
</body>
</html>
