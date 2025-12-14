<?php
session_start();

// Solo CLIENTE
if (!isset($_SESSION["usuario_id"]) || $_SESSION["usuario_rol"] !== "cliente") {
    header("Location: /tienda_zapatillas/vistas/login.php");
    exit;
}

// Si el carrito está vacío, volver
if (empty($_SESSION["carrito"])) {
    header("Location: /tienda_zapatillas/vistas/carrito.php");
    exit;
}

// Vaciar carrito tras confirmar compra
unset($_SESSION["carrito"]);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Compra confirmada</title>

    <link rel="stylesheet" href="/tienda_zapatillas/public/css/estilos.css">
</head>
<body>

<div class="container" style="max-width: 600px; margin-top: 80px; text-align: center;">

    <h2>¡Compra realizada con éxito! 🎉</h2>

    <p style="margin-top: 20px;">
        Gracias por su compra. Su pedido ha sido procesado correctamente.
    </p>

    <p style="margin-top: 30px;">
        <a class="btn" href="/tienda_zapatillas/vistas/productos.php">
            Volver a la tienda
        </a>
        <a class="btn" href="/tienda_zapatillas/vistas/dashboard.php">
            Ir al panel
        </a>
    </p>

</div>

</body>
</html>
