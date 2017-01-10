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

GRANT ALL PRIVILEGES ON `ET3Grupo1`.* TO 'ET3Grupo1'@'localhost' IDENTIFIED BY 'ET3Grupo1';

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
  `creationdate` date NOT NULL,
  `hour` time NOT NULL,
  `content` text COLLATE utf8_spanish_ci NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `comment`
--

INSERT INTO `comment` (`id`, `publication`, `owner`, `origincomment`, `creationdate`, `hour`, `content`, `status`) VALUES
(1, 6, 3, NULL, '2016-12-26', '18:50:00', 'O máximo é de 2 personas por equipo.', 0),
(2, 6, 5, 1, '2016-12-26', '18:55:00', 'Vale, moitas grazas.', 0);

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

--
-- Volcado de datos para la tabla `conversation`
--

INSERT INTO `conversation` (`id`, `member`, `secondarymember`, `startdate`, `status`) VALUES
(1, 2, 3, '2016-10-15', 0),
(2, 4, 5, '2016-10-16', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `document`
--

INSERT INTO `document` (`id`, `owner`, `location`, `uploaddate`, `status`) VALUES
(1, 2, '/media/documents/doc1.jpg', '2016-11-20', 0),
(2, 2, '/media/documents/doc2.jpg', '2016-11-20', 0),
(3, 5, '/media/documents/doc3.jpg', '2017-08-01', 0);

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

--
-- Volcado de datos para la tabla `event`
--

INSERT INTO `event` (`id`, `creationdate`, `owner`, `startdate`, `enddate`, `starthour`, `endhour`, `description`, `status`, `name`, `private`) VALUES
(1, '2016-10-12', 2, '2016-12-31', '2017-01-01', '22:00:00', '07:00:00', 'Cena de fin de año 2016', 0, 'Fin de Año 2016', 1),
(2, '2016-12-20', 3, '2017-02-02', '2017-02-02', '17:00:00', '21:00:00', 'Torneo Billar 2017.\r\n\r\nEl primer premio del torneo será una cena para dos personas en le restaurante Il Popolo el día 04/02/2017.', 0, 'Torneo de Billar', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `friendship`
--

DROP TABLE IF EXISTS `friendship`;
CREATE TABLE IF NOT EXISTS `friendship` (
  `id` int(11) NOT NULL,
  `member` int(11) NOT NULL,
  `secondarymember` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `friendship`
--

INSERT INTO `friendship` (`id`,`member`, `secondarymember`, `status`) VALUES
(1,2, 3, 1),
(2,2, 5, 1),
(3,3, 4, 1),
(4,3, 5, 0),
(5,4, 5, 1);

--
-- RELACIONES PARA LA TABLA `friendship`:
--   `user`
--       `user` -> `id`
--   `friend`
--       `user` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groupp`
--

DROP TABLE IF EXISTS `groupp`;
CREATE TABLE IF NOT EXISTS `groupp` (
`id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `description` text COLLATE utf8_spanish_ci NOT NULL,
  `owner` int(11) NOT NULL,
  `private` tinyint(1) NOT NULL,
  `creationdate` date NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `groupp`
--

INSERT INTO `groupp` (`id`, `name`, `description`, `owner`, `private`, `creationdate`, `status`) VALUES
(1, 'ET3', 'ET3', 2, 1, '2016-12-12', 0),
(2, 'Celta de Vigo Fans.', 'Grupo compuesto de seguidores del Celta de Vigo.', 5, 0, '2016-10-10', 0);

--
-- RELACIONES PARA LA TABLA `groupp`:
--   `owner`
--       `user` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guest`
--

DROP TABLE IF EXISTS `guest`;
CREATE TABLE IF NOT EXISTS `guest` (
  `id` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `secondarymember` int(11) NOT NULL,
  `member` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `guest`
--

INSERT INTO `guest` (`id`, `event`, `secondarymember`, `member`, `status`) VALUES
(1, 1, 5, 2, 1),
(2, 1, 4, 5, 1),
(3, 2, 2, 2, 1),
(4, 2, 4, 2, 1);

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

--
-- Volcado de datos para la tabla `message`
--

INSERT INTO `message` (`id`, `conversation`, `owner`, `senddate`, `sendhour`, `content`, `status`) VALUES
(1, 1, 2, '2016-10-15', '14:00:00', 'Ola,canto tempo, como levas a ET3?', 0),
(2, 1, 3, '2016-10-16', '17:30:00', 'Puff, estase a complicar bastante.', 0),
(3, 1, 2, '2016-10-16', '17:35:00', 'Por aquí estamos igual.', 0),
(4, 2, 4, '2016-10-16', '18:00:00', 'Miraches o partido do Celta?', 0),
(5, 2, 5, '2016-10-16', '19:00:00', 'Si, menudo partidazo. #FutbolDeSalon.', 0);

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
  `creationdate` date NOT NULL,
  `hour` time NOT NULL,
  `description` text COLLATE utf8_spanish_ci NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `publication`
--

INSERT INTO `publication` (`id`, `destination`, `type`, `owner`, `creationdate`, `hour`, `description`, `status`) VALUES
(1, 2, 'user', 2, '2016-11-20', '18:00:00', 'a', 0),
(2, 3, 'user', 2, '2016-12-24', '17:00:00', 'Felices Fiestas :)', 0),
(3, 2, 'group', 3, '2017-01-01', '09:00:00', 'Feliz ano celtistas!', 0),
(4, 1, 'group', 4, '2016-12-26', '19:45:00', 'A darle duro con la ET3.', 0),
(5, 1, 'event', 2, '2016-10-13', '17:00:00', 'Haberá que ir pensado sitio para a cea.', 0),
(6, 2, 'event', 5, '2016-12-26', '18:46:20', 'Cal é o máximo de persoas por equipo?', 0),
(7, 2, 'group', 5, '2017-01-09', '21:05:00', 'Partidazo contra o malaga. 3 puntiños máis.', 0);

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
  `id` int(11) NOT NULL,
  `document` int(11) NOT NULL,
  `publication` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `publidoc`
--

INSERT INTO `publidoc` (`id`, `document`, `publication`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 7);

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
  `surname` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
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

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `email`, `phone`, `user`, `password`, `birthday`, `address`, `status`, `photo`, `type`, `private`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', 698547123, 'admin', 'admin', '1990-06-14', 'null', 1, NULL, 1, 1),
(2, 'Laura', 'Perez', 'lperez@gmail.com', 645123587, 'lperez', 'lperez', '1996-03-19', 'Calle San José 78B 1º', 1, NULL, 0, 1),
(3, 'Miguel', 'Gomez', 'mgomez', 656238794, 'mgomez', 'mgomez', '1994-01-29', 'Calle Real 16 4ºB', 1, NULL, 0, 1),
(4, 'Daniel', 'Santiago', 'dsantiago@gmail.com', 675123489, 'dsantiago', 'dsantiago', '1994-06-05', 'Avenida de Marín 56 3ºC', 1, NULL, 0, 0),
(5, 'Alba', 'Freijomil', 'afreijomil@gmail.com', 684512378, 'afrei', 'afrei', '1990-10-02', 'Avenida de Ourense 26 6ºI', 1, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usergroup`
--

DROP TABLE IF EXISTS `usergroup`;
CREATE TABLE IF NOT EXISTS `usergroup` (
  `id` int(11) NOT NULL,
  `groupid` int(11) NOT NULL,
  `secondarymember` int(11) NOT NULL,
  `member` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usergroup`
--

INSERT INTO `usergroup` (`id`, `groupid`, `secondarymember`, `member`, `status`) VALUES
(1, 1, 3, 2, 1),
(2, 1, 4, 2, 1),
(3, 2, 3, 5, 1),
(4, 2, 4, 5, 1);

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
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `member` (`member`,`secondarymember`), ADD KEY `friendship_2` (`secondarymember`);

--
-- Indices de la tabla `groupp`
--
ALTER TABLE `groupp`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`), ADD KEY `owner` (`owner`);

--
-- Indices de la tabla `guest`
--
ALTER TABLE `guest`
 ADD PRIMARY KEY (`id`), ADD KEY `invitedby` (`member`), ADD KEY `secondarymember` (`secondarymember`);

--
-- Indices de la tabla `message`
--
ALTER TABLE `message`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `conversation` (`conversation`,`owner`,`senddate`,`sendhour`), ADD KEY `owner_mes` (`owner`);

--
-- Indices de la tabla `publication`
--
ALTER TABLE `publication`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `destintion` (`destination`,`type`,`owner`,`creationdate`,`hour`), ADD KEY `owner` (`owner`);

--
-- Indices de la tabla `publidoc`
--
ALTER TABLE `publidoc`
 ADD PRIMARY KEY (`id`),ADD KEY `doc` (`document`), ADD KEY `publi_doc` (`publication`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `user` (`user`);

--
-- Indices de la tabla `usergroup`
--
ALTER TABLE `usergroup`
 ADD PRIMARY KEY (`id`), ADD KEY `member` (`member`), ADD KEY `guest_group` (`secondarymember`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comment`
--
ALTER TABLE `comment`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `conversation`
--
ALTER TABLE `conversation`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `document`
--
ALTER TABLE `document`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `event`
--
ALTER TABLE `event`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `friendship`
--
ALTER TABLE `friendship`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `groupp`
--
ALTER TABLE `groupp`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `guest`
--
ALTER TABLE `guest`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `message`
--
ALTER TABLE `message`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `publication`
--
ALTER TABLE `publication`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `publidoc`
--
ALTER TABLE `publidoc`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `usergroup`
--
ALTER TABLE `usergroup`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
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
-- Filtros para la tabla `event`
--
ALTER TABLE `event`
ADD CONSTRAINT `event_user` FOREIGN KEY (`owner`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `friendship`
--
ALTER TABLE `friendship`
ADD CONSTRAINT `friendship_1` FOREIGN KEY (`member`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `friendship_2` FOREIGN KEY (`secondarymember`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `groupp`
--
ALTER TABLE `groupp`
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
ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`conversation`) REFERENCES `conversation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `owner_mes` FOREIGN KEY (`owner`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
ADD CONSTRAINT `doc` FOREIGN KEY (`document`) REFERENCES `document` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usergroup`
--
ALTER TABLE `usergroup`
ADD CONSTRAINT `group_user` FOREIGN KEY (`groupid`) REFERENCES `groupp` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `guest_group` FOREIGN KEY (`secondarymember`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `invitedy_group` FOREIGN KEY (`member`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
