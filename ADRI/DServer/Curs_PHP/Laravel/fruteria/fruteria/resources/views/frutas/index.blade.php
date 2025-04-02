@extends('layouts.plantilla')

@section('titulo', 'Buscar Frutas')

@section('contenido')
<div class="container text-center">
    <h1 class="mb-4">🍎 Encuentra tu Fruta</h1>

    <!-- ✅ Formulario de Filtros -->
    <div class="card p-4">
        <form method="GET" action="{{ route('frutas.index') }}">
            <div class="row">
                <div class="col-md-5">
                    <label for="temporada_id" class="form-label">Temporada:</label>
                    <select name="temporada_id" class="form-select">
                        <option value="">Todas</option>
                        @foreach($temporadas as $temporada)
                            <option value="{{ $temporada->id }}" 
                                {{ request('temporada_id') == $temporada->id ? 'selected' : '' }}>
                                {{ $temporada->temporada }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-5">
                    <label for="origen_id" class="form-label">Origen:</label>
                    <select name="origen_id" class="form-select">
                        <option value="">Todas</option>
                        @foreach($origenes as $origen)
                            <option value="{{ $origen->id }}" 
                                {{ request('origen_id') == $origen->id ? 'selected' : '' }}>
                                {{ $origen->origen }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-success w-100">🔍 Buscar</button>
                </div>
            </div>
        </form>
    </div>

    <!-- ✅ Resultados -->
    <div class="mt-4">
        <div class="card p-4">
            <h5>Resultados:</h5>
            @if($frutas->count() > 0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Temporada</th>
                            <th>Origen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($frutas as $fruta)
                            <tr>
                                <td>{{ $fruta->id }}</td>
                                <td>{{ $fruta->nombre }}</td>
                                <td>{{ $fruta->precio }} €</td>
                                <td>{{ $fruta->temporada->temporada ?? 'Sin definir' }}</td>
                                <td>{{ $fruta->origen->origen ?? 'Sin definir' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Paginación -->
                {{ $frutas->links() }}
            @else
                <p>No se encontraron frutas.</p>
            @endif
        </div>
    </div>
</div>
@endsection
