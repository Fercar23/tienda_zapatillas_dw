<?php
session_start();

// Proteger acceso
if (!isset($_SESSION["usuario_id"])) {
    header("Location: /tienda_zapatillas/vistas/login.php");
    exit;
}

$rol = $_SESSION["usuario_rol"];
$nombre = $_SESSION["usuario_nombre"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel principal</title>

    <link rel="stylesheet" href="/tienda_zapatillas/public/css/estilos.css">
</head>
<body>

<div class="container">

    <!-- HEADER -->
    <header>
        <h1>Panel principal</h1>
        <nav>
            <a href="/tienda_zapatillas/vistas/productos.php">Productos</a>

            <?php if ($rol === "cliente"): ?>
                <a href="/tienda_zapatillas/vistas/carrito.php">Carrito</a>
            <?php endif; ?>

            <a href="/tienda_zapatillas/vistas/logout.php">Salir</a>
        </nav>
    </header>

    <h2>Bienvenida</h2>
    <p>Hola <strong><?php echo htmlspecialchars($nombre); ?></strong>, has iniciado sesión como
       <strong><?php echo htmlspecialchars($rol); ?></strong>.
    </p>

    <hr>

    <?php if ($rol === "admin"): ?>
        <h2>Panel de Administrador</h2>
        <p>Desde aquí puedes gestionar los productos de la tienda.</p>

        <p>
            <a class="btn" href="/tienda_zapatillas/vistas/producto_form.php">
                Crear nuevo producto
            </a>
            <a class="btn" href="/tienda_zapatillas/vistas/productos.php">
                Gestionar productos
            </a>
        </p>
    <?php else: ?>
        <h2>Zona del Cliente</h2>
        <p>Explora nuestros productos y gestiona tu carrito de compras.</p>

        <p>
            <a class="btn" href="/tienda_zapatillas/vistas/productos.php">
                Ver productos
            </a>
            <a class="btn" href="/tienda_zapatillas/vistas/carrito.php">
                Ver carrito
            </a>
        </p>
    <?php endif; ?>

</div>

</body>
</html>
