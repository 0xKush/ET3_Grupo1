-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 22-12-2016 a las 15:19:03
-- Versión del servidor: 5.5.44-0+deb8u1
-- Versión de PHP: 5.6.13-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `ET3Grupo1`
--
DROP DATABASE IF EXISTS `ET3Grupo1`;
CREATE DATABASE IF NOT EXISTS `ET3Grupo1` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `ET3Grupo1`;

GRANT ALL PRIVILEGES ON `ET3Grupo1`.* TO 'ET3Grupo1'@'%' IDENTIFIED BY 'ET3Grupo1';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
`id` int(11) NOT NULL,
  `publication` int(11) NOT NULL,
  `owner` int(11) NOT NULL,
  `origincomment` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `hour` time NOT NULL,
  `text` text COLLATE utf8_spanish_ci NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- RELACIONES PARA LA TABLA `comment`:
--   `origincomment`
--       `comment` -> `id`
--   `publication`
--       `publication` -> `id`
--   `user`
--       `user` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conversation`
--

DROP TABLE IF EXISTS `conversation`;
CREATE TABLE IF NOT EXISTS `conversation` (
`id` int(11) NOT NULL,
  `member` int(11) NOT NULL,
  `secondarymember` int(11) NOT NULL,
  `startdate` date NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `document`
--

DROP TABLE IF EXISTS `document`;
CREATE TABLE IF NOT EXISTS `document` (
`id` int(11) NOT NULL,
  `owner` int(11) NOT NULL,
  `location` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `uploaddate` date NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- RELACIONES PARA LA TABLA `document`:
--   `user`
--       `user` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
`id` int(11) NOT NULL,
  `creationdate` date NOT NULL,
  `owner` int(11) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `starthour` time NOT NULL,
  `endhour` time NOT NULL,
  `description` text COLLATE utf8_spanish_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `private` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `friendship`
--

DROP TABLE IF EXISTS `friendship`;
CREATE TABLE IF NOT EXISTS `friendship` (
  `member` int(11) NOT NULL,
  `secondarymember` int(11) NOT NULL,
  `requestdate` date NOT NULL,
  `startdate` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- RELACIONES PARA LA TABLA `friendship`:
--   `user`
--       `user` -> `id`
--   `friend`
--       `user` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `group`
--

DROP TABLE IF EXISTS `group`;
CREATE TABLE IF NOT EXISTS `group` (
`id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `description` text COLLATE utf8_spanish_ci NOT NULL,
  `owner` int(11) NOT NULL,
  `private` tinyint(1) NOT NULL,
  `creationdate` date NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- RELACIONES PARA LA TABLA `group`:
--   `owner`
--       `user` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guest`
--

DROP TABLE IF EXISTS `guest`;
CREATE TABLE IF NOT EXISTS `guest` (
  `event` int(11) NOT NULL,
  `secondarymember` int(11) NOT NULL,
  `invitationdate` date NOT NULL,
  `assist` tinyint(1) DEFAULT NULL,
  `member` int(11) NOT NULL,
  `answerdate` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- RELACIONES PARA LA TABLA `guest`:
--   `invitedby`
--       `user` -> `id`
--   `event`
--       `event` -> `id`
--   `guest`
--       `user` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
`id` int(11) NOT NULL,
  `conversation` int(11) NOT NULL,
  `owner` int(11) NOT NULL,
  `senddate` date NOT NULL,
  `sendhour` time NOT NULL,
  `content` text COLLATE utf8_spanish_ci NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publication`
--

DROP TABLE IF EXISTS `publication`;
CREATE TABLE IF NOT EXISTS `publication` (
`id` int(11) NOT NULL,
  `destination` int(11) NOT NULL,
  `type` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `owner` int(11) NOT NULL,
  `date` date NOT NULL,
  `hour` time NOT NULL,
  `description` text COLLATE utf8_spanish_ci NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- RELACIONES PARA LA TABLA `publication`:
--   `destination`
--       `user` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publidoc`
--

DROP TABLE IF EXISTS `publidoc`;
CREATE TABLE IF NOT EXISTS `publidoc` (
  `document` int(11) NOT NULL,
  `publication` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- RELACIONES PARA LA TABLA `publidoc`:
--   `publication`
--       `publication` -> `id`
--   `document`
--       `document` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `surnames` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `phone` int(9) NOT NULL,
  `user` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `photo` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `type` tinyint(1) NOT NULL,
  `private` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usergroup`
--

DROP TABLE IF EXISTS `usergroup`;
CREATE TABLE IF NOT EXISTS `usergroup` (
  `groupid` int(11) NOT NULL,
  `member` int(11) NOT NULL,
  `invitationdate` date NOT NULL,
  `accept` tinyint(1) NOT NULL,
  `secondarymember` int(11) NOT NULL,
  `answerdate` date NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- RELACIONES PARA LA TABLA `usergroup`:
--   `groupid`
--       `group` -> `id`
--   `guest`
--       `user` -> `id`
--   `invitedby`
--       `user` -> `id`
--

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comment`
--
ALTER TABLE `comment`
 ADD PRIMARY KEY (`id`), ADD KEY `publication` (`publication`), ADD KEY `owner` (`owner`), ADD KEY `origincomment` (`origincomment`);

--
-- Indices de la tabla `conversation`
--
ALTER TABLE `conversation`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `member` (`member`,`secondarymember`,`startdate`), ADD KEY `secondarymember` (`secondarymember`);
 
--
-- Indices de la tabla `document`
--
ALTER TABLE `document`
 ADD PRIMARY KEY (`id`), ADD KEY `owner` (`owner`);

--
-- Indices de la tabla `event`
--
ALTER TABLE `event`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `maker` (`owner`,`startdate`,`name`);

--
-- Indices de la tabla `friendship`
--
ALTER TABLE `friendship`
 ADD PRIMARY KEY (`member`,`secondarymember`,`requestdate`), ADD KEY `friendship_2` (`secondarymember`);

--
-- Indices de la tabla `group`
--
ALTER TABLE `group`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`), ADD KEY `owner` (`owner`);

--
-- Indices de la tabla `guest`
--
ALTER TABLE `guest`
 ADD PRIMARY KEY (`event`,`secondarymember`,`invitationdate`), ADD KEY `invitedby` (`member`), ADD KEY `secondarymember` (`secondarymember`);

--
-- Indices de la tabla `message`
--
ALTER TABLE `message`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `conversation` (`conversation`,`owner`,`senddate`,`sendhour`);

--
-- Indices de la tabla `publication`
--
ALTER TABLE `publication`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `destintion` (`destination`,`type`,`owner`,`date`,`hour`), ADD KEY `owner` (`owner`);

--
-- Indices de la tabla `publidoc`
--
ALTER TABLE `publidoc`
 ADD PRIMARY KEY (`document`,`publication`), ADD KEY `publi_doc` (`publication`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `user` (`user`);

--
-- Indices de la tabla `usergroup`
--
ALTER TABLE `usergroup`
 ADD PRIMARY KEY (`groupid`,`secondarymember`,`invitationdate`), ADD KEY `member` (`member`), ADD KEY `guest_group` (`secondarymember`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comment`
--
ALTER TABLE `comment`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `conversation`
--
ALTER TABLE `conversation`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `document`
--
ALTER TABLE `document`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `event`
--
ALTER TABLE `event`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `group`
--
ALTER TABLE `group`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `message`
--
ALTER TABLE `message`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `publication`
--
ALTER TABLE `publication`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comment`
--
ALTER TABLE `comment`
ADD CONSTRAINT `origincom` FOREIGN KEY (`origincomment`) REFERENCES `comment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `publi_comment` FOREIGN KEY (`publication`) REFERENCES `publication` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `user_comment` FOREIGN KEY (`owner`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `conversation`
--
ALTER TABLE `conversation`
ADD CONSTRAINT `conversation_ibfk_2` FOREIGN KEY (`secondarymember`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `conversation_ibfk_1` FOREIGN KEY (`member`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `document`
--
ALTER TABLE `document`
ADD CONSTRAINT `doc_user` FOREIGN KEY (`owner`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `friendship`
--
ALTER TABLE `friendship`
ADD CONSTRAINT `friendship_1` FOREIGN KEY (`member`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `friendship_2` FOREIGN KEY (`secondarymember`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `group`
--
ALTER TABLE `group`
ADD CONSTRAINT `owner` FOREIGN KEY (`owner`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `guest`
--
ALTER TABLE `guest`
ADD CONSTRAINT `invitedby` FOREIGN KEY (`member`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `event` FOREIGN KEY (`event`) REFERENCES `event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `guest` FOREIGN KEY (`secondarymember`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `message`
--
ALTER TABLE `message`
ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`conversation`) REFERENCES `conversation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `publication`
--
ALTER TABLE `publication`
ADD CONSTRAINT `ownerpubli` FOREIGN KEY (`owner`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `publidoc`
--
ALTER TABLE `publidoc`
ADD CONSTRAINT `publi_doc` FOREIGN KEY (`publication`) REFERENCES `publication` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `doc_publi` FOREIGN KEY (`document`) REFERENCES `document` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usergroup`
--
ALTER TABLE `usergroup`
ADD CONSTRAINT `group_user` FOREIGN KEY (`groupid`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `guest_group` FOREIGN KEY (`secondarymember`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `invitedy_group` FOREIGN KEY (`member`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
