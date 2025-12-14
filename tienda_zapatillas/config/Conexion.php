<?php
/**
 * Clase Conexion
 * Se encarga de crear y devolver la conexión a la base de datos
 * utilizando PDO.
 */
class Conexion
{
    // Datos de conexión a la base de datos
    private static string $host = "localhost";
    private static string $dbname = "tienda_zapatillas";
    private static string $usuario = "root";
    private static string $password = "";

    /**
     * Devuelve una conexión PDO activa
     * @return PDO
     */
    public static function conectar(): PDO
    {
        try {
            // Cadena de conexión (DSN)
            $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$dbname . ";charset=utf8";

            // Crear la conexión PDO
            $conexion = new PDO($dsn, self::$usuario, self::$password);

            // Configurar PDO para que lance excepciones en caso de error
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conexion;

        } catch (PDOException $e) {
            // En caso de error, se detiene la ejecución y se muestra el mensaje
            die("Error de conexión: " . $e->getMessage());
        }
    }
}
