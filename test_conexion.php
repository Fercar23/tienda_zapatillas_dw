<?php
require_once "dao/UsuarioDAO.php";

// Crear usuario de prueba
$usuario = new Usuario(
    null,
    "Fernanda",
    "Carvalho",
    "fernanda@test.com",
    password_hash("123456", PASSWORD_DEFAULT),
    "cliente"
);

// Insertar usuario
UsuarioDAO::insertar($usuario);

// Buscar usuario
$usuarioBD = UsuarioDAO::buscarPorEmail("fernanda@test.com");

echo $usuarioBD ? $usuarioBD->getEmail() : "Usuario no encontrado";