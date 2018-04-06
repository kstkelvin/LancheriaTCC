@extends('layouts.master')

@section('content')
  <h1>Estatísticas</h1>
  <hr>

  <div class="app">
    <br>
    <center>
      {!! $chart1->html() !!}
    </center>
    <center>
      {!! $chart2->html() !!}
    </center>
    <center>
      {!! $chart3->html() !!}
    </center>
    <center>
      {!! $chart4->html() !!}
    </center>
  </div>
  {!! Charts::scripts() !!}
  {!! $chart1->script() !!}
  {!! Charts::scripts() !!}
  {!! $chart2->script() !!}
  {!! Charts::scripts() !!}
  {!! $chart3->script() !!}
  {!! Charts::scripts() !!}
  {!! $chart4->script() !!}
@endsection
