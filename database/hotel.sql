-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-10-2023 a las 03:16:17
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
-- Base de datos: `hotel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion`
--

CREATE TABLE `habitacion` (
  `id` int(11) NOT NULL,
  `tamaño` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `imagen` varchar(250) NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `habitacion`
--

INSERT INTO `habitacion` (`id`, `tamaño`, `descripcion`, `imagen`, `precio`) VALUES
(3, 'Doble deluxe', 'Las habitaciones cuentan con ventilador de techo, LED 32, cajas de seguridad digitales, secador de cabello, sommiers, calefacción central acceso a internet wi-fi, room service las 24 hs, servicio de lavandería, servicio de despertador, baño privado (con ducha), servicio de conserje, amenities shampoo y jabón, desayuno para celiacos incluido en la tarifa, información turística, sillas de bebé, servicio de ropa blanca, ropa de cama toallas y toallones.', 'images/habitacion_doble.jpg\r\n', 30),
(4, 'Triple superior', 'Las habitaciones cuentan con LED 32, cajas de seguridad digitales, secador de cabello, sommiers, calefacción central, acceso a internet wi-fi, room service las 24 hs, servicio de lavandería, servicio de despertador, ventilador de techo, baño privado (con ducha), servicio de conserje, amenities shampoo y jabón, desayuno para celiacos incluido en la tarifa, información turística, sillas de bebé, servicio de ropa blanca, ropa de cama toallas y toallones.', 'images/habitacion_triple.jpg\r\n', 45),
(5, 'Royal deluxe', 'Las habitaciones cuentan con LED 32, cajas de seguridad digitales, secador de cabello, sommiers, calefacción central, acceso a internet wi-fi, room service las 24 hs, servicio de lavandería, servicio de despertador,ventilador de techo, baño privado (con ducha), servicio de conserje, amenities shampoo y jabón, desayuno para celiacos incluido en la tarifa, información turística, sillas de bebé, servicio de ropa blanca, ropa de cama toallas y toallones.', 'images/habitacion_cuadruple.jpg\r\n', 60),
(7, 'Simple superior ', 'Las habitaciones cuentan con LED 32, cajas de seguridad digitales, secador de cabello, sommiers, calefacción central, acceso a internet wi-fi, room service las 24 hs, servicio de lavandería, servicio de despertador,ventilador de techo, baño privado (con ducha), servicio de conserje, amenities shampoo y jabón, desayuno para celiacos incluido en la tarifa, información turística, sillas de bebé, servicio de ropa blanca, ropa de cama toallas y toallones.', 'images/652dce871c771.jpg', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_habitacion` int(11) NOT NULL,
  `cant_noches` int(11) NOT NULL,
  `finalizada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`id`, `id_usuario`, `id_habitacion`, `cant_noches`, `finalizada`) VALUES
(58, 2, 5, 9, 0),
(59, 2, 5, 9, 0),
(60, 2, 4, 6, 0),
(61, 2, 5, 1, 0),
(62, 2, 4, 5, 0),
(67, 2, 3, 6, 0),
(68, 2, 3, 3, 0),
(70, 2, 3, 1, 0),
(71, 2, 3, 5, 0),
(73, 2, 3, 1, 0),
(75, 2, 4, 6, 0),
(79, 2, 4, 3, 1),
(80, 2, 4, 3, 1),
(81, 2, 4, 3, 1),
(84, 2, 4, 1, 1),
(86, 2, 3, 1, 0),
(88, 2, 3, 1, 0),
(89, 2, 3, 1, 1),
(90, 2, 3, 1, 0),
(94, 2, 4, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `dni` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contraseña` varchar(250) NOT NULL,
  `admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `dni`, `email`, `contraseña`, `admin`) VALUES
(1, 'usuario', '', 0, '', '$2y$10$2oKqT.Tpcj4s.VZ6njy8.e0NiFJCPO5lqbXjfM2df32128rPAFWsS', 0),
(2, 'webadmin', '', 0, '', '$2y$10$vSG5.BUGunF0bJvfXcFJluoobZ15T0bnAY340JisUI1mDvP24KZuS', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_habitaciones` (`id_habitacion`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`id_habitacion`) REFERENCES `habitacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
