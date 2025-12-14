<?php
/**
 * Clase Producto
 * Representa la entidad "productos" de la base de datos.
 * Corresponde a las zapatillas de la tienda.
 */
class Producto
{
    private ?int $id;
    private string $nombre;
    private string $descripcion;
    private float $precio;
    private int $stock;
    private string $imagen;

    /**
     * Constructor de la clase Producto
     */
    public function __construct(
        ?int $id,
        string $nombre,
        string $descripcion,
        float $precio,
        int $stock,
        string $imagen
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->stock = $stock;
        $this->imagen = $imagen;
    }

    // Getters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    public function getPrecio(): float
    {
        return $this->precio;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function getImagen(): string
    {
        return $this->imagen;
    }

    // Setters
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function setDescripcion(string $descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    public function setPrecio(float $precio): void
    {
        $this->precio = $precio;
    }

    public function setStock(int $stock): void
    {
        $this->stock = $stock;
    }

    public function setImagen(string $imagen): void
    {
        $this->imagen = $imagen;
    }
}
