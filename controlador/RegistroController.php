<?php
/**
 * RegistroController
 * Controla el alta de nuevos usuarios clientes.
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/../dao/UsuarioDAO.php";
require_once __DIR__ . "/../modelo/Usuario.php";

// Verificar que el formulario se ha enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre     = $_POST["nombre"] ?? "";
    $apellidos  = $_POST["apellidos"] ?? "";
    $email      = $_POST["email"] ?? "";
    $password   = $_POST["password"] ?? "";
    $telefono   = $_POST["telefono"] ?? null;
    $direccion  = $_POST["direccion"] ?? null;
    $rol        = "cliente";

    // Validación de campos obligatorios
    if (empty($nombre) || empty($apellidos) || empty($email) || empty($password)) {
        header("Location: /tienda_zapatillas/vistas/registro.php?error=campos_vacios");
        exit;
    }

    // Verificar si el email ya existe
    if (UsuarioDAO::emailExiste($email)) {
        header("Location: /tienda_zapatillas/vistas/registro.php?error=email_existe");
        exit;
    }

    // Crear hash seguro de la contraseña
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Crear objeto Usuario
    $usuario = new Usuario(
        null,
        $nombre,
        $apellidos,
        $email,
        $passwordHash,
        $rol,
        $telefono,
        $direccion
    );

    // Insertar usuario en la base de datos
    UsuarioDAO::insertar($usuario);

    // Redirigir al login
    header("Location: /tienda_zapatillas/vistas/login.php");
    exit;
}
