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
(2, 6, 5, 1, '2016-12-26', '18:55:00', 'Vale, moitas grazas.', 0),
(4, 11, 6, NULL, '2016-12-23', '11:16:00', 'Que va, seguimos coma sempre jaja', 0),
(5, 20, 11, NULL, '2016-11-11', '20:48:00', 'A mi me interesan, mandamelos al email, porfa.', 0),
(6, 22, 9, NULL, '2017-01-14', '16:06:00', 'En el restaurante Pepito.', 0),
(7, 23, 7, NULL, '2017-01-03', '12:23:00', 'El aforo es de 150 personas.', 0),
(8, 24, 11, NULL, '2017-01-04', '16:52:00', 'El coste de la entrada será de 1 euro, destinandose lo recaudado a la asociacion X.', 0),
(9, 25, 9, NULL, '2017-01-06', '09:28:00', 'El número máximo de plazas es 25.', 0);

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
(2, 4, 5, '2016-10-16', 0),
(3, 6, 7, '2017-01-13', 0),
(4, 8, 13, '2017-01-13', 0),
(5, 9, 12, '2017-01-13', 0),
(6, 11, 13, '2017-01-13', 0);

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
(1, 2, 'media/images/doc1.jpg', '2016-11-20', 0),
(2, 2, 'media/images/doc2.jpg', '2016-11-20', 0),
(3, 5, 'media/images/doc3.jpg', '2017-08-01', 0);

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
  `creationdate` date DEFAULT NULL,
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
(2, '2016-12-20', 3, '2017-02-02', '2017-02-02', '17:00:00', '21:00:00', 'Torneo Billar 2017.\r\n\r\nEl primer premio del torneo será una cena para dos personas en le restaurante Il Popolo el día 04/02/2017.', 0, 'Torneo de Billar', 0),
(3, '2017-01-14', 12, '2017-01-26', '2017-01-27', '22:00:00', '05:00:00', 'El día 26 de Enero se realizará una fiesta organizada por los estudiantes de erasmus por el fin de los examenes.', 0, 'Cena Erasmus fin examens', 0),
(4, '2016-10-06', 3, '2017-01-30', '2017-01-30', '11:00:00', '12:30:00', 'Conferencia en el Salón de Actos a cargo de Chema Alonso.', 0, 'Conferencia Chema Alonso', 1),
(5, '2016-09-13', 8, '2017-02-16', '2017-02-16', '19:00:00', '20:30:00', 'Concierto a cargo de la Banda de Música de la Uvigo en el auditorio de Ourense.', 0, 'Concierto Banda de Musica Uvigo.', 0),
(6, '2016-11-08', 13, '2017-02-20', '2017-03-13', '18:30:00', '19:30:00', 'Curso de programación web a cargo del profesor Federico Tilves. La duración es de cuatro semanas. Se impartirá los lunes en el sotano 3 del edificio politecnico de Ourense.', 0, 'Curso de Programación Web.', 1);

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

INSERT INTO `friendship` (`id`, `member`, `secondarymember`, `status`) VALUES
(1, 2, 3, 1),
(2, 2, 5, 1),
(3, 3, 4, 1),
(4, 3, 5, 1),
(5, 4, 5, 1),
(6, 6, 2, 1),
(7, 6, 3, 1),
(8, 6, 4, 1),
(9, 6, 5, 1),
(10, 6, 7, 1),
(11, 6, 8, 1),
(12, 6, 9, 1),
(13, 6, 10, 1),
(14, 6, 11, 1),
(15, 7, 2, 1),
(16, 7, 8, 1),
(17, 7, 9, 1),
(18, 7, 12, 1),
(19, 7, 13, 1),
(20, 8, 3, 1),
(21, 8, 5, 1),
(22, 8, 10, 1),
(23, 8, 12, 1),
(24, 8, 13, 1),
(25, 9, 3, 1),
(26, 9, 4, 1),
(27, 9, 12, 1),
(28, 9, 13, 0),
(29, 9, 10, 0),
(30, 10, 2, 0),
(31, 10, 4, 0),
(32, 10, 11, 1),
(33, 10, 12, 1),
(34, 10, 13, 1),
(35, 11, 12, 0),
(36, 11, 13, 1),
(37, 11, 5, 1),
(38, 11, 3, 1),
(39, 12, 2, 0),
(40, 12, 3, 1),
(41, 13, 12, 0),
(42, 13, 4, 1),
(43, 13, 5, 1),
(44, 5, 7, 1);

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
  `creationdate` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `groupp`
--

INSERT INTO `groupp` (`id`, `name`, `description`, `owner`, `private`, `creationdate`, `status`) VALUES
(1, 'ET3', 'ET3', 2, 1, '2016-12-12', 0),
(2, 'Celta de Vigo Fans.', 'Grupo compuesto de seguidores del Celta de Vigo.', 5, 0, '2016-10-10', 0),
(3, 'Ourense Turismo.', 'Grupo dedicado a cidade de Ourense e os seus arredores.', 6, 0, '2016-12-20', 0),
(4, 'Emprego Ourense.', 'Grupo onde se irán publicando diversas ofertas de traballo en Ourense e arredores.', 7, 0, '2016-11-08', 0),
(5, 'Erasmus Uvigo.', 'Grupo de información para las personas de Erasmus en la uvigo.Information group for Erasmus people in the Uvigo.', 4, 0, '2016-08-16', 0),
(6, 'Tercero Ingenieria Informatica-Ou.', 'Grupo compuesto de los alumnos de tercero de Ingeniería informatica en Ourense.', 9, 1, '2016-08-17', 0);

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
  `secondarymember` int(11) DEFAULT NULL,
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
(4, 2, 4, 2, 1),
(5, 1, 6, 2, 1),
(6, 1, 8, 6, 0),
(7, 1, 10, 2, 1),
(8, 1, 12, 2, 0),
(9, 2, 3, 2, 1),
(10, 2, 5, 2, 1),
(11, 2, 7, 2, 0),
(12, 2, 9, 3, 1),
(13, 2, 11, 3, 1),
(14, 2, 13, 11, 1),
(15, 3, 8, 12, 1),
(16, 3, 9, 12, 1),
(17, 3, 4, 9, 0),
(18, 3, 5, 8, 1),
(19, 3, 13, 12, 1),
(20, 4, 2, 3, 1),
(21, 4, 6, 3, 1),
(22, 4, 7, 6, 1),
(23, 4, 10, 2, 0),
(24, 4, 11, 3, 1),
(25, 5, 5, 8, 1),
(26, 5, 2, 5, 1),
(27, 5, 11, 5, 1),
(28, 5, 13, 5, 0),
(29, 6, 9, 13, 1),
(30, 6, 3, 9, 1),
(31, 6, 6, 3, 1),
(32, 6, 11, 6, 1);

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
(5, 2, 5, '2016-10-16', '19:00:00', 'Si, menudo partidazo. #FutbolDeSalon.', 0),
(6, 3, 6, '2017-01-14', '10:00:00', 'Que tal fue el examen de LC?', 0),
(7, 3, 7, '2017-01-14', '11:00:00', 'Puf bastante mal la verdad, en la pregunta 2 se me olvidaron los ejemplos. A ti?', 0),
(8, 3, 6, '2017-01-14', '12:00:00', 'Bueno malo será. A mi bastante bien, la pregunta de la Maquina de Turing se la clavé jaja', 0),
(9, 4, 8, '2017-01-14', '10:00:00', 'Cuanto tiempo, que es de ti?', 0),
(10, 4, 13, '2017-01-14', '11:00:00', 'Bueno pues ahora estoy estudiando en Santiago. El cambio me vino perfecto. Y tú?', 0),
(11, 4, 8, '2017-01-14', '12:00:00', 'Nada, aqui sigo en Ourense, a ver si algun día acabo la carrera.', 0),
(12, 5, 9, '2017-01-14', '10:00:00', 'Eh vas a ir a la fiesta de de Elisa? Es que de los invitados solo me llevo contigo y así ibamos juntos.', 0),
(13, 5, 12, '2017-01-14', '11:00:00', 'Pues me aptecía bastante pero me pasaba como a ti asi que si amos juntos perfecto.', 0),
(14, 5, 9, '2017-01-14', '12:00:00', 'Oh guay, vamos hablando para ver como hacemos.', 0),
(15, 6, 11, '2017-01-14', '10:00:00', 'Parece que nos tocó en el mismo grupo del trabajo de BDII, tenemos que ver cuando quedar.', 0),
(16, 6, 13, '2017-01-14', '11:00:00', 'Si, yo puedo todos los días por la tarde menos el viernes', 0),
(17, 6, 11, '2017-01-14', '12:00:00', 'Pues el proximo martes podemos quedar para ir empezando.', 0),
(18, 6, 13, '2017-01-14', '13:00:00', 'Perfecto', 0);

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
(1, 2, 'user', 2, '2016-11-20', '18:00:00', 'Lugar máxico. Cabo Home.', 0),
(2, 3, 'user', 2, '2016-12-24', '17:00:00', 'Felices Fiestas :)', 0),
(3, 2, 'group', 3, '2017-01-01', '09:00:00', 'Feliz ano celtistas!', 0),
(4, 1, 'group', 4, '2016-12-26', '19:45:00', 'A darle duro con la ET3.', 0),
(5, 1, 'event', 2, '2016-10-13', '17:00:00', 'Haberá que ir pensado sitio para a cea.', 0),
(6, 2, 'event', 5, '2016-12-26', '18:46:20', 'Cal é o máximo de persoas por equipo?', 0),
(7, 2, 'group', 5, '2017-01-09', '21:05:00', 'Partidazo contra o malaga. 3 puntiños máis.', 0),
(9, 2, 'user', 3, '2017-01-06', '11:00:00', 'Que ben o pasamos onte. Hai que repetir.', 0),
(10, 2, 'user', 2, '2017-01-08', '16:30:00', 'Empezan os exames. Que a sorte vos acompañe.', 0),
(11, 3, 'user', 3, '2016-12-22', '18:30:00', 'Tocouvos a lotería? Aquí seguimos sin ser ricos.', 0),
(12, 3, 'user', 3, '2017-01-01', '10:00:00', 'Feliz ano a todos!', 0),
(13, 4, 'user', 4, '2017-01-09', '08:50:00', 'Volta a rutina.', 0),
(14, 1, 'group', 6, '2017-01-09', '11:00:00', 'Ultima semana, veña que non queda nada.', 0),
(15, 3, 'group', 8, '2016-11-17', '15:00:00', 'Se vos acercades ata Ourense non podedes deixar de visitar as Termas', 0),
(16, 3, 'group', 10, '2016-12-13', '16:00:00', 'Que ben se come no Restaurante Nova. Un dez.', 0),
(17, 4, 'group', 13, '2016-12-09', '14:30:00', 'Buscase camareiro para reforzar o servizo de Nadal. Interesados contactar con Alberto no numero 684597125.', 0),
(18, 4, 'group', 9, '2016-12-27', '18:00:00', 'Si buscas un cuidador para tu perro llama al 694587125 y pregunta por Manuel.', 0),
(19, 5, 'group', 12, '2016-11-17', '14:00:00', 'Se necesitades calqueira información acercadevos ao edificio miralles na porta 3. Agardamoste!', 0),
(20, 6, 'group', 7, '2016-11-09', '18:00:00', 'Tengo unos apuntes bastante completos de LC, si alguien los necesita que me avise.', 0),
(21, 6, 'group', 5, '2016-12-13', '15:00:00', 'Ayuda! Se buscan apuntes del tema de transacciones de BDII, si alguien tiene algo se lo agradeceria mil.', 0),
(22, 3, 'event', 5, '2017-01-14', '12:00:00', 'Donde se celebrará?', 0),
(23, 4, 'event', 6, '2017-01-02', '16:45:00', 'Cual es el aforo máximo del salón de actos?', 0),
(24, 5, 'event', 8, '2017-01-03', '19:35:00', 'El concierto es gratuito o habrá que pagar?', 0),
(25, 6, 'event', 13, '2017-01-05', '17:28:00', 'Cual es el numero de plazas del curso?', 0);

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
  `phone` varchar(12) NOT NULL,
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
(5, 'Alba', 'Freijomil', 'afreijomil@gmail.com', 684512378, 'afrei', 'afrei', '1990-10-02', 'Avenida de Ourense 26 6ºI', 1, NULL, 0, 0),
(6, 'Alejandro', 'Rodriguez', 'arodriguez', 652137894, 'arodriguez', 'arodriguez', '1994-05-15', 'Avenida de Ourense 54 3ºB', 1, NULL, 0, 0),
(7, 'Isis', 'Martinez', 'imartinez@gmail.com', 658712345, 'imartinez', 'imartinez', '1992-10-04', 'Paseo Maritimo 7 3º', 1, NULL, 0, 1),
(8, 'Gaia', 'Martinez', 'gmartinez', 698457128, 'gmartinez', 'gmartinez', '1990-10-12', 'Calle Eugenio Sequeiros 16 1º', 1, NULL, 0, 1),
(9, 'Daniel', 'Lopez', 'dlopez@gmail.com', 636250347, 'dlopez', 'dlopez', '1994-09-06', 'Calle Bouza Vella 11 Nerga-O Hio', 1, NULL, 0, 0),
(10, 'Sara', 'Lorenzo', 'slorenzo@gmail.com', 648888720, 'slorenzo', 'slorenzo', '1994-09-26', 'Calle Alvaro Guitian 13 2ºE', 1, NULL, 0, 0),
(11, 'Cecilia', 'Gonzalez', 'cgonzalez@gmail.com', 659874157, 'cgonzalez', 'cgonzalez', '1994-06-26', 'Calle San José 80 4ºC', 1, NULL, 0, 1),
(12, 'Francisco', 'Costas', 'fcostas@gmail.com', 659481275, 'fcostas', 'fcostas', '1989-02-06', 'Avenida de Marin 23 2ºA', 1, NULL, 0, 0),
(13, 'Xesús', 'Castro', 'xcastro@gmail.com', 651478952, 'xcastro', 'xcastro', '1994-04-05', 'Avenida de Vigo 29 5ºC', 1, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usergroup`
--

DROP TABLE IF EXISTS `usergroup`;
CREATE TABLE IF NOT EXISTS `usergroup` (
  `id` int(11) NOT NULL,
  `groupid` int(11) NOT NULL,
  `secondarymember` int(11) DEFAULT NULL,
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
(4, 2, 4, 5, 1),
(5, 1, 6, 2, 1),
(6, 1, 8, 6, 1),
(7, 1, 10, 6, 1),
(8, 1, 12, 10, 1),
(9, 2, 7, 5, 1),
(10, 2, 9, 3, 1),
(11, 2, 11, 5, 1),
(12, 2, 13, 5, 1),
(13, 3, 2, 6, 1),
(14, 3, 4, 6, 1),
(15, 3, 8, 6, 1),
(16, 3, 10, 6, 1),
(17, 3, 12, 10, 1),
(18, 4, 5, 7, 1),
(19, 4, 3, 5, 1),
(20, 4, 9, 7, 1),
(21, 4, 13, 7, 1),
(22, 4, 11, 13, 1),
(23, 5, 6, 4, 1),
(24, 5, 2, 6, 1),
(25, 5, 8, 6, 1),
(26, 5, 10, 4, 1),
(27, 5, 12, 10, 1),
(28, 6, 3, 9, 1),
(29, 6, 5, 3, 1),
(30, 6, 7, 5, 1),
(31, 6, 11, 5, 1),
(32, 6, 13, 11, 1);

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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `conversation`
--
ALTER TABLE `conversation`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `document`
--
ALTER TABLE `document`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `event`
--
ALTER TABLE `event`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `friendship`
--
ALTER TABLE `friendship`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT de la tabla `groupp`
--
ALTER TABLE `groupp`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `guest`
--
ALTER TABLE `guest`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT de la tabla `message`
--
ALTER TABLE `message`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `publication`
--
ALTER TABLE `publication`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `publidoc`
--
ALTER TABLE `publidoc`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `usergroup`
--
ALTER TABLE `usergroup`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
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
