<?php
session_start();
include('conexion/db.php');

if (isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = trim($_POST['correo']);
    $contrasena = $_POST['contrasena'];

    if (!empty($correo) && !empty($contrasena)) {
        try {
            $sql = "SELECT id_usuario, nombres, contrasena 
                    FROM usuarios 
                    WHERE correo_electronico = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$correo]);
            $usuario = $stmt->fetch();

            if ($usuario && $contrasena == $usuario['contrasena']) {
                $_SESSION['usuario_id'] = $usuario['id_usuario'];
                $_SESSION['usuario_nombre'] = $usuario['nombres'];
                header("Location: index.php");
                exit();
            } else {
                $error = "Credenciales incorrectas";
            }
        } catch (PDOException $e) {
            $error = "Error en el sistema";
        }
    } else {
        $error = "Complete todos los campos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { height: 100vh; display: flex; align-items: center; background: #f8f9fa; }
        .login-box { max-width: 400px; width: 100%; margin: 0 auto; }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-box">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4><i class="bi bi-box-arrow-in-right"></i> Acceso</h4>
                </div>
                <div class="card-body">
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label>Correo Electrónico</label>
                            <input type="email" name="correo" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label>Contraseña</label>
                            <input type="password" name="contrasena" class="form-control" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">Ingresar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>