@extends('layouts.master')

@section('content')
  <h1>Estatísticas</h1>
  <hr>
  <canvas id="myChart">  </canvas>
  <h3>5 Melhores produtos de todos os tempos</h3>
  @foreach($alltimehigh as $high)
    {{$high->name}}: {{$high->counter}}
    <br>
  @endforeach
  <h3>5 Piores produtos de todos os tempos</h3>
  @foreach($alltimelow as $low)
    {{$low->name}}: {{$low->counter}}
    <br>
  @endforeach
  <h3>5 Melhores produtos do mês <h6>(Itens que não foram vendidos este mês não aparecerão)</h6></h3>
  @foreach($monthhigh as $m_high)
    {{$m_high->name}}: {{$m_high->counter}}
    <br>
  @endforeach
  <h3>Cashflow (Clientes sem débito não aparecem aqui)</h3>
  @foreach($highkers as $h_k)
    {{$h_k->name}}: {{$h_k->total}}
    <br>
  @endforeach
  <h3>Dopeflow</h3>
  @foreach($dopeflow as $d_p)
    {{$d_p->name}}: {{$d_p->total}}
    <br>
  @endforeach

@endsection
<script type="text/javascript">
  var ctx = document.getElementById('myChart').getContext('2d');
  var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [{
            label: "My First dataset",
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [0, 10, 5, 2, 20, 30, 45],
        }]
    },

    // Configuration options go here
    options: {}
  });
  </script>
