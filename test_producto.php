<?php
require_once "modelo/Producto.php";

$producto = new Producto(
    1,
    "Zapatilla Nike Air",
    "Zapatilla deportiva para running",
    120.50,
    10,
    "nike_air.jpg"
);

echo $producto->getNombre();
