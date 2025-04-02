@extends('layouts.plantilla')
@section('titulo','Editar Fruta')

@section('contenido')
<h1>Editar Fruta</h1>

@if($errors->any())
<div class="alert alert-danger">
    <ul>
    @foreach($errors->all() as $err)
        <li>{{ $err }}</li>
    @endforeach
    </ul>
</div>
@endif

<form action="{{ route('frutas.update',$fruta->id) }}" method="POST" class="col-6">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" class="form-control" name="nombre" id="nombre" 
            value="{{ old('nombre', $fruta->nombre) }}">
    </div>
    <div class="mb-3">
        <label for="precio" class="form-label">Precio (€):</label>
        <input type="number" step="0.01" class="form-control" name="precio" id="precio" 
            value="{{ old('precio', $fruta->precio) }}">
    </div>
    <div class="mb-3">
        <label for="temporada_id" class="form-label">Temporada:</label>
        <select name="temporada_id" id="temporada_id" class="form-select">
            @foreach($temporadas as $temp)
            <option value="{{ $temp->id }}"
                {{ (old('temporada_id',$fruta->temporada_id) == $temp->id) ? 'selected' : '' }}>
                {{ $temp->temporada }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Origen existente:</label>
        <select name="origen_id" class="form-select">
            <option value="">-- Seleccionar --</option>
            @foreach($origenes as $org)
            <option value="{{ $org->id }}"
                {{ (old('origen_id',$fruta->origen_id) == $org->id) ? 'selected' : '' }}>
                {{ $org->origen }}
            </option>
            @endforeach
        </select>
        <div class="form-text">O bien introduce un nuevo país:</div>
        <input type="text" class="form-control" name="nuevo_origen" placeholder="Ej: Italia">
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="{{ route('frutas.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
