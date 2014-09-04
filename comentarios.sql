-- phpMyAdmin SQL Dump
-- version 4.2.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 03, 2014 at 10:17 PM
-- Server version: 5.5.39
-- PHP Version: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `comentarios`
--

-- --------------------------------------------------------

--
-- Table structure for table `comentarios`
--

CREATE TABLE IF NOT EXISTS `comentarios` (
`id` int(11) NOT NULL,
  `texto` mediumtext COLLATE latin1_spanish_ci NOT NULL,
  `tematica_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `comentarios`
--

INSERT INTO `comentarios` (`id`, `texto`, `tematica_id`) VALUES
(1, 'Colombia es la "excepción a la regla" en América Latina en materia económica y este año crecerá por encima del promedio proyectado para el conjunto de la región, dijo hoy el ministro de Hacienda y Crédito Público, Mauricio Cárdenas.', 1),
(2, 'El desarrollo de la ingeniería genética (también llamada metodología del ADN recombinante) fue posible gracias al descubrimiento de las enzimas de restricción y de los plásmidos. ', 2),
(3, 'La ingeniería genética en animales', 2),
(4, 'Política Colombiana en Crisis por corrupcción ', 3),
(6, 'Crisis en el medio oriente por Israel y Palestina ', 6),
(11, 'Al realizar tu preventa de FIFA 15 en Gamers, te llevarás una playera que podrás personalizar con el nombre que quieras. Aquí te contamos cuáles son los sencillos pasos a seguir y que puedes hacer desde tu casa en gamers.vg/registrofifa15. Sólo recuerda, que necesita tener tu ticket de preventa a la mano.', 8),
(12, 'La ciencia (del latín scientia ''conocimiento'') es el conjunto de conocimientos estructurados sistemáticamente. La ciencia es el conocimiento obtenido mediante ', 4),
(13, 'Revista Empresarial y Laboral, es un medio especializado en Gestión Humana y Negocios, escrito por y para empresarios, de circulación nacional. ', 7);

-- --------------------------------------------------------

--
-- Table structure for table `respuestas`
--

CREATE TABLE IF NOT EXISTS `respuestas` (
`id` int(11) NOT NULL,
  `texto` mediumtext COLLATE latin1_spanish_ci NOT NULL,
  `comentarios_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `respuestas`
--

INSERT INTO `respuestas` (`id`, `texto`, `comentarios_id`) VALUES
(1, 'respuesta a mi primer comentario', 1),
(2, 'respuesta2 a mi primer comentario', 1),
(3, 'Respuesta1 segundo comentario', 2),
(4, 'Respuesta2 segundo comentario', 2),
(5, 'Respuesta3 segundo comentario', 2),
(6, 'Respuesta4 segundo comentario', 2),
(7, 'Respuesta3 primer comentario', 1),
(8, 'Respuesta4 primer comentario', 1),
(9, 'Respuesta5 primer comentario', 1),
(10, 'Respuesta1 tercer comentario', 3),
(11, 'Respuesta1 cuarto comentario', 4),
(12, 'Respuesta2 cuarto  comentario', 4),
(13, 'Respuesta3 cuarto  comentario', 4),
(14, 'Respuesta1 sexto  comentario', 6),
(15, 'Interesante! Me gusta!', 11),
(27, 'No me gusta esto', 4),
(28, 'Que buen Juego!!!! Me gusta', 11),
(29, 'Muy Grave lo de palestina', 6),
(30, 'Me gusta la ciencia!!!', 12),
(31, 'Que buena propuesta', 13),
(32, 'La forma de hacer política es pésima', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tematica`
--

CREATE TABLE IF NOT EXISTS `tematica` (
`id` int(11) NOT NULL,
  `nombre` varchar(64) COLLATE latin1_spanish_ci NOT NULL,
  `color` varchar(32) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `tematica`
--

INSERT INTO `tematica` (`id`, `nombre`, `color`) VALUES
(1, 'Economía', '#1C75A4'),
(2, 'Ingeniería', '#85BC21'),
(3, 'Política', '#0098A0'),
(4, 'Ciencia', '#60AAE8'),
(5, 'Actualidad', '#525471'),
(6, 'Mundo', '#981E2D'),
(7, 'Empresarial', '#6D6D6F'),
(8, 'Ocio', '#E33D25'),
(9, 'Tecnología', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comentarios`
--
ALTER TABLE `comentarios`
 ADD PRIMARY KEY (`id`,`tematica_id`), ADD KEY `fk_comentarios_tematica1_idx` (`tematica_id`);

--
-- Indexes for table `respuestas`
--
ALTER TABLE `respuestas`
 ADD PRIMARY KEY (`id`,`comentarios_id`), ADD KEY `fk_respuestas_comentarios_idx` (`comentarios_id`);

--
-- Indexes for table `tematica`
--
ALTER TABLE `tematica`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comentarios`
--
ALTER TABLE `comentarios`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `respuestas`
--
ALTER TABLE `respuestas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `tematica`
--
ALTER TABLE `tematica`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comentarios`
--
ALTER TABLE `comentarios`
ADD CONSTRAINT `fk_comentarios_tematica1` FOREIGN KEY (`tematica_id`) REFERENCES `tematica` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `respuestas`
--
ALTER TABLE `respuestas`
ADD CONSTRAINT `fk_respuestas_comentarios` FOREIGN KEY (`comentarios_id`) REFERENCES `comentarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
