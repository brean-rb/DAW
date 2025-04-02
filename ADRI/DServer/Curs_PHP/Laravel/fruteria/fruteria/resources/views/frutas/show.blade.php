@extends('layouts.plantilla')
@section('titulo','Detalle Fruta')

@section('contenido')
<h1>Detalle de Fruta</h1>

@if($fruta)
<div class="card mb-3" style="max-width: 30rem;">
  <div class="card-body">
    <h5 class="card-title">{{ $fruta->nombre }}</h5>
    <p class="card-text">Precio: <strong>{{ $fruta->precio }} €</strong></p>
    <p class="card-text">Temporada: {{ $fruta->temporada->temporada ?? 'Sin temporada' }}</p>
    <p class="card-text">Origen: {{ $fruta->origen->origen ?? 'Desconocido' }}</p>
    <a href="{{ route('frutas.index') }}" class="btn btn-primary">Volver</a>
  </div>
</div>
@else
<p>No se encontró la fruta solicitada.</p>
<a href="{{ route('frutas.index') }}" class="btn btn-primary">Volver</a>
@endif
@endsection
