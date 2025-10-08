-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-10-2025 a las 08:38:52
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
-- Estructura de tabla para la tabla `chats`
--

CREATE TABLE `chats` (
  `id` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `id_comprador` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `chats`
--

INSERT INTO `chats` (`id`, `id_compra`, `id_comprador`, `id_vendedor`, `creado_en`) VALUES
(1, 3, 8, 3, '2025-10-07 19:54:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat_mensajes`
--

CREATE TABLE `chat_mensajes` (
  `id` int(11) NOT NULL,
  `id_chat` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `mensaje` text NOT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(2, 2, 8, 3, 'pendiente', '2025-10-01 06:39:06');

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
(1, 8, 'Xbox Controller Edicion Limitada', 1, 45.00, 10, 'controller.png', 45, 20, 'Controlador inalámbrico para Xbox', 'Controlador inalámbrico'),
(2, 8, 'Xbox Series X Galaxy Edition', 2, 400.00, 97, 'xbox.png', 45, 20, 'La Xbox Series X es la consola más potente de Microsoft, ofreciendo un rendimiento excepcional y gráficos de última generación.', 'Consola de videojuegos'),
(4, 8, 'Xbox One S', 2, 300.00, 23, 'xboxone.jpg', 0, 0, 'Consola Xbox One S de pasada generacion pero con una potencia a bajo costo', 'Consola Xbox One S'),
(5, 8, 'Xbox 360 Slim', 2, 120.00, 2, 'xbox360.png', 0, 0, 'La iconica Xbox 360 tan famosa por su control mas comodo y sus multiples juegos', 'Consola Xbox 360 Slim'),
(6, 8, 'Computadora Dell Optiplex 5040', 3, 160.00, 12, 'optiplex.png', 0, 0, 'Computadora Optiplex 5040\r\nIntel I5 de 5ta generacion\r\n8GB de Ram ddr3\r\nDisco duro de 512GB\r\nWindows 10 Pro', 'Dell Optiplex 5040'),
(7, 8, 'Laptop Hp 14', 3, 650.00, 2, 'laptopintelhp.png', 0, 0, 'Procesador hasta Intel® Core™ i7 de 13.ª generación13\r\nWindows 11**\r\nOpción de pantalla hasta 14\" (35,6 cm) en diagonal Quad HD IPS16\r\n3,09 lb (1,400 kg)\r\nHasta 16 GB de RAM DDR4\r\nHasta gráficos Intel® Iris® Xe17\r\nAlmacenamiento hasta SSD PCle® NVMe™ de 1 TB18\r\nCámara Full HD con reducción de ruido temporal', 'Laptop Hp 14 Eco Edition'),
(8, 8, 'Portátil Dell Inspiron 15.6', 3, 800.00, 12, 'dellinpiron15.png', 0, 0, 'Equipada con un procesador Intel Core i5, esta computadora portátil garantiza una multitarea fluida y un rendimiento receptivo para las tareas informáticas cotidianas, desde la navegación web hasta las aplicaciones de oficina.', 'Portátil Dell Inspiron 15.6'),
(9, 8, 'ASUS Notebook E210', 3, 650.00, 25, 'asus.jpg', 0, 0, 'Ultra Thin, procesador Intel Celeron N4020, 4GB RAM, 64GB eMMC Storage, Windows 10 Home in S Mode con un año de Office 365 Personal, E210MA-DB02, Star Black', 'ASUS Notebook E210 11.6'),
(10, 8, 'PlayStation 5 Pro 2 TB', 2, 900.00, 23, 'play5.jpeg', 0, 0, 'Sé testigo del verdadero poder de los juegos Con PlayStation 5 Pro, los creadores de juegos más importantes pueden mejorar sus juegos con increíbles funciones como trazado de rayos avanzado, claridad de imagen supe nítida para TV 4K.', 'PlayStation 5 Pro 2 TB'),
(11, 8, 'Sony PlayStation 4 (renovada)', 2, 300.00, 12, 'play4.jpeg', 0, 0, 'Mejor consola de la generacion pasada', 'Sony PlayStation 4 de 500 GB'),
(12, 8, 'Redmi 13C 256GB', 4, 180.00, 23, 'redmi13c.jpeg', 0, 0, 'Es una variante de la serie Redmi 13 con una pantalla HD+ de 6.74 con tasa de refresco de 90Hz y potenciado por un procesador MediaTek Helio G85 con hasta 8GB de RAM y 256GB de almacenamiento. ', 'Redmi 13C 256GB'),
(13, 8, 'iPhone 15 Plus', 4, 550.00, 23, 'iphone15.png', 0, 0, 'Si eres de los que buscan mayores dimensiones para mejor visualización, el iPhone 15 Plus es tu mejor elección. Destaca por su pantalla grande y brillante, su potente chip A16 Bionic, su diseño sofisticado y su increíble cámara. ', 'iPhone 15 Plus');

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
(3, 'Py', 'Duos', '50693124', 'pyduos@gmail.com', '$2y$10$HYTruXZbgypfMJlDedesb.8kikcYwy.MikCzTK/cIdovp4Q5XlXQ2', NULL, NULL, NULL, 'comprador', '2025-07-14 19:09:02', 0, 0, NULL),
(4, NULL, NULL, '12589632', 'lampicraft@gmail.com', '$2y$10$9nTIJ7PLkyzYH332nv724O/yba7UESt3L6M.U7hUkEI1J7VqvqsUu', NULL, NULL, NULL, 'comprador', '2025-07-14 22:27:56', 0, 0, NULL),
(5, NULL, NULL, '14587963', 'cachume703@gmail.com', '$2y$10$CDx4raRt1dUCtiLpM77f3.wDOX/xcqqkfsrhnoZ2hu87yCix0plmC', NULL, NULL, NULL, 'comprador', '2025-07-14 22:30:43', 0, 0, NULL),
(8, 'Albert', 'Quintero', '30506910', 'albertq703@gmail.com', '$2y$10$HYTruXZbgypfMJlDedesb.8kikcYwy.MikCzTK/cIdovp4Q5XlXQ2', NULL, NULL, NULL, 'comprador', '2025-10-01 01:41:49', 0, 0, NULL);

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
-- Indices de la tabla `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `chat_mensajes`
--
ALTER TABLE `chat_mensajes`
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
-- AUTO_INCREMENT de la tabla `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `chat_mensajes`
--
ALTER TABLE `chat_mensajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
