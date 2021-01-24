-- phpMyAdmin SQL Dump
-- version 4.6.6deb4+deb9u2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 24-01-2021 a las 13:43:42
-- Versión del servidor: 10.1.47-MariaDB-0+deb9u1
-- Versión de PHP: 7.0.33-0+deb9u10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pagina_simple`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE `auditoria` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_entrada` varchar(150) NOT NULL,
  `fecha_salida` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `auditoria`
--

INSERT INTO `auditoria` (`id`, `id_usuario`, `fecha_entrada`, `fecha_salida`) VALUES
(9, 2, '2021-01-24 08:43:53', '2021-01-24 09:23:32'),
(10, 3, '2021-01-24 09:23:35', '2021-01-24 10:06:57'),
(11, 2, '2021-01-24 11:39:47', '2021-01-24 12:31:45'),
(12, 3, '2021-01-24 12:31:47', '2021-01-24 12:32:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

CREATE TABLE `ticket` (
  `id_ticket` int(11) NOT NULL,
  `solicitante` int(11) NOT NULL,
  `departamento` varchar(150) NOT NULL,
  `telefono_contac` varchar(150) NOT NULL,
  `email` varchar(250) NOT NULL,
  `problema` text NOT NULL,
  `estatus` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ticket`
--

INSERT INTO `ticket` (`id_ticket`, `solicitante`, `departamento`, `telefono_contac`, `email`, `problema`, `estatus`) VALUES
(2, 3, 'hardware', '04125648975', 'lopez@gmail.com', 'mi computador no prende', 'aceptado'),
(3, 4, 'software', '04128547825', 'escamilla@gmail.com', 'el windows se reinicia', 'cerrado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `apellido` varchar(250) NOT NULL,
  `correo` varchar(250) NOT NULL,
  `contraseña` varchar(250) NOT NULL,
  `permiso` varchar(50) NOT NULL,
  `telefono_fijo` varchar(150) NOT NULL,
  `telefono_cel` varchar(150) NOT NULL,
  `direccion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `correo`, `contraseña`, `permiso`, `telefono_fijo`, `telefono_cel`, `direccion`) VALUES
(2, 'admin', 'admin', 'admin@gmail.com', '$2y$12$.AaotL4IelBqmYt.0PSVMuq/CNwBi6sPT7uUBnPLE3ziK5ss8sfNG', 'admin', '02125584589', '04124567825', 'direccion'),
(3, 'usuario', 'usuario', 'usuario@gmail.com', '$2y$12$Izjl.bfVdNKoAJLLNQQt5usungd.2ssJDTBCWO7xtF1.lA.lnIJAy', 'usuario', '', '', ''),
(4, 'usuario2', 'usuario2', 'usuario2@gmail.com', '$2y$12$Izjl.bfVdNKoAJLLNQQt5usungd.2ssJDTBCWO7xtF1.lA.lnIJAy', 'usuario', '', '', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`id_usuario`);

--
-- Indices de la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id_ticket`),
  ADD KEY `solicitante_usuario` (`solicitante`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id_ticket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD CONSTRAINT `usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `solicitante_usuario` FOREIGN KEY (`solicitante`) REFERENCES `usuario` (`id_usuario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
