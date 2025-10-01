-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-10-2025 a las 09:03:58
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
-- Base de datos: `mercazone`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Accesorios'),
(2, 'Consolas'),
(3, 'Computadores y Laptops'),
(4, 'Telefonos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_comprador` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `estado` enum('pendiente','entregado','cancelado') DEFAULT 'pendiente',
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `id_producto`, `id_comprador`, `cantidad`, `estado`, `creado_en`) VALUES
(2, 2, 8, 3, 'pendiente', '2025-10-01 06:39:06'),
(3, 2, 8, 3, 'pendiente', '2025-10-01 06:49:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `view` int(11) DEFAULT 0,
  `sales` int(11) DEFAULT 0,
  `description` text DEFAULT NULL,
  `short_description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `id_user`, `name`, `category`, `price`, `stock`, `image`, `view`, `sales`, `description`, `short_description`) VALUES
(1, 101, 'Xbox Controller Edicion Limitada', 1, 45.00, 10, 'controller.png', 45, 20, 'Controlador inalámbrico para Xbox', 'Controlador inalámbrico'),
(2, 101, 'Xbox Series X Galaxy Edition', 2, 400.00, 97, 'xbox.png', 45, 20, 'La Xbox Series X es la consola más potente de Microsoft, ofreciendo un rendimiento excepcional y gráficos de última generación.', 'Consola de videojuegos');

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
(1, '', '', '30506919', 'albertq703@gmail.co', '$2y$10$1swy70a6RysFs3jgcxFrQef9MnFUAEMbNo84METgSEsSLFN3YmrvS', NULL, NULL, NULL, 'admin', '2025-06-25 01:25:40', 0, 0, NULL),
(2, NULL, NULL, '30506911', 'albert@gmail.com', '$2y$10$6toXCTKGZEm3xt/TwQvlAefzXsL7hSqlG2TR9fhu43FH7Zaw5qwqi', NULL, NULL, NULL, 'comprador', '2025-07-09 23:32:10', 0, 0, NULL),
(3, NULL, NULL, '50693124', 'pyduos@gmail.com', '$2y$10$18aIujcz7YmoBofYVJ1UUuwmhgVUY1.XjoO8G2HDL/f7.SQbz7Hg6', NULL, NULL, NULL, 'comprador', '2025-07-14 19:09:02', 0, 0, NULL),
(4, NULL, NULL, '12589632', 'lampicraft@gmail.com', '$2y$10$9nTIJ7PLkyzYH332nv724O/yba7UESt3L6M.U7hUkEI1J7VqvqsUu', NULL, NULL, NULL, 'comprador', '2025-07-14 22:27:56', 0, 0, NULL),
(5, NULL, NULL, '14587963', 'cachume703@gmail.com', '$2y$10$CDx4raRt1dUCtiLpM77f3.wDOX/xcqqkfsrhnoZ2hu87yCix0plmC', NULL, NULL, NULL, 'comprador', '2025-07-14 22:30:43', 0, 0, NULL),
(8, NULL, NULL, '30506910', 'albertq703@gmail.com', '$2y$10$HYTruXZbgypfMJlDedesb.8kikcYwy.MikCzTK/cIdovp4Q5XlXQ2', NULL, NULL, NULL, 'comprador', '2025-10-01 01:41:49', 0, 0, NULL);

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
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `verificaciones`
--
ALTER TABLE `verificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
