-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: mercazone
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compras`
--

DROP TABLE IF EXISTS `compras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL,
  `id_comprador` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `estado` enum('pendiente','entregado','cancelado') DEFAULT 'pendiente',
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compras`
--

LOCK TABLES `compras` WRITE;
/*!40000 ALTER TABLE `compras` DISABLE KEYS */;
/*!40000 ALTER TABLE `compras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `fecha_publicacion` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `tiempo_bloqueo` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cedula` (`cedula`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'','','30506910','albertq703@gmail.com','$2y$10$1swy70a6RysFs3jgcxFrQef9MnFUAEMbNo84METgSEsSLFN3YmrvS',NULL,NULL,NULL,'admin','2025-06-25 01:25:40',0,0,NULL),(2,NULL,NULL,'30506911','albert@gmail.com','$2y$10$6toXCTKGZEm3xt/TwQvlAefzXsL7hSqlG2TR9fhu43FH7Zaw5qwqi',NULL,NULL,NULL,'comprador','2025-07-09 23:32:10',0,0,NULL),(3,NULL,NULL,'50693124','pyduos@gmail.com','$2y$10$18aIujcz7YmoBofYVJ1UUuwmhgVUY1.XjoO8G2HDL/f7.SQbz7Hg6',NULL,NULL,NULL,'comprador','2025-07-14 19:09:02',0,0,NULL),(4,NULL,NULL,'12589632','lampicraft@gmail.com','$2y$10$9nTIJ7PLkyzYH332nv724O/yba7UESt3L6M.U7hUkEI1J7VqvqsUu',NULL,NULL,NULL,'comprador','2025-07-14 22:27:56',0,0,NULL),(5,NULL,NULL,'14587963','cachume703@gmail.com','$2y$10$CDx4raRt1dUCtiLpM77f3.wDOX/xcqqkfsrhnoZ2hu87yCix0plmC',NULL,NULL,NULL,'comprador','2025-07-14 22:30:43',0,0,NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `verificaciones`
--

DROP TABLE IF EXISTS `verificaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `verificaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `comentarios` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `verificaciones`
--

LOCK TABLES `verificaciones` WRITE;
/*!40000 ALTER TABLE `verificaciones` DISABLE KEYS */;
INSERT INTO `verificaciones` VALUES (1,1,'cedula','30506910','assets/verificaciones/686f1eb43b5f8_cedulafrontal.jpg','assets/verificaciones/686f1eb43b742_cedulatrasera.jpg',NULL,'assets/verificaciones/686f1eb43b45f_foto.jpg','pendiente','2025-07-10 02:00:20',NULL,NULL,NULL),(4,2,'cedula','30506911','assets/verificaciones/686f3ee98956a_cedulafrontal.jpg','assets/verificaciones/686f3ee989770_cedulatrasera.jpg',NULL,'assets/verificaciones/686f3ee9892e5_foto.jpg','pendiente','2025-07-10 04:17:45',NULL,NULL,NULL);
/*!40000 ALTER TABLE `verificaciones` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-09-19 23:10:34
