<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Solo ADMIN
if (!isset($_SESSION["usuario_id"]) || $_SESSION["usuario_rol"] !== "admin") {
    header("Location: /tienda_zapatillas/vistas/login.php");
    exit;
}

require_once __DIR__ . "/../dao/ProductoDAO.php";
require_once __DIR__ . "/../modelo/Producto.php";

// ELIMINAR
if (isset($_GET["accion"]) && $_GET["accion"] === "eliminar") {
    $id = (int)$_GET["id"];
    ProductoDAO::eliminar($id);
    header("Location: /tienda_zapatillas/vistas/productos.php");
    exit;
}

// ACTUALIZAR
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $producto = new Producto(
        (int)$_POST["id"],
        $_POST["nombre"],
        $_POST["descripcion"],
        (float)$_POST["precio"],
        (int)$_POST["stock"],
        $_POST["imagen"]
    );

    ProductoDAO::actualizar($producto);
    header("Location: /tienda_zapatillas/vistas/productos.php");
    exit;
}
