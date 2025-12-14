<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de usuario</title>
</head>
<body>

<h2>Registro de nuevo usuario</h2>

<?php if (isset($_GET["error"])): ?>
    <p style="color:red;">
        <?php
            if ($_GET["error"] === "campos_vacios") {
                echo "Todos los campos obligatorios deben ser completados.";
            } elseif ($_GET["error"] === "email_existe") {
                echo "El email ya está registrado.";
            }
        ?>
    </p>
<?php endif; ?>

<form action="/tienda_zapatillas/controlador/RegistroController.php" method="POST">

    <label>Nombre:</label><br>
    <input type="text" name="nombre" required><br><br>

    <label>Apellidos:</label><br>
    <input type="text" name="apellidos" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Contraseña:</label><br>
    <input type="password" name="password" required><br><br>

    <label>Teléfono:</label><br>
    <input type="text" name="telefono"><br><br>

    <label>Dirección:</label><br>
    <input type="text" name="direccion"><br><br>

    <!-- Por defecto todos los registros son clientes -->
    <input type="hidden" name="rol" value="cliente">

    <button type="submit">Registrarse</button>

</form>

<p>
    <a href="/tienda_zapatillas/vistas/login.php">Volver al login</a>
</p>

</body>
</html>
