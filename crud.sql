-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 15-04-2020 a las 05:07:22
-- Versión del servidor: 5.7.26
-- Versión de PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `crud`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros`
--

DROP TABLE IF EXISTS `registros`;
CREATE TABLE IF NOT EXISTS `registros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `regis` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `rut` int(20) NOT NULL,
  `personal` varchar(15) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `condicion` int(10) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `registros`
--

INSERT INTO `registros` (`id`, `regis`, `fecha`, `rut`, `personal`, `estado`, `condicion`, `created_at`, `updated_at`) VALUES
(1, '444', '2020-04-11', 1313, 'externo', 'disponible', 1, '2020-04-14', '2020-04-15'),
(2, '1111', '2020-04-17', 4445, 'planta', 'disponible', 1, '2020-04-15', '2020-04-15'),
(3, '34434', '2020-04-04', 12121, 'planta', 'disponible', 1, '2020-04-15', '2020-04-15');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
