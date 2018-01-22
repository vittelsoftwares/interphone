-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `AdioElastixDialerBD`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calloutcampana`
--

CREATE TABLE IF NOT EXISTS `calloutcampana` (
  `idcampana` int(20) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `tipo` int(5) NOT NULL,
  `troncal` varchar(255) NOT NULL,
  `audio` varchar(255) NOT NULL,
  `archivo` varchar(255) NOT NULL,
  `fechacreacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calloutnumeros`
--

CREATE TABLE IF NOT EXISTS `calloutnumeros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `campana` varchar(255) NOT NULL,
  `telefono` int(20) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
