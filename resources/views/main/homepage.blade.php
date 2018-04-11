@extends('layouts.master')

@section('content')

  <div class="jumbotron">
    <div class="text-center sidebar-icon">
      <span onclick="openNav()">Débitos({{$count}})</span>
    </div>
    <div id='main' class="text-center">
      <div class="sidebar">
        @include('layouts.sidebar')
      </div>
      <h1>LH Manager</h1>
      <p class="lead text-muted">Gerenciamento da Lancheria do Hospital São Jerônimo</p>
    </div>
  </div>
@endsection
