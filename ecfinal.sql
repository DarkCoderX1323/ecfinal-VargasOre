-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-08-2023 a las 22:00:52
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
CREATE DATABASE IF NOT EXISTS ecfinal;
USE ecfinal;

--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `origen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id`, `nombre`, `origen`) VALUES
(1, 'Toyota', 'Asia'),
(2, 'Ford', 'Estados Unidos'),
(3, 'Chevrolet', 'Estados Unidos'),
(4, 'Mazda', 'Asia'),
(5, 'Subaru', 'Asia'),
(6, 'Mitsubishi', 'Asia'),
(7, 'Tesla', 'Estados Unidos'),
(8, 'Audi', 'Europa'),
(9, 'Lancia', 'Europa'),
(10, 'Honda', 'Asia'),
(11, 'Nissan', 'Asia'),
(12, 'Volkswagen', 'Europa'),
(13, 'BMW', 'Europa'),
(14, 'Mercedes-Benz', 'Europa'),
(15, 'Renault', 'Europa'),
(16, 'Peugeot', 'Europa'),
(17, 'Volvo', 'Europa'),
(18, 'Fiat', 'Europa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `id` bigint(20) NOT NULL,
  `modelo` varchar(255) NOT NULL,
  `año` int(11) DEFAULT NULL,
  `precio` double NOT NULL,
  `marca_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`id`, `modelo`, `año`, `precio`, `marca_id`) VALUES
(3, 'Camaro', 2019, 32000, 3),
(4, 'Yaris', 2007, 22000, 1),
(5, 'Roadster S', 2018, 150000, 7),
(6, 'R8 GT', 2012, 250000, 8),
(14, 'GR Supra', 2022, 200000, 1),
(15, 'Corolla', 2022, 25000, 1),
(17, 'Skyline GTR (R34)', 1999, 50000, 11),
(19, 'Eclipse GT', 2006, 18000, 6),
(20, 'M3 GTR', 2005, 10000000, 13);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `marca_id` (`marca_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD CONSTRAINT `vehiculo_ibfk_1` FOREIGN KEY (`marca_id`) REFERENCES `marca` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
