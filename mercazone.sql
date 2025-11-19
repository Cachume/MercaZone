-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-11-2025 a las 13:44:27
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

--
-- Volcado de datos para la tabla `chat_mensajes`
--

INSERT INTO `chat_mensajes` (`id`, `id_chat`, `id_usuario`, `mensaje`, `creado_en`) VALUES
(4, 1, 12, 'a', '2025-11-08 17:53:03'),
(5, 1, 12, 'asd', '2025-11-08 17:53:38'),
(6, 4, 12, 'pruebas', '2025-11-08 17:54:03'),
(7, 0, 12, '', '2025-11-08 23:56:31'),
(8, 0, 12, '', '2025-11-08 23:56:35'),
(9, 4, 12, 'a', '2025-11-08 23:58:56'),
(10, 4, 12, 'asdasd', '2025-11-08 23:59:06'),
(11, 4, 12, 'asdasdasd', '2025-11-08 23:59:12'),
(12, 4, 12, 'asdasd', '2025-11-09 00:03:37'),
(13, 4, 12, 'Hola como estas amigo', '2025-11-09 00:03:44'),
(14, 4, 8, 'Como estas amigo', '2025-11-09 00:05:06'),
(15, 4, 8, 'Dime en que puedo ayudarte', '2025-11-09 00:05:18'),
(16, 2, 8, 'asd', '2025-11-09 00:17:25'),
(17, 4, 8, 'sda', '2025-11-09 00:17:38'),
(18, 4, 8, 'Que onda bro', '2025-11-09 00:17:42'),
(19, 4, 8, 'A que hora vas a recibir tu producto', '2025-11-09 00:17:56'),
(20, 4, 8, 'Y donde obviamente', '2025-11-09 00:18:07'),
(21, 4, 12, 'Hola Albert Colina', '2025-11-09 00:22:28'),
(22, 4, 12, 'Como estas amigo que cuentas', '2025-11-09 00:22:39'),
(23, 4, 8, 'Quiero comprar la consola, haces envios?', '2025-11-09 00:22:52'),
(24, 4, 12, 'Claaaro hacemos envios a todo el territorio venezolano', '2025-11-09 00:23:10'),
(25, 4, 12, 'Mandame tus datos y coordinamos', '2025-11-09 00:23:19'),
(26, 4, 8, 'mainkla', '2025-11-09 01:31:37'),
(27, 4, 12, 'ASDASD', '2025-11-09 01:37:36'),
(28, 4, 12, 'UHFDFAFHIOPFHIFAHIAFHIAF', '2025-11-09 01:37:45'),
(29, 6, 13, 'asd', '2025-11-10 04:58:35'),
(30, 2, 8, 'Hooola amigo', '2025-11-11 02:08:57'),
(31, 2, 8, 'No me has comentado nada del producto', '2025-11-11 02:09:07'),
(32, 6, 8, 'Hola que tal', '2025-11-11 03:58:27'),
(33, 6, 8, 'Mucho gusto hahaha tremendo el chat funciona hahahaha', '2025-11-11 03:58:40'),
(34, 6, 8, 'Que tal amigo', '2025-11-11 04:01:58'),
(35, 6, 8, 'Que cuentas', '2025-11-11 04:02:03'),
(36, 2, 8, 'Hola amigo', '2025-11-17 17:41:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_comprador` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `descuento` int(11) DEFAULT NULL,
  `estado` enum('pendiente','entregado','cancelado') DEFAULT 'pendiente',
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `id_producto`, `id_comprador`, `cantidad`, `descuento`, `estado`, `creado_en`) VALUES
(2, 2, 8, 3, NULL, 'pendiente', '2025-11-01 06:39:06'),
(4, 12, 12, 1, NULL, 'pendiente', '2025-11-08 17:35:46'),
(5, 2, 12, 10, NULL, 'pendiente', '2025-11-09 01:41:50'),
(6, 1, 13, 1, NULL, 'pendiente', '2025-11-10 04:58:27'),
(7, 1, 8, 1, 7, 'pendiente', '2025-11-17 22:36:10'),
(8, 5, 12, 1, 3, 'pendiente', '2025-11-17 23:43:39'),
(9, 5, 12, 2, 1, 'pendiente', '2025-11-17 23:46:09'),
(10, 6, 12, 5, NULL, 'pendiente', '2025-11-17 23:47:46'),
(11, 6, 13, 3, 2, 'pendiente', '2025-11-18 02:21:33'),
(12, 5, 13, 1, NULL, 'pendiente', '2025-11-18 02:26:03'),
(13, 8, 13, 11, NULL, 'pendiente', '2025-11-18 02:26:19'),
(14, 5, 8, 1, NULL, 'pendiente', '2025-11-18 13:34:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuentos`
--

CREATE TABLE `descuentos` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_adm` int(11) NOT NULL,
  `porcentaje` int(11) NOT NULL,
  `comentario` text DEFAULT NULL,
  `usado` tinyint(4) DEFAULT 0,
  `creado_en` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `descuentos`
--

INSERT INTO `descuentos` (`id`, `id_user`, `id_adm`, `porcentaje`, `comentario`, `usado`, `creado_en`) VALUES
(1, 12, 8, 12, '0', 1, '2025-11-17 17:01:37'),
(2, 13, 8, 23, '0', 1, '2025-11-17 17:02:04'),
(3, 12, 8, 23, NULL, 1, '2025-11-17 17:02:49'),
(7, 8, 8, 50, '0', 0, '2025-11-17 17:16:23'),
(8, 12, 8, 25, '0', 0, '2025-11-17 22:30:49');

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
(1, 8, 'Xbox Controller Edicion Limitada', 1, 45.00, 8, 'controller.png', 45, 20, 'Controlador inalámbrico para Xbox', 'Controlador inalámbrico'),
(2, 8, 'Xbox Series X Galaxy Edition', 2, 400.00, 81, 'xbox.png', 45, 20, 'La Xbox Series X es la consola más potente de Microsoft, ofreciendo un rendimiento excepcional y gráficos de última generación.', 'Consola de videojuegos'),
(4, 8, 'Xbox One S', 2, 300.00, 23, 'xboxone.jpg', 0, 0, 'Consola Xbox One S de pasada generacion pero con una potencia a bajo costo', 'Consola Xbox One S'),
(5, 8, 'Xbox 360 Slim', 2, 120.00, 0, 'xbox360.png', 0, 0, 'La iconica Xbox 360 tan famosa por su control mas comodo y sus multiples juegos', 'Consola Xbox 360 Slim'),
(6, 8, 'Computadora Dell Optiplex 5040', 3, 160.00, 7, 'optiplex.png', 0, 0, 'Computadora Optiplex 5040\r\nIntel I5 de 5ta generacion\r\n8GB de Ram ddr3\r\nDisco duro de 512GB\r\nWindows 10 Pro', 'Dell Optiplex 5040'),
(7, 8, 'Laptop Hp 14', 3, 650.00, 2, 'laptopintelhp.png', 0, 0, 'Procesador hasta Intel® Core™ i7 de 13.ª generación13\r\nWindows 11**\r\nOpción de pantalla hasta 14\" (35,6 cm) en diagonal Quad HD IPS16\r\n3,09 lb (1,400 kg)\r\nHasta 16 GB de RAM DDR4\r\nHasta gráficos Intel® Iris® Xe17\r\nAlmacenamiento hasta SSD PCle® NVMe™ de 1 TB18\r\nCámara Full HD con reducción de ruido temporal', 'Laptop Hp 14 Eco Edition'),
(8, 8, 'Portátil Dell Inspiron 15.6', 3, 800.00, 1, 'dellinpiron15.png', 0, 0, 'Equipada con un procesador Intel Core i5, esta computadora portátil garantiza una multitarea fluida y un rendimiento receptivo para las tareas informáticas cotidianas, desde la navegación web hasta las aplicaciones de oficina.', 'Portátil Dell Inspiron 15.6'),
(9, 8, 'ASUS Notebook E210', 3, 650.00, 25, 'asus.jpg', 0, 0, 'Ultra Thin, procesador Intel Celeron N4020, 4GB RAM, 64GB eMMC Storage, Windows 10 Home in S Mode con un año de Office 365 Personal, E210MA-DB02, Star Black', 'ASUS Notebook E210 11.6'),
(10, 8, 'PlayStation 5 Pro 2 TB', 2, 900.00, 23, 'play5.jpeg', 0, 0, 'Sé testigo del verdadero poder de los juegos Con PlayStation 5 Pro, los creadores de juegos más importantes pueden mejorar sus juegos con increíbles funciones como trazado de rayos avanzado, claridad de imagen supe nítida para TV 4K.', 'PlayStation 5 Pro 2 TB'),
(11, 8, 'Sony PlayStation 4 (renovada)', 2, 300.00, 12, 'play4.jpeg', 0, 0, 'Mejor consola de la generacion pasada', 'Sony PlayStation 4 de 500 GB'),
(12, 8, 'Redmi 13C 256GB', 4, 180.00, 22, 'redmi13c.jpeg', 0, 0, 'Es una variante de la serie Redmi 13 con una pantalla HD+ de 6.74 con tasa de refresco de 90Hz y potenciado por un procesador MediaTek Helio G85 con hasta 8GB de RAM y 256GB de almacenamiento. ', 'Redmi 13C 256GB'),
(13, 8, 'iPhone 15 Plus', 4, 550.00, 23, 'iphone15.png', 0, 0, 'Si eres de los que buscan mayores dimensiones para mejor visualización, el iPhone 15 Plus es tu mejor elección. Destaca por su pantalla grande y brillante, su potente chip A16 Bionic, su diseño sofisticado y su increíble cámara. ', 'iPhone 15 Plus');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_tags`
--

CREATE TABLE `productos_tags` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `tag` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos_tags`
--

INSERT INTO `productos_tags` (`id`, `id_producto`, `tag`) VALUES
(76, 1, 'xbox'),
(77, 1, 'control inalámbrico'),
(78, 1, 'mando xbox'),
(79, 1, 'gamers'),
(80, 1, 'edición limitada'),
(81, 1, 'joystick'),
(82, 2, 'xbox'),
(83, 2, 'series x'),
(84, 2, 'galaxy edition'),
(85, 2, 'consola'),
(86, 2, 'gaming'),
(87, 2, 'nueva generación'),
(88, 2, 'videojuegos'),
(89, 3, 'xbox one'),
(90, 3, 'one s'),
(91, 3, 'consola'),
(92, 3, 'gaming'),
(93, 3, 'videojuegos'),
(94, 3, 'microsoft'),
(95, 4, 'xbox 360'),
(96, 4, 'slim'),
(97, 4, 'retro gaming'),
(98, 4, 'consola'),
(99, 4, 'videojuegos'),
(100, 5, 'dell'),
(101, 5, 'optiplex'),
(102, 5, 'computadora'),
(103, 5, 'pc de escritorio'),
(104, 5, 'oficina'),
(105, 5, 'intel'),
(106, 6, 'laptop'),
(107, 6, 'hp'),
(108, 6, 'portátil'),
(109, 6, 'core i7'),
(110, 6, 'computadora'),
(111, 6, 'oficina'),
(112, 6, 'estudios'),
(113, 7, 'laptop'),
(114, 7, 'dell'),
(115, 7, 'inspiron'),
(116, 7, 'portátil'),
(117, 7, 'core i5'),
(118, 7, 'estudiante'),
(119, 7, 'trabajo'),
(120, 8, 'asus'),
(121, 8, 'notebook'),
(122, 8, 'ultraportátil'),
(123, 8, 'estudiantes'),
(124, 8, 'liviana'),
(125, 8, 'económica'),
(126, 9, 'ps5'),
(127, 9, 'playstation 5'),
(128, 9, 'sony'),
(129, 9, 'gaming'),
(130, 9, 'pro'),
(131, 9, 'videojuegos'),
(132, 9, '2tb'),
(133, 10, 'ps4'),
(134, 10, 'playstation 4'),
(135, 10, 'sony'),
(136, 10, 'renovada'),
(137, 10, 'gaming'),
(138, 10, 'videojuegos'),
(139, 11, 'xiaomi'),
(140, 11, 'redmi 13c'),
(141, 11, 'smartphone'),
(142, 11, 'android'),
(143, 11, '256gb'),
(144, 11, 'teléfono'),
(145, 12, 'iphone'),
(146, 12, 'iphone 15 plus'),
(147, 12, 'apple'),
(148, 12, 'smartphone premium'),
(149, 12, 'ios'),
(150, 12, 'celular');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `rol_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `rol_name`) VALUES
(1, 'Administrador'),
(2, 'Verificado'),
(3, 'No Verificado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellidos` varchar(80) DEFAULT NULL,
  `type_dni` text NOT NULL,
  `cedula` varchar(20) DEFAULT NULL,
  `cumpleanos` datetime DEFAULT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `token` varchar(255) NOT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `rol` int(11) NOT NULL DEFAULT 3,
  `fecha_registro` datetime DEFAULT current_timestamp(),
  `intentos_fallidos` int(11) DEFAULT 0,
  `cuenta_bloqueada` tinyint(1) DEFAULT 0,
  `tiempo_bloqueo` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `type_dni`, `cedula`, `cumpleanos`, `correo`, `contrasena`, `active`, `token`, `foto_perfil`, `telefono`, `direccion`, `rol`, `fecha_registro`, `intentos_fallidos`, `cuenta_bloqueada`, `tiempo_bloqueo`) VALUES
(3, 'Py', 'Duos', 'E', '50693124', NULL, 'pyduos@gmail.com', '$2y$10$HYTruXZbgypfMJlDedesb.8kikcYwy.MikCzTK/cIdovp4Q5XlXQ2', 0, '', NULL, NULL, NULL, 3, '2025-07-14 19:09:02', 0, 0, NULL),
(8, 'Albert', 'Quintero', 'V', '30506910', NULL, 'albertq703@gmail.com', '$2y$10$kYfXFgmaZl90UW8bURx2POlViG0Ofi4rQk58QvsW/DIsGGnCT.1z6', 0, '', 'assets/uploads/usersgoogle/user_b2e8266f3fc8ba2f4a254bdf33ca8300.jpg', NULL, NULL, 1, '2025-10-01 01:41:49', 0, 0, NULL),
(12, 'Albert', 'Colina', 'V', '25486321', '2003-02-10 00:00:00', 'albertcolina22@gmail.com', '$2y$10$MBE5Ei/e9RMjQQuEA7TaxuImV7i6.FueuhZF6bb.eJT/3P/t9ItEm', 1, '', 'assets/uploads/usersgoogle/user_087044a2cb4950bc227659508216f1a6.jpg', NULL, NULL, 3, '2025-11-04 15:01:21', 0, 0, NULL),
(13, 'Evelin', 'Colina', 'V', '34134094', '2011-09-06 00:00:00', 'albertquintero8262@gmail.com', '$2y$10$kYfXFgmaZl90UW8bURx2POlViG0Ofi4rQk58QvsW/DIsGGnCT.1z6', 1, '', 'assets/uploads/usersgoogle/user_21241277c920ebcb8f4c11f2f7373443.jpg', NULL, NULL, 3, '2025-11-08 23:56:02', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `verificaciones`
--

CREATE TABLE `verificaciones` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `cedula_frontal` varchar(255) NOT NULL,
  `estado` enum('pendiente','aprobado','rechazado') DEFAULT 'pendiente',
  `fecha_envio` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_revision` timestamp NULL DEFAULT NULL,
  `revisado_por` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `verificaciones`
--

INSERT INTO `verificaciones` (`id`, `usuario_id`, `cedula_frontal`, `estado`, `fecha_envio`, `fecha_revision`, `revisado_por`) VALUES
(1, 1, 'assets/verificaciones/686f1eb43b5f8_cedulafrontal.jpg', 'pendiente', '2025-07-10 02:00:20', NULL, NULL),
(4, 2, 'assets/verificaciones/686f3ee98956a_cedulafrontal.jpg', 'pendiente', '2025-07-10 04:17:45', NULL, NULL),
(6, 13, 'assets/verificaciones/img_69116ebf167397.48819713.jpg', 'pendiente', '2025-11-10 04:49:03', NULL, NULL),
(7, 8, 'assets/verificaciones/img_691b5e79a9faa2.04370431.jpg', 'pendiente', '2025-11-17 17:42:17', NULL, NULL);

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
-- Indices de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos_tags`
--
ALTER TABLE `productos_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `productos_tags`
--
ALTER TABLE `productos_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `verificaciones`
--
ALTER TABLE `verificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
