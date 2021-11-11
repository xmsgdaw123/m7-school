-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2021 a las 14:28:44
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `m7_a2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `modules`
--

INSERT INTO `modules` (`id`, `code`, `name`, `description`) VALUES
(1, 'M05', 'Entorns de desenvolupament', 'Gestió dels Entorns de Desenvolupament'),
(2, 'M06', 'Desenvolupament web', 'Desenvolupament web en entorn client');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moduleusers`
--

CREATE TABLE `moduleusers` (
  `id` int(11) NOT NULL,
  `moduleId` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `moduleusers`
--

INSERT INTO `moduleusers` (`id`, `moduleId`, `userId`) VALUES
(8, 1, 3),
(9, 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `taskitems`
--

CREATE TABLE `taskitems` (
  `id` int(11) NOT NULL,
  `taskId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `submitted` tinyint(1) NOT NULL,
  `submittedAt` varchar(50) NOT NULL,
  `note` decimal(2,0) DEFAULT NULL,
  `content` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `taskitems`
--

INSERT INTO `taskitems` (`id`, `taskId`, `userId`, `submitted`, `submittedAt`, `note`, `content`) VALUES
(2, 3, 3, 1, '11-11-2021 13:44:29', NULL, 'enlace tarea');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `moduleId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tasks`
--

INSERT INTO `tasks` (`id`, `moduleId`, `name`, `description`) VALUES
(3, 1, 'Pràctica 1', 'Instal·lació i configuració d’Entorns de Desenvolupament'),
(4, 2, 'Prueba', 'Prueba tarea M06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `isTeacher` tinyint(1) NOT NULL,
  `hashedPassword` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `isTeacher`, `hashedPassword`) VALUES
(2, 'Miguel', 'Sepúlveda', 'miguel@gmail.com', 1, '$2y$10$qAFXjiFAT0vIHy5JyQey6eGcxikFq24ARr3p77uGSOISHDqhUtvuO'),
(3, 'Paco', 'José', 'paco@gmail.com', 0, '$2y$10$m9zdLZXN6kcU3kAYKiIZRuBVBpabs2GZkJZO5JTxM3sNR7BbLRnGq'),
(5, 'alumno', '', 'alumno@gmail.com', 0, '$2y$10$5CjUDz3aHNQe5QrG65y2CuPIDn2Xkz46TzgdLydqDQD3dBVWmJHkK'),
(6, 'profe', 'test', 'profetest@gmail.com', 1, '$2y$10$VCPV0b8iQMFUAffJ9AQB/e8bvF8O7A4MLrYqAQs1cXLOwRd1H5ZZC');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `moduleusers`
--
ALTER TABLE `moduleusers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkModuleUsersModuleId` (`moduleId`),
  ADD KEY `fkModuleUsersUserId` (`userId`);

--
-- Indices de la tabla `taskitems`
--
ALTER TABLE `taskitems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkTaskItemsTaskId` (`taskId`),
  ADD KEY `fkTaskItemsUserId` (`userId`);

--
-- Indices de la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkTasksModuleId` (`moduleId`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `moduleusers`
--
ALTER TABLE `moduleusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `taskitems`
--
ALTER TABLE `taskitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `moduleusers`
--
ALTER TABLE `moduleusers`
  ADD CONSTRAINT `fkModuleUsersModuleId` FOREIGN KEY (`moduleId`) REFERENCES `modules` (`id`),
  ADD CONSTRAINT `fkModuleUsersUserId` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `taskitems`
--
ALTER TABLE `taskitems`
  ADD CONSTRAINT `fkTaskItemsTaskId` FOREIGN KEY (`taskId`) REFERENCES `tasks` (`id`),
  ADD CONSTRAINT `fkTaskItemsUserId` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `fkTasksModuleId` FOREIGN KEY (`moduleId`) REFERENCES `modules` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
