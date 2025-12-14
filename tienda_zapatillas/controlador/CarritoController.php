<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Solo CLIENTE autenticado
if (!isset($_SESSION["usuario_id"]) || $_SESSION["usuario_rol"] !== "cliente") {
    header("Location: /tienda_zapatillas/vistas/login.php");
    exit;
}

require_once __DIR__ . "/../dao/ProductoDAO.php";

// Acción: añadir producto
if (isset($_GET["accion"]) && $_GET["accion"] === "agregar") {

    $idProducto = (int)($_GET["id"] ?? 0);

    $producto = ProductoDAO::obtenerPorId($idProducto);

    if (!$producto) {
        header("Location: /tienda_zapatillas/vistas/productos.php");
        exit;
    }

    // Inicializar carrito si no existe
    if (!isset($_SESSION["carrito"])) {
        $_SESSION["carrito"] = [];
    }

    // Si el producto ya está en el carrito, aumentar cantidad
    if (isset($_SESSION["carrito"][$idProducto])) {
        $_SESSION["carrito"][$idProducto]["cantidad"]++;
    } else {
        // Añadir nuevo producto
        $_SESSION["carrito"][$idProducto] = [
            "id" => $producto->getId(),
            "nombre" => $producto->getNombre(),
            "precio" => $producto->getPrecio(),
            "cantidad" => 1
        ];
    }

    header("Location: /tienda_zapatillas/vistas/carrito.php");
    exit;

    // Acción: vaciar carrito
    if (isset($_GET["accion"]) && $_GET["accion"] === "vaciar") {
    unset($_SESSION["carrito"]);
    header("Location: /tienda_zapatillas/vistas/carrito.php");
    exit;
}

}
