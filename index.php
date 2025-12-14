<?php
session_start();

/*
 * Página inicial da aplicação.
 * Se o usuário já estiver autenticado, redireciona automaticamente.
 */
if (isset($_SESSION["usuario_id"])) {
    header("Location: vistas/dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda de Zapatillas</title>

    <link rel="stylesheet" href="/tienda_zapatillas/public/css/estilos.css">
</head>
<body>

<div class="container" style="max-width: 700px; margin-top: 80px; text-align: center;">

    <h1>Bienvenido a la Tienda de Zapatillas</h1>

    <p style="margin-top: 20px;">
        Aplicación web desarrollada en entorno servidor para la gestión de una tienda online
        de zapatillas deportivas.
    </p>

    <p style="margin-top: 30px;">
        <a class="btn" href="/tienda_zapatillas/vistas/login.php">
            Iniciar sesión
        </a>
        <a class="btn" href="/tienda_zapatillas/vistas/registro.php">
            Registrarse
        </a>
    </p>

</div>

</body>
</html>
