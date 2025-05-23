<?php
session_start();
include('conexion/db.php');

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel de Control</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .nav-link:hover { background-color: rgba(255,255,255,0.1); }
        .card { transition: transform 0.3s; }
        .card:hover { transform: translateY(-5px); }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="bi bi-speedometer2"></i> Panel
            </a>
            <div class="navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> <?= $_SESSION['usuario_nombre'] ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="logout.php">
                                <i class="bi bi-box-arrow-right"></i> Salir
                            </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row g-4">
            <!-- Tarjeta Usuarios -->
            <div class="col-md-4">
                <div class="card h-100 shadow">
                    <div class="card-header bg-primary text-white">
                        <i class="bi bi-people"></i> Usuarios
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Gestión de usuarios</h5>
                        <p class="card-text">Administra los usuarios del sistema</p>
                    </div>
                    <div class="card-footer">
                        <a href="crud/usuarios/listar.php" class="btn btn-primary w-100">
                            Administrar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tarjeta Roles -->
            <div class="col-md-4">
                <div class="card h-100 shadow">
                    <div class="card-header bg-success text-white">
                        <i class="bi bi-shield-lock"></i> Roles
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Control de accesos</h5>
                        <p class="card-text">Configura permisos y roles</p>
                    </div>
                    <div class="card-footer">
                        <a href="crud/roles/listar.php" class="btn btn-success w-100">
                            Gestionar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tarjeta Solicitudes -->
            <div class="col-md-4">
                <div class="card h-100 shadow">
                    <div class="card-header bg-warning text-dark">
                        <i class="bi bi-clipboard-data"></i> Solicitudes
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Gestión de peticiones</h5>
                        <p class="card-text">Revisa solicitudes de información</p>
                    </div>
                    <div class="card-footer">
                        <a href="crud/solicitudes/listar.php" class="btn btn-warning w-100">
                            Ver registros
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="mt-5 py-3 bg-dark text-white text-center">
        <div class="container">
            <small>Sistema Ganadero &copy; <?= date('Y') ?></small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>