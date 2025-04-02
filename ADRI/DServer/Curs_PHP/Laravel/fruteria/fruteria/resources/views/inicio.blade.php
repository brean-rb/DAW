<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Frutería</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #28a745; /* Verde */
        }
        .navbar-brand {
            font-weight: bold;
            color: white !important;
        }
        .container {
            margin-top: 20px;
        }
        .card {
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>

    <!-- ✅ Barra de Navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">🍎 Frutería</a>
            <div class="d-flex">
                @if(Auth::check())
                    <span class="text-white me-3">Bienvenido/a {{ auth()->user()->nombre }}</span>
                    <a href="{{ route('logout') }}" class="btn btn-light btn-sm">Cerrar Sesión</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-light btn-sm me-2">Login</a>
                    <a href="{{ route('register.form') }}" class="btn btn-warning btn-sm">Registrarse</a>
                @endif
            </div>
        </div>
    </nav>

    <div class="container text-center">
        <h1 class="my-4">Bienvenido a la Frutería 🍊🍌🍎</h1>

        <!-- ✅ Opciones -->
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('frutas.index') }}" class="text-decoration-none">
                    <div class="card shadow">
                        <img src="https://source.unsplash.com/300x200/?fruit" class="card-img-top" alt="Frutas">
                        <div class="card-body">
                            <h5 class="card-title">🔍 Buscar Frutas</h5>
                            <p class="card-text">Encuentra la fruta que buscas en nuestra tienda.</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('frutas.create') }}" class="text-decoration-none">
                    <div class="card shadow">
                        <img src="https://source.unsplash.com/300x200/?apple,banana" class="card-img-top" alt="Añadir Fruta">
                        <div class="card-body">
                            <h5 class="card-title">➕ Añadir Fruta</h5>
                            <p class="card-text">Registra nuevas frutas en nuestro inventario.</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('origenes.index') }}" class="text-decoration-none">
                    <div class="card shadow">
                        <img src="https://source.unsplash.com/300x200/?farm,fruit" class="card-img-top" alt="Orígenes">
                        <div class="card-body">
                            <h5 class="card-title">🌍 Listar Orígenes</h5>
                            <p class="card-text">Explora los orígenes de nuestras frutas frescas.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- ✅ Formulario para Buscar o Editar Frutas -->
        <div class="mt-5">
            <h3>🔎 Buscar o Editar una Fruta</h3>
            <form class="row g-3 justify-content-center">
                <div class="col-auto">
                    <input type="number" min="1" class="form-control" id="fruta_id" placeholder="ID de la fruta">
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-primary" onclick="buscarFruta()">Ver Fruta</button>
                    <button type="button" class="btn btn-warning" onclick="editarFruta()">Editar Fruta</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ✅ Scripts -->
    <script>
    function buscarFruta() {
    let id = document.getElementById('fruta_id').value.trim();
    if (id) {
        window.location.href = "{{ url('frutas') }}/" + encodeURIComponent(id);
    } else {
        alert("Por favor, ingrese un ID válido.");
    }
}

function editarFruta() {
    let id = document.getElementById('fruta_id').value.trim();
    if (id) {
        window.location.href = "{{ url('frutas') }}/" + encodeURIComponent(id) + "/edit";
    } else {
        alert("Por favor, ingrese un ID válido.");
    }
}

    </script>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
