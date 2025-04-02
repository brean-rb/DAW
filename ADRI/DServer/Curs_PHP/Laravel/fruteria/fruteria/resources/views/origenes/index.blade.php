@extends('layouts.plantilla')

@section('titulo', 'Listado de Orígenes')

@section('contenido')

<div class="container text-center">
    <h1 class="mb-4">🌍 Listado de Orígenes</h1>

    @if($origenes->count() > 0)
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($origenes as $org)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $org->origen }}
                                    <span class="badge bg-primary rounded-pill">🌎</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @else
        <p class="text-muted">No hay orígenes registrados.</p>
    @endif

    <a href="{{ route('frutas.index') }}" class="btn btn-secondary mt-3">🔙 Volver</a>
</div>

@endsection
