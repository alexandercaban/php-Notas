-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-06-2017 a las 00:04:33
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 7.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `notas_aprendices`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbcentro`
--

CREATE TABLE `tbcentro` (
  `nombre_centro` varchar(500) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbcentro`
--

INSERT INTO `tbcentro` (`nombre_centro`, `id`) VALUES
('CEAI', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbimagen`
--

CREATE TABLE `tbimagen` (
  `id` int(11) NOT NULL,
  `ruta_imagen` text NOT NULL,
  `id_nota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbnotas`
--

CREATE TABLE `tbnotas` (
  `id` int(11) NOT NULL,
  `tipo_nota` tinyint(11) NOT NULL,
  `nota` varchar(5000) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `anonimo` tinyint(1) NOT NULL,
  `latitud` double NOT NULL,
  `longitud` double NOT NULL,
  `imagen` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbnotas`
--

INSERT INTO `tbnotas` (`id`, `tipo_nota`, `nota`, `id_usuario`, `anonimo`, `latitud`, `longitud`, `imagen`) VALUES
(1, 1, 'hola mundo', 1, 1, 1452, 2010, ''),
(2, 1, 'lero lero', 1, 1, 0, 0, ''),
(3, 3, 'vamos a ver', 1, 1, 0, 0, ''),
(4, 2, 'algo aquÃ­', 1, 1, 0, 0, ''),
(5, 3, 'sugiero algo', 1, 1, 0, 0, ''),
(6, 3, 'la nota de hoy', 0, 1, 0, 0, ''),
(7, 4, 'manejando la situaciÃ³n', 1, 1, 0, 0, ''),
(8, 3, 'nuevamente la situaciÃ³n Ã‘Ã‘Ã‘', 1, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbusuarios`
--

CREATE TABLE `tbusuarios` (
  `id` int(11) NOT NULL,
  `nombre_completo` varchar(1000) NOT NULL,
  `correo` varchar(1000) NOT NULL,
  `contrasena` varchar(50) NOT NULL,
  `estado` tinyint(11) NOT NULL,
  `unco_centro` int(11) NOT NULL,
  `tipo_usuario` tinyint(11) NOT NULL,
  `guid` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbusuarios`
--

INSERT INTO `tbusuarios` (`id`, `nombre_completo`, `correo`, `contrasena`, `estado`, `unco_centro`, `tipo_usuario`, `guid`) VALUES
(1, 'yeison', '1', '1', 1, 0, 0, '383a9c13-aaac-4d36-beb1-58b3dad7ca76'),
(2, 'juan', 'ab', '1', 0, 1, 0, 'bdb968e0-0d83-45ae-b9ec-754688ad6eb3'),
(3, 'cd', '1', '1', 0, 1, 0, 'ce92ad9f-aafa-4c2a-8c99-3b0bae5efaf6'),
(4, 'yeisonGarcia', '2323', '1', 0, 1, 0, '3b8e1f26-66f7-45e7-8477-68c8208f93df'),
(5, 'usuar1', '8', '8', 0, 1, 0, '3bcdd8de-f3a3-4186-bf2c-b0920b9c4520'),
(6, '122', '44', '1', 0, 1, 0, '9787a8fd-e125-4652-b5c2-7ed8d05fcd67'),
(7, 'ii', 'iojo', '1', 0, 1, 0, '40f9379f-48da-44ad-a8b9-67e910770098');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbcentro`
--
ALTER TABLE `tbcentro`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbimagen`
--
ALTER TABLE `tbimagen`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbnotas`
--
ALTER TABLE `tbnotas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbusuarios`
--
ALTER TABLE `tbusuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbcentro`
--
ALTER TABLE `tbcentro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tbimagen`
--
ALTER TABLE `tbimagen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbnotas`
--
ALTER TABLE `tbnotas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `tbusuarios`
--
ALTER TABLE `tbusuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
