<?php
session_start();

// Solo CLIENTE
if (!isset($_SESSION["usuario_id"]) || $_SESSION["usuario_rol"] !== "cliente") {
    header("Location: /tienda_zapatillas/vistas/login.php");
    exit;
}

$carrito = $_SESSION["carrito"] ?? [];
$total = 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi carrito</title>

    <link rel="stylesheet" href="/tienda_zapatillas/public/css/estilos.css">
</head>
<body>

<div class="container">

    <!-- HEADER -->
    <header>
        <h1>Mi carrito</h1>
        <nav>
            <a href="/tienda_zapatillas/vistas/productos.php">Productos</a>
            <a href="/tienda_zapatillas/vistas/dashboard.php">Panel</a>
            <a href="/tienda_zapatillas/vistas/logout.php">Salir</a>
        </nav>
    </header>

    <?php if (empty($carrito)): ?>
        <p>El carrito está vacío.</p>
        <p>
            <a class="btn" href="/tienda_zapatillas/vistas/productos.php">
                Volver a la tienda
            </a>
        </p>
    <?php else: ?>
        <table>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>

            <?php foreach ($carrito as $item): ?>
                <?php
                    $subtotal = $item["precio"] * $item["cantidad"];
                    $total += $subtotal;
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($item["nombre"]); ?></td>
                    <td><?php echo number_format($item["precio"], 2); ?> €</td>
                    <td><?php echo $item["cantidad"]; ?></td>
                    <td><?php echo number_format($subtotal, 2); ?> €</td>
                </tr>
            <?php endforeach; ?>
        </table>

        <h3>Total: <?php echo number_format($total, 2); ?> €</h3>

        <p>
            <a class="btn" href="/tienda_zapatillas/vistas/productos.php">
                Seguir comprando
            </a>
            <a class="btn btn-danger"
               href="/tienda_zapatillas/controlador/CarritoController.php?accion=vaciar">
                Vaciar carrito
            </a>
            <a class="btn"
               href="/tienda_zapatillas/vistas/confirmar_compra.php">
                Confirmar compra
            </a>
        </p>
    <?php endif; ?>

</div>

</body>
</html>
