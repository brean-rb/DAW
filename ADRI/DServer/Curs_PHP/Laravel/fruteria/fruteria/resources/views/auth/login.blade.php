@extends('layouts.plantilla')

@section('titulo', 'Login')

@section('contenido')

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 400px;">

        <div class="text-center">
            <img src="https://source.unsplash.com/150x150/?fruit" class="rounded-circle mb-3" alt="Frutas">
            <h1 class="mb-3">🍎 Iniciar Sesión</h1>
        </div>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="nombre" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <button type="submit" class="btn btn-success w-100">Iniciar Sesión</button>
        </form>

        <div class="text-center mt-3">
            <a href="{{ route('register.form') }}" class="text-decoration-none">¿No tienes cuenta? Regístrate</a>
        </div>

    </div>
</div>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
