<?php
session_start();

// Proteger acesso: solo ADMIN
if (!isset($_SESSION["usuario_id"]) || $_SESSION["usuario_rol"] !== "admin") {
    header("Location: /tienda_zapatillas/vistas/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear producto</title>
</head>
<body>

<h2>Crear nuevo producto</h2>

<?php if (isset($_GET["ok"])): ?>
    <p style="color:green;">Producto creado correctamente.</p>
<?php endif; ?>

<?php if (isset($_GET["error"])): ?>
    <p style="color:red;">Todos los campos obligatorios deben completarse.</p>
<?php endif; ?>

<form action="/tienda_zapatillas/controlador/ProductoController.php" method="POST">

    <label>Nombre:</label><br>
    <input type="text" name="nombre" required><br><br>

    <label>Descripción:</label><br>
    <textarea name="descripcion" required></textarea><br><br>

    <label>Precio (€):</label><br>
    <input type="number" step="0.01" name="precio" required><br><br>

    <label>Stock:</label><br>
    <input type="number" name="stock" required><br><br>

    <label>Imagen (archivo):</label><br>
    <input type="text" name="imagen" placeholder="ej: nike.jpg" required><br><br>

    <button type="submit">Guardar producto</button>

</form>

<p>
    <a href="/tienda_zapatillas/vistas/dashboard.php">Volver al panel</a>
</p>

</body>
</html>
