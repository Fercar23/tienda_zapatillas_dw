<?php
require_once __DIR__ . "/../config/Conexion.php";
require_once __DIR__ . "/../modelo/Producto.php";

/**
 * Clase ProductoDAO
 * Acceso a datos de la tabla productos.
 */
class ProductoDAO
{
    /**
     * Inserta un nuevo producto en la base de datos
     * @param Producto $producto
     * @return bool
     */
    public static function insertar(Producto $producto): bool
    {
        $conexion = Conexion::conectar();

        $sql = "INSERT INTO productos 
                (nombre, descripcion, precio, stock, imagen_url)
                VALUES (:nombre, :descripcion, :precio, :stock, :imagen)";

        $stmt = $conexion->prepare($sql);

        return $stmt->execute([
            ":nombre"      => $producto->getNombre(),
            ":descripcion" => $producto->getDescripcion(),
            ":precio"      => $producto->getPrecio(),
            ":stock"       => $producto->getStock(),
            ":imagen"      => $producto->getImagen()
        ]);
    }

    /**
     * Obtiene todos los productos
     * @return array
     */
    public static function obtenerTodos(): array
    {
        $conexion = Conexion::conectar();

        $sql = "SELECT * FROM productos";
        $stmt = $conexion->query($sql);

        $productos = [];

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $productos[] = new Producto(
                $fila["id_producto"],   // id de la BD
                $fila["nombre"],
                $fila["descripcion"],
                (float)$fila["precio"],
                (int)$fila["stock"],
                $fila["imagen_url"]     // imagen
            );
        }

        return $productos;
    }
/**
 * Obtiene un producto por su ID
 */
public static function obtenerPorId(int $id): ?Producto
{
    $conexion = Conexion::conectar();

    $sql = "SELECT * FROM productos WHERE id_producto = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();

    $fila = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($fila) {
        return new Producto(
            $fila["id_producto"],
            $fila["nombre"],
            $fila["descripcion"],
            (float)$fila["precio"],
            (int)$fila["stock"],
            $fila["imagen_url"]
        );
    }

    return null;
}

/**
 * Actualiza un producto existente
 */
public static function actualizar(Producto $producto): bool
{
    $conexion = Conexion::conectar();

    $sql = "UPDATE productos SET
                nombre = :nombre,
                descripcion = :descripcion,
                precio = :precio,
                stock = :stock,
                imagen_url = :imagen
            WHERE id_producto = :id";

    $stmt = $conexion->prepare($sql);

    return $stmt->execute([
        ":nombre" => $producto->getNombre(),
        ":descripcion" => $producto->getDescripcion(),
        ":precio" => $producto->getPrecio(),
        ":stock" => $producto->getStock(),
        ":imagen" => $producto->getImagen(),
        ":id" => $producto->getId()
    ]);
}

/**
 * Elimina un producto
 */
public static function eliminar(int $id): bool
{
    $conexion = Conexion::conectar();

    $sql = "DELETE FROM productos WHERE id_producto = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);

    return $stmt->execute();
}    
    
}
