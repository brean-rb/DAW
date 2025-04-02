<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- ✅ Barra de Navegación Mejorada -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="{{ route('frutas.index') }}">🍎 Frutería</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ route('frutas.index') }}" class="nav-link">Lista de Frutas</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('frutas.create') }}" class="nav-link">Añadir Fruta</a>
                    </li>

                    @if(Auth::check())
                        <li class="nav-item">
                            <span class="nav-link text-white">Bienvenido/a {{ auth()->user()->nombre }}</span>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="btn btn-light btn-sm ms-2">Cerrar Sesión</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="btn btn-light btn-sm me-2">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register.form') }}" class="btn btn-warning btn-sm">Registrarse</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        @yield('contenido')
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
