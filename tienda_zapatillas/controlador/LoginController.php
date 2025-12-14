<?php
/**
 * LoginController
 * Controla el proceso de autenticación de usuarios y
 * la creación de la sesión en la aplicación.
 * 
 * Este archivo pertenece a la capa de lógica de negocio.
 */

// Mostrar errores (solo para desarrollo)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Iniciar la sesión
session_start();

// Incluir acceso a datos de usuarios
require_once __DIR__ . "/../dao/UsuarioDAO.php";

// Verificar que el formulario se ha enviado mediante POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Recoger los datos enviados desde el formulario
    $email = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";

    // Validación básica de campos obligatorios
    if (empty($email) || empty($password)) {
        header("Location: /tienda_zapatillas/vistas/login.php?error=campos_vacios");
        exit;
    }

    // Buscar el usuario en la base de datos por email
    $usuario = UsuarioDAO::buscarPorEmail($email);

    // Verificar que el usuario existe y que la contraseña es correcta
    if ($usuario && password_verify($password, $usuario->getPassword())) {

        // Crear variables de sesión
        $_SESSION["usuario_id"] = $usuario->getId();
        $_SESSION["usuario_nombre"] = $usuario->getNombre();
        $_SESSION["usuario_rol"] = $usuario->getRol();

        // Redirigir al panel principal (dashboard)
        header("Location: /tienda_zapatillas/vistas/dashboard.php");
        exit;

    } else {
        // Credenciales incorrectas
        header("Location: /tienda_zapatillas/vistas/login.php?error=credenciales");
        exit;
    }
}

