-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-06-2021 a las 20:19:05
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `correo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `whereis`
--

CREATE TABLE `whereis` (
  `idStage` int(19) UNSIGNED NOT NULL,
  `Stage` varchar(255) NOT NULL,
  `Avatar` int(9) NOT NULL,
  `Level` int(1) DEFAULT NULL,
  `Active` int(1) DEFAULT 1,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `whereis`
--

INSERT INTO `whereis` (`idStage`, `Stage`, `Avatar`, `Level`, `Active`, `reg_date`) VALUES
(1, 'Uff...Esta en casa, pero enojado con el mundo', 1, 1, 1, '2021-06-19 03:53:43'),
(2, 'Con otitis hay que llevarlo a la veterinaria', 2, 1, 1, '2021-06-19 02:00:32'),
(3, '¡Ojo! Esta con ganas de saltar del balcon (miedo)', 3, 1, 1, '2021-06-19 03:54:07'),
(4, 'Con hambre dale de comer...', 4, 1, 1, '2021-06-19 03:54:16'),
(5, 'Con mucho sueño hoy tuvo un día largo', 5, 1, 1, '2021-06-19 03:54:30'),
(6, 'Tranqui, esta bañandose sentado', 6, 1, 1, '2021-06-19 03:54:45'),
(7, 'Sentado y cansado de que le saquen fotos', 7, 1, 1, '2021-06-19 03:54:58'),
(8, 'Esta esperando que le hagan mimos', 8, 1, 1, '2021-06-19 03:55:11'),
(9, 'No te asustes, esta durmiendo entre almohadas', 9, 1, 1, '2021-06-19 03:55:25'),
(10, 'Parece que esta triste porque se le acabo la comida', 10, 1, 1, '2021-06-19 03:55:40'),
(11, 'Es un gran dia y esta esperandote para dormir con vos', 11, 1, 1, '2021-06-19 03:55:55'),
(12, 'Bueno bien, esta en casa pero bastante estresado de la vida', 12, 1, 1, '2021-06-19 03:56:09'),
(13, 'Ahora esta durmiendo hecho una bolita', 13, 1, 1, '2021-06-19 03:56:19'),
(14, 'Esperando que te despiertes y le des de comer', 14, 1, 1, '2021-06-19 03:56:26'),
(15, 'No hay nade de que preocuparse, sigue durmiendo la siesta', 15, 1, 1, '2021-06-19 03:56:41'),
(16, 'Relax esta durmiendo en el balcón', 16, 1, 1, '2021-06-19 03:57:36'),
(17, 'Safaste esta durmiendo y en pose rara', 17, 1, 1, '2021-06-19 03:57:21'),
(18, 'Ups! Esta ves se te escapo puede estar afuera varios dias', 18, 1, 1, '2021-06-19 04:02:58'),
(19, 'Ouch! Se escapo de nuevo, pero quias vuelva pronto', 19, 1, 1, '2021-06-19 04:05:38'),
(20, 'Nooooo! Se escapo y ahora que haremos?', 20, 1, 1, '2021-06-19 04:05:38');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `whereis`
--
ALTER TABLE `whereis`
  ADD PRIMARY KEY (`idStage`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `whereis`
--
ALTER TABLE `whereis`
  MODIFY `idStage` int(19) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
