-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-07-2025 a las 06:22:11
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mercazone`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellidos` varchar(80) DEFAULT NULL,
  `cedula` varchar(20) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `rol` enum('comprador','vendedor','admin') DEFAULT 'comprador',
  `fecha_registro` datetime DEFAULT current_timestamp(),
  `intentos_fallidos` int(11) DEFAULT 0,
  `cuenta_bloqueada` tinyint(1) DEFAULT 0,
  `tiempo_bloqueo` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `cedula`, `correo`, `contrasena`, `foto_perfil`, `telefono`, `direccion`, `rol`, `fecha_registro`, `intentos_fallidos`, `cuenta_bloqueada`, `tiempo_bloqueo`) VALUES
(1, '', '', '30506910', 'albertq703@gmail.com', '$2y$10$1swy70a6RysFs3jgcxFrQef9MnFUAEMbNo84METgSEsSLFN3YmrvS', NULL, NULL, NULL, 'admin', '2025-06-25 01:25:40', 0, 0, NULL),
(2, NULL, NULL, '30506911', 'albert@gmail.com', '$2y$10$6toXCTKGZEm3xt/TwQvlAefzXsL7hSqlG2TR9fhu43FH7Zaw5qwqi', NULL, NULL, NULL, 'comprador', '2025-07-09 23:32:10', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `verificaciones`
--

CREATE TABLE `verificaciones` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `tipo_documento` enum('cedula','pasaporte') NOT NULL,
  `numero_documento` varchar(20) NOT NULL,
  `cedula_frontal` varchar(255) DEFAULT NULL,
  `cedula_reverso` varchar(255) DEFAULT NULL,
  `pasaporte_imagen` varchar(255) DEFAULT NULL,
  `selfie_imagen` varchar(255) NOT NULL,
  `estado` enum('pendiente','aprobado','rechazado') DEFAULT 'pendiente',
  `fecha_envio` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_revision` timestamp NULL DEFAULT NULL,
  `revisado_por` int(11) DEFAULT NULL,
  `comentarios` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `verificaciones`
--

INSERT INTO `verificaciones` (`id`, `usuario_id`, `tipo_documento`, `numero_documento`, `cedula_frontal`, `cedula_reverso`, `pasaporte_imagen`, `selfie_imagen`, `estado`, `fecha_envio`, `fecha_revision`, `revisado_por`, `comentarios`) VALUES
(1, 1, 'cedula', '30506910', 'assets/verificaciones/686f1eb43b5f8_cedulafrontal.jpg', 'assets/verificaciones/686f1eb43b742_cedulatrasera.jpg', NULL, 'assets/verificaciones/686f1eb43b45f_foto.jpg', 'pendiente', '2025-07-10 02:00:20', NULL, NULL, NULL),
(4, 2, 'cedula', '30506911', 'assets/verificaciones/686f3ee98956a_cedulafrontal.jpg', 'assets/verificaciones/686f3ee989770_cedulatrasera.jpg', NULL, 'assets/verificaciones/686f3ee9892e5_foto.jpg', 'pendiente', '2025-07-10 04:17:45', NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cedula` (`cedula`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `verificaciones`
--
ALTER TABLE `verificaciones`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `verificaciones`
--
ALTER TABLE `verificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
