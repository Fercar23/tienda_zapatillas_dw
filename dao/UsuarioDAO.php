<?php
require_once __DIR__ . "/../config/Conexion.php";
require_once __DIR__ . "/../modelo/Usuario.php";

/**
 * Clase UsuarioDAO
 * Contiene los métodos de acceso a datos relacionados con la tabla usuarios.
 */
class UsuarioDAO
{
    /**
     * Busca un usuario por su email
     * @param string $email
     * @return Usuario|null
     */
    public static function buscarPorEmail(string $email): ?Usuario
    {
        $conexion = Conexion::conectar();

        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            return new Usuario(
                $resultado["id"],
                $resultado["nombre"],
                $resultado["apellidos"],
                $resultado["email"],
                $resultado["password"],
                $resultado["rol"],
                $resultado["telefono"],
                $resultado["direccion"]
            );
        }

        return null;
    }

    /**
     * Inserta un nuevo usuario en la base de datos
     * @param Usuario $usuario
     * @return bool
     */
    public static function insertar(Usuario $usuario): bool
    {
        $conexion = Conexion::conectar();

        $sql = "INSERT INTO usuarios 
                (nombre, apellidos, email, password, rol, telefono, direccion)
                VALUES (:nombre, :apellidos, :email, :password, :rol, :telefono, :direccion)";

        $stmt = $conexion->prepare($sql);

        return $stmt->execute([
            ":nombre"    => $usuario->getNombre(),
            ":apellidos" => $usuario->getApellidos(),
            ":email"     => $usuario->getEmail(),
            ":password"  => $usuario->getPassword(),
            ":rol"       => $usuario->getRol(),
            ":telefono"  => $usuario->getTelefono(),
            ":direccion" => $usuario->getDireccion()
        ]);
    }
    /**
 * Verifica se um email já existe na base de dados
 * @param string $email
 * @return bool
 */
public static function emailExiste(string $email): bool
{
    $conexion = Conexion::conectar();

    $sql = "SELECT COUNT(*) FROM usuarios WHERE email = :email";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    return $stmt->fetchColumn() > 0;
}

}
