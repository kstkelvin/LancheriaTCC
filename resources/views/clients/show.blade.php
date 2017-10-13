@extends('layouts.master')


@section('content')

<div class=heftymargins>
  <h2>{{ $client->name . ' ' . $client->surname }}</h2>
  <br>
  {{ 'Setor: ' . $client->setor }}
  <br>
  {{ 'Telefone:' . $client->phone_number}}
  <br>
  <a href="/client/{{$client->id}}/edit" class="btn btn-success">Editar</a>
</div>
@endsection
