<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link rel="stylesheet" href="/tienda_zapatillas/public/css/estilos.css">
</head>
<body>

<div class="container" style="max-width: 400px; margin-top: 80px;">

    <h2>Acceso a la tienda</h2>

    <?php if (isset($_GET["error"])): ?>
        <div class="error">
            <?php
                if ($_GET["error"] === "campos_vacios") {
                    echo "Todos los campos son obligatorios.";
                } else {
                    echo "Email o contraseña incorrectos.";
                }
            ?>
        </div>
    <?php endif; ?>

    <form action="/tienda_zapatillas/controlador/LoginController.php" method="POST">

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Contraseña</label>
        <input type="password" name="password" required>

        <button class="btn" type="submit">Entrar</button>
    </form>

    <p style="margin-top: 20px;">
        ¿No tienes cuenta?
        <a href="/tienda_zapatillas/vistas/registro.php">Regístrate aquí</a>
    </p>

</div>

</body>
</html>
