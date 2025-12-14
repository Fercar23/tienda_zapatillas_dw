<?php
session_start();

if (!isset($_SESSION["usuario_id"]) || $_SESSION["usuario_rol"] !== "admin") {
    header("Location: /tienda_zapatillas/vistas/login.php");
    exit;
}

require_once __DIR__ . "/../dao/ProductoDAO.php";

$id = (int)($_GET["id"] ?? 0);
$producto = ProductoDAO::obtenerPorId($id);

if (!$producto) {
    header("Location: productos.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar producto</title>
</head>
<body>

<h2>Editar producto</h2>

<form action="/tienda_zapatillas/controlador/ProductoAdminController.php" method="POST">

    <input type="hidden" name="id" value="<?php echo $producto->getId(); ?>">

    <label>Nombre:</label><br>
    <input type="text" name="nombre" value="<?php echo htmlspecialchars($producto->getNombre()); ?>" required><br><br>

    <label>Descripción:</label><br>
    <textarea name="descripcion" required><?php echo htmlspecialchars($producto->getDescripcion()); ?></textarea><br><br>

    <label>Precio (€):</label><br>
    <input type="number" step="0.01" name="precio" value="<?php echo $producto->getPrecio(); ?>" required><br><br>

    <label>Stock:</label><br>
    <input type="number" name="stock" value="<?php echo $producto->getStock(); ?>" required><br><br>

    <label>Imagen:</label><br>
    <input type="text" name="imagen" value="<?php echo htmlspecialchars($producto->getImagen()); ?>" required><br><br>

    <button type="submit">Guardar cambios</button>
</form>

<p><a href="/tienda_zapatillas/vistas/productos.php">Volver</a></p>

</body>
</html>
