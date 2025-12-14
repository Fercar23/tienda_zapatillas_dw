<?php
/**
 * ProductoController
 * Controla la creación de productos (solo administrador).
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Proteger acceso: solo ADMIN
if (!isset($_SESSION["usuario_id"]) || $_SESSION["usuario_rol"] !== "admin") {
    header("Location: /tienda_zapatillas/vistas/login.php");
    exit;
}

require_once __DIR__ . "/../dao/ProductoDAO.php";
require_once __DIR__ . "/../modelo/Producto.php";

// Verificar envío del formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre = $_POST["nombre"] ?? "";
    $descripcion = $_POST["descripcion"] ?? "";
    $precio = $_POST["precio"] ?? "";
    $stock = $_POST["stock"] ?? "";
    $imagen = $_POST["imagen"] ?? "";

    // Validación básica
    if (empty($nombre) || empty($descripcion) || empty($precio) || empty($stock) || empty($imagen)) {
        header("Location: /tienda_zapatillas/vistas/producto_form.php?error=1");
        exit;
    }

    // Crear objeto Producto
    $producto = new Producto(
        null,
        $nombre,
        $descripcion,
        (float)$precio,
        (int)$stock,
        $imagen
    );

    // Insertar en la base de datos
    ProductoDAO::insertar($producto);

    // Redirigir con mensaje OK
    header("Location: /tienda_zapatillas/vistas/producto_form.php?ok=1");
    exit;
}
