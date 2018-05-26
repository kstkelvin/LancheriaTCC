@extends('layouts.master')

@section('content')
  <br>
  <div class="container">
      <h1>Estatísticas</h1>
      <hr>
  </div>
  <div class="album">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="app">
            <div class="card-body mb-4 card box-shadow">
              <center>
                {!! $chart1->html() !!}
              </center>
            </div>
            <div class="card-body mb-4 card box-shadow">
              <center>
                {!! $chart2->html() !!}
              </center>
            </div>
            <div class="card-body mb-4 card box-shadow">
              <center>
                {!! $chart3->html() !!}
              </center>
            </div>
            <div class="card-body mb-4 card box-shadow">
              <center>
                {!! $chart4->html() !!}
              </center>
            </div>
          </div>
        </div>
      </div>
    </div>
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
