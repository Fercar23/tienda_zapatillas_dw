<?php
session_start();

// Proteger acceso
if (!isset($_SESSION["usuario_id"])) {
    header("Location: /tienda_zapatillas/vistas/login.php");
    exit;
}

require_once __DIR__ . "/../dao/ProductoDAO.php";

$productos = ProductoDAO::obtenerTodos();
$rol = $_SESSION["usuario_rol"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos</title>

    <link rel="stylesheet" href="/tienda_zapatillas/public/css/estilos.css">
</head>
<body>

<div class="container">

    <!-- HEADER -->
    <header>
        <h1>Tienda de Zapatillas</h1>
        <nav>
            <a href="/tienda_zapatillas/vistas/dashboard.php">Panel</a>
            <?php if ($rol === "cliente"): ?>
                <a href="/tienda_zapatillas/vistas/carrito.php">Carrito</a>
            <?php endif; ?>
            <a href="/tienda_zapatillas/vistas/logout.php">Salir</a>
        </nav>
    </header>

    <h2>Listado de productos</h2>

    <?php if ($rol === "admin"): ?>
        <p>
            <a class="btn" href="/tienda_zapatillas/vistas/producto_form.php">
                ➕ Crear nuevo producto
            </a>
        </p>
    <?php endif; ?>

    <?php if (empty($productos)): ?>
        <p>No hay productos disponibles.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio (€)</th>
                <th>Stock</th>
                <th>Imagen</th>

                <?php if ($rol === "cliente"): ?>
                    <th>Carrito</th>
                <?php endif; ?>

                <?php if ($rol === "admin"): ?>
                    <th>Acciones</th>
                <?php endif; ?>
            </tr>

            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?php echo htmlspecialchars($producto->getNombre()); ?></td>
                    <td><?php echo htmlspecialchars($producto->getDescripcion()); ?></td>
                    <td><?php echo number_format($producto->getPrecio(), 2); ?> €</td>
                    <td><?php echo $producto->getStock(); ?></td>
                    <td>
                       <img src="/tienda_zapatillas/public/img/productos/<?php echo htmlspecialchars($producto->getImagen()); ?>"
                            alt="<?php echo htmlspecialchars($producto->getNombre()); ?>"
                            style="width: 80px; border-radius: 4px;">
                    </td>


                    <?php if ($rol === "cliente"): ?>
                        <td>
                            <a class="btn"
                               href="/tienda_zapatillas/controlador/CarritoController.php?accion=agregar&id=<?php echo $producto->getId(); ?>">
                                Añadir
                            </a>
                        </td>
                    <?php endif; ?>

                    <?php if ($rol === "admin"): ?>
                        <td>
                            <a class="btn"
                               href="/tienda_zapatillas/vistas/producto_editar.php?id=<?php echo $producto->getId(); ?>">
                                Editar
                            </a>
                            <a class="btn btn-danger"
                               href="/tienda_zapatillas/controlador/ProductoAdminController.php?accion=eliminar&id=<?php echo $producto->getId(); ?>"
                               onclick="return confirm('¿Seguro que deseas eliminar este producto?');">
                                Eliminar
                            </a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

</div>

</body>
</html>
