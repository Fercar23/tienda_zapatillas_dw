-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-12-2025 a las 12:13:43
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_zapatillas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `id_detalle` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_pedido` timestamp NOT NULL DEFAULT current_timestamp(),
  `total` decimal(10,2) NOT NULL,
  `estado` enum('pendiente','pagado','enviado','cancelado') DEFAULT 'pendiente',
  `direccion_envio` text DEFAULT NULL,
  `metodo_pago` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(8,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `imagen_url` varchar(255) DEFAULT NULL,
  `categoria` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `descripcion`, `precio`, `stock`, `imagen_url`, `categoria`) VALUES
(1, 'Nike Air Teste', 'Zapatilla deportiva Nike', 59.90, 10, 'nike.jpg', 'Deportivas'),
(2, 'Puma Running', 'Zapatilla running Puma', 49.90, 15, 'puma.jpg', 'Running'),
(3, 'Nike Air Force', 'Nike ', 120.00, 20, 'Air_Force.jpg', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `rol` enum('admin','cliente') NOT NULL DEFAULT 'cliente',
  `telefono` varchar(30) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `email`, `password`, `rol`, `telefono`, `direccion`, `fecha_creacion`) VALUES
(1, 'Admin', 'Tienda', 'admin@tienda.com', '$2y$10$MiJrFsY84yJwiRNM6YkodJUCSuyO1MNFFGx8gNLFKm...', 'admin', '000000000', 'Dirección admin', '2025-12-12 20:09:20'),
(2, 'Cliente', 'Prueba', 'cliente@tienda.com', '$2y$10$Z8YyNQhYFgMhNOyrhgVe7cGMjcT27k...', 'cliente', '666666666', 'Calle cliente 123', '2025-12-12 20:09:20'),
(5, 'Fernanda', 'Carvalho', 'fernanda@test.com', '$2y$10$5R/dQaqKfnE84ziiY/R5w.dwx5pV9M/Iyth7gSs2XCHty3fCNbSOe', 'cliente', NULL, NULL, '2025-12-13 10:23:00'),
(6, 'Juca', 'Carvalho ', 'juca123@gmail.com', '$2y$10$06p12yfrk7tQdUYMsDyzPOXQpMUzLCo0YvFrwuDr4uk5FNramHZKy', 'admin', '666657894', 'calle looo 147', '2025-12-13 13:42:42'),
(7, 'Fernanda', 'daaaa', 'cliente1@teste.com', '$2y$10$rKHYCnIssISQl6NSEgdcbuFmxPa/lObH5/LyaqJT/5NP8GTyX3wcG', 'cliente', '66668888', 'calle looo 147', '2025-12-13 19:16:07');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `fk_detalle_pedido` (`id_pedido`),
  ADD KEY `fk_detalle_producto` (`id_producto`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `fk_pedidos_usuario` (`id_usuario`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `fk_detalle_pedido` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_detalle_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_pedidos_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
