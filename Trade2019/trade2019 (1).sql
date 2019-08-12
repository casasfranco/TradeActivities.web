-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 22-03-2019 a las 16:04:20
-- Versión del servidor: 5.7.21
-- Versión de PHP: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `trade2019`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcaracteristica`
--

DROP TABLE IF EXISTS `tblcaracteristica`;
CREATE TABLE IF NOT EXISTS `tblcaracteristica` (
  `idCaracteristica` int(11) NOT NULL AUTO_INCREMENT,
  `strNombre` varchar(150) DEFAULT NULL,
  `refPadre` int(11) DEFAULT NULL,
  `intEstado` int(11) DEFAULT NULL,
  `intOrden` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCaracteristica`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tblcaracteristica`
--

INSERT INTO `tblcaracteristica` (`idCaracteristica`, `strNombre`, `refPadre`, `intEstado`, `intOrden`) VALUES
(1, 'Cajas', 0, 1, 1),
(2, '12 unidades', 1, 1, 1),
(3, '24 unidades', 1, 1, 2),
(4, 'Caracteristica 2', 0, 1, 2),
(5, 'caracteristica 2 sub', 4, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcarrito`
--

DROP TABLE IF EXISTS `tblcarrito`;
CREATE TABLE IF NOT EXISTS `tblcarrito` (
  `idContador` int(11) NOT NULL AUTO_INCREMENT,
  `refUsuario` int(11) DEFAULT NULL,
  `refProducto` int(11) DEFAULT NULL,
  `intCantidad` int(11) DEFAULT NULL,
  `intTransaccionEfectuada` int(11) DEFAULT '0',
  PRIMARY KEY (`idContador`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tblcarrito`
--

INSERT INTO `tblcarrito` (`idContador`, `refUsuario`, `refProducto`, `intCantidad`, `intTransaccionEfectuada`) VALUES
(63, 11, 2, 2, 5),
(66, 11, 16, 50, 6),
(64, 11, 2, 1, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcarritodetalle`
--

DROP TABLE IF EXISTS `tblcarritodetalle`;
CREATE TABLE IF NOT EXISTS `tblcarritodetalle` (
  `idContadorDetalle` int(11) NOT NULL AUTO_INCREMENT,
  `refCarrito` int(11) DEFAULT NULL,
  `refOpcion` int(11) DEFAULT NULL,
  `refOpcionSeleccionada` int(11) DEFAULT NULL,
  PRIMARY KEY (`idContadorDetalle`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tblcarritodetalle`
--

INSERT INTO `tblcarritodetalle` (`idContadorDetalle`, `refCarrito`, `refOpcion`, `refOpcionSeleccionada`) VALUES
(13, 45, 1, 2),
(14, 46, 1, 2),
(15, 47, 1, 2),
(16, 48, 1, 2),
(17, 50, 1, 2),
(18, 51, 1, 2),
(19, 52, 1, 4),
(20, 55, 1, 2),
(21, 56, 1, 2),
(22, 57, 1, 2),
(23, 58, 1, 2),
(24, 59, 1, 2),
(25, 60, 1, 2),
(26, 61, 1, 2),
(27, 62, 1, 2),
(28, 63, 1, 2),
(29, 64, 1, 2),
(30, 65, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcategoria`
--

DROP TABLE IF EXISTS `tblcategoria`;
CREATE TABLE IF NOT EXISTS `tblcategoria` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `strNombre` varchar(50) NOT NULL,
  `strSEO` varchar(50) DEFAULT NULL,
  `intEstado` int(11) NOT NULL,
  `refPadre` int(11) NOT NULL,
  `intOrden` int(11) NOT NULL,
  `intPrincipal` int(11) DEFAULT '0',
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblcategoria`
--

INSERT INTO `tblcategoria` (`idCategoria`, `strNombre`, `strSEO`, `intEstado`, `refPadre`, `intOrden`, `intPrincipal`) VALUES
(1, 'Chocolates', 'chocolates', 1, 0, 1, 1),
(3, 'Yerba Mate', 'yerba-mate', 1, 0, 2, 1),
(4, 'dfegerg', 'dfegerg', 1, 0, 54, 0),
(6, 'sub chocolates', 'sub-chocolates', 1, 1, 1, 0),
(12, 'Premezclas', 'premezclas', 1, 0, 1, 0),
(13, '9 de Oro', '9-de-oro', 1, 0, 1, 0),
(14, 'Yerba Mate BCP', 'yerba-mate-bcp', 1, 3, 1, 0),
(15, 'Todos los chocolates', 'todos-los-chocolates', 1, 1, 123, 0),
(16, 'Harinas', 'harinas', 1, 0, 4, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcomentario`
--

DROP TABLE IF EXISTS `tblcomentario`;
CREATE TABLE IF NOT EXISTS `tblcomentario` (
  `idComentario` int(11) NOT NULL AUTO_INCREMENT,
  `refProducto` int(11) DEFAULT NULL,
  `intEstado` int(11) DEFAULT '0',
  `strNombreComentador` varchar(50) DEFAULT NULL,
  `strFecha` datetime DEFAULT NULL,
  `refUsuario` int(11) DEFAULT '0',
  `txtComentario` text,
  PRIMARY KEY (`idComentario`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcomparar`
--

DROP TABLE IF EXISTS `tblcomparar`;
CREATE TABLE IF NOT EXISTS `tblcomparar` (
  `idComparar` int(11) NOT NULL AUTO_INCREMENT,
  `refUsuario` int(11) DEFAULT NULL,
  `refProducto` int(11) DEFAULT NULL,
  PRIMARY KEY (`idComparar`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcompra`
--

DROP TABLE IF EXISTS `tblcompra`;
CREATE TABLE IF NOT EXISTS `tblcompra` (
  `idCompra` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `fchCompra` datetime NOT NULL,
  `intTipoPago` int(11) NOT NULL,
  `dblTotalIVA` double(8,2) NOT NULL,
  `dblTotalsinIVA` double(8,2) NOT NULL,
  `intFacturacion` int(11) NOT NULL,
  `intEnvio` int(11) NOT NULL,
  `intEstado` int(11) NOT NULL,
  `intZona` int(11) NOT NULL,
  `strNombre` varchar(50) NOT NULL,
  `strDNI` varchar(50) NOT NULL,
  `strDireccion` varchar(50) NOT NULL,
  `strPiso` varchar(20) DEFAULT NULL,
  `strProvincia` varchar(50) NOT NULL,
  `strCP` varchar(10) NOT NULL,
  `strEmail` varchar(100) NOT NULL,
  `strTelefono` varchar(50) NOT NULL,
  PRIMARY KEY (`idCompra`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tblcompra`
--

INSERT INTO `tblcompra` (`idCompra`, `idUsuario`, `fchCompra`, `intTipoPago`, `dblTotalIVA`, `dblTotalsinIVA`, `intFacturacion`, `intEnvio`, `intEstado`, `intZona`, `strNombre`, `strDNI`, `strDireccion`, `strPiso`, `strProvincia`, `strCP`, `strEmail`, `strTelefono`) VALUES
(6, 11, '2019-03-22 11:38:20', 1, 2006.34, 1661.05, 0, 0, 2, 1, 'franco casas', '4000', 'manuel alberti 860', NULL, 'Tucumán', '4000', 'franco_08_casas@hotmail.com', '3815271965'),
(5, 11, '2019-03-20 14:04:33', 3, 129.68, 72.10, 0, 0, 0, 1, 'franco casas', '4000', 'manuel alberti 860', NULL, 'Tucumán', '4000', 'franco_08_casas@hotmail.com', '3815271965');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblconfiguracion`
--

DROP TABLE IF EXISTS `tblconfiguracion`;
CREATE TABLE IF NOT EXISTS `tblconfiguracion` (
  `idConfiguracion` int(11) NOT NULL AUTO_INCREMENT,
  `strTelefono` varchar(50) NOT NULL,
  `strEmail` varchar(50) NOT NULL,
  `strLogo` varchar(50) NOT NULL,
  `intMarcas` int(11) NOT NULL,
  `intImpuesto` int(11) DEFAULT NULL,
  `strPAYPAL_url` varchar(200) DEFAULT NULL,
  `strPAYPAL_email` varchar(100) DEFAULT NULL,
  `strSANTANDER_url` varchar(200) DEFAULT NULL,
  `strSANTANDER_merchantid` varchar(200) DEFAULT NULL,
  `strSANTANDER_secret` varchar(200) DEFAULT NULL,
  `strSANTANDER_account` varchar(200) DEFAULT NULL,
  `intTransferencia` int(11) DEFAULT NULL,
  `intPaypal` int(11) DEFAULT NULL,
  `intAlrecibir` int(11) DEFAULT NULL,
  `intSantander` int(11) DEFAULT NULL,
  `intMercadoPago` int(11) DEFAULT NULL,
  `strURL` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`idConfiguracion`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblconfiguracion`
--

INSERT INTO `tblconfiguracion` (`idConfiguracion`, `strTelefono`, `strEmail`, `strLogo`, `intMarcas`, `intImpuesto`, `strPAYPAL_url`, `strPAYPAL_email`, `strSANTANDER_url`, `strSANTANDER_merchantid`, `strSANTANDER_secret`, `strSANTANDER_account`, `intTransferencia`, `intPaypal`, `intAlrecibir`, `intSantander`, `intMercadoPago`, `strURL`) VALUES
(1, '+54 3815271965', 'tiendaonline@tradeactivities.com', 'logo-grande.png', 1, 1, '123123', 'sdasd@gmail.com', NULL, NULL, 'asdasd', '123123', 0, 1, 1, 0, 1, 'http://localhost/Trade2019');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbldeseo`
--

DROP TABLE IF EXISTS `tbldeseo`;
CREATE TABLE IF NOT EXISTS `tbldeseo` (
  `idDeseo` int(11) NOT NULL AUTO_INCREMENT,
  `refUsuario` int(11) DEFAULT NULL,
  `refProducto` int(11) DEFAULT NULL,
  PRIMARY KEY (`idDeseo`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblimpuesto`
--

DROP TABLE IF EXISTS `tblimpuesto`;
CREATE TABLE IF NOT EXISTS `tblimpuesto` (
  `idImpuesto` int(11) NOT NULL AUTO_INCREMENT,
  `strNombre` varchar(50) DEFAULT NULL,
  `dblImpuesto` double DEFAULT NULL,
  PRIMARY KEY (`idImpuesto`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tblimpuesto`
--

INSERT INTO `tblimpuesto` (`idImpuesto`, `strNombre`, `dblImpuesto`) VALUES
(2, 'IVA 21%', 21),
(4, 'Sin impuesto', 0),
(5, 'IVA \"', 10.5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblmarca`
--

DROP TABLE IF EXISTS `tblmarca`;
CREATE TABLE IF NOT EXISTS `tblmarca` (
  `idMarca` int(11) NOT NULL AUTO_INCREMENT,
  `strMarca` varchar(50) NOT NULL,
  `intOrden` int(11) NOT NULL,
  `intEstado` int(11) NOT NULL,
  PRIMARY KEY (`idMarca`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblmarca`
--

INSERT INTO `tblmarca` (`idMarca`, `strMarca`, `intOrden`, `intEstado`) VALUES
(1, 'Nestlé', 1, 1),
(2, 'Mamá Cocina', 2, 1),
(3, 'La Toscana', 3, 1),
(4, 'Kipper\'s', 4, 1),
(5, 'Vigente', 5, 1),
(6, 'Molino Cañuelas', 1, 1),
(7, 'La Mercerd', 1, 1),
(8, 'Rosamonte', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblopcion`
--

DROP TABLE IF EXISTS `tblopcion`;
CREATE TABLE IF NOT EXISTS `tblopcion` (
  `idOpcion` int(11) NOT NULL AUTO_INCREMENT,
  `strNombre` varchar(50) DEFAULT NULL,
  `refPadre` int(11) DEFAULT NULL,
  `intEstado` int(11) DEFAULT NULL,
  `intOrden` int(11) DEFAULT NULL,
  `dblIncremento` double(8,2) DEFAULT NULL,
  PRIMARY KEY (`idOpcion`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tblopcion`
--

INSERT INTO `tblopcion` (`idOpcion`, `strNombre`, `refPadre`, `intEstado`, `intOrden`, `dblIncremento`) VALUES
(1, 'Cantidad', 0, 1, 1, NULL),
(2, 'Unidades', 1, 1, 1, 0.00),
(4, 'Cajas', 1, 1, 2, 100.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblproducto`
--

DROP TABLE IF EXISTS `tblproducto`;
CREATE TABLE IF NOT EXISTS `tblproducto` (
  `idProducto` int(11) NOT NULL AUTO_INCREMENT,
  `strNombre` varchar(50) NOT NULL,
  `strSEO` varchar(120) NOT NULL,
  `refCategoria1` int(11) NOT NULL,
  `strImagen1` varchar(50) DEFAULT NULL,
  `strDescripcion` text,
  `dblPrecio` double(8,2) NOT NULL DEFAULT '0.00',
  `dblPrecioAnterior` double(8,2) DEFAULT '0.00',
  `intEstado` int(11) NOT NULL,
  `refMarca` int(11) NOT NULL,
  `refCategoria2` int(11) NOT NULL,
  `refCategoria3` int(11) NOT NULL,
  `refCategoria4` int(11) NOT NULL,
  `refCategoria5` int(11) NOT NULL,
  `strImagen2` varchar(50) DEFAULT NULL,
  `strImagen3` varchar(50) DEFAULT NULL,
  `strImagen4` varchar(50) DEFAULT NULL,
  `strImagen5` varchar(50) DEFAULT NULL,
  `intPrincipal` int(11) NOT NULL DEFAULT '0',
  `intStock` int(11) DEFAULT '10',
  `refImpuesto` int(11) DEFAULT NULL,
  `dblPeso` double DEFAULT NULL,
  PRIMARY KEY (`idProducto`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblproducto`
--

INSERT INTO `tblproducto` (`idProducto`, `strNombre`, `strSEO`, `refCategoria1`, `strImagen1`, `strDescripcion`, `dblPrecio`, `dblPrecioAnterior`, `intEstado`, `refMarca`, `refCategoria2`, `refCategoria3`, `refCategoria4`, `refCategoria5`, `strImagen2`, `strImagen3`, `strImagen4`, `strImagen5`, `intPrincipal`, `intStock`, `refImpuesto`, `dblPeso`) VALUES
(1, 'Seat África', 'seat-africa', 1, NULL, '<p>Coche grande y espacioso</p>', 8000.00, 0.00, 1, 1, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 10, 5, 0),
(2, 'Yerba Mate Rosamonte', 'yerba-mate-rosamonte', 3, 'YERBA-MATE-ROSAMONTE.jpg', '<p>Yerba mate Rosamonte</p>', 36.05, 445.00, 1, 8, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 10, 5, 12),
(3, 'Yerba Mate con palo Barbacuá', 'yerba-mate-con-palo-barbacua', 3, 'YERLABOC500.jpg', '<p>87</p>', 43.00, 0.00, 1, 7, 0, 0, 0, 0, 'bananitaDLC.png', NULL, NULL, NULL, 1, 10, 2, 0),
(4, 'Galleta Azucaradas', 'galleta-azucaradas', 1, '9doroazucarados.jpg', '<p>Galltas azucaradas 9 de oro</p>', 31.00, 0.00, 1, 6, 6, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 10, 5, 0),
(5, 'Kit Kat', 'kit-kat', 1, 'KitKat.jpeg', NULL, 27.34, 0.00, 1, 1, 1, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 10, 4, 23),
(14, 'Leche Condensada', 'leche-condensada', 1, 'LaLechera-Nestle-400x400.jpg', '<p>Leche condensada Nestl&eacute;</p>', 24.17, 0.00, 1, 1, 6, 0, 0, 0, '250225.jpg', 'KitKatCaja.jpg', NULL, NULL, 1, 8, 5, 11),
(15, 'Prueba imagenNoDisponible', 'prueba-imagennodisponible', 1, NULL, '<p>sdasdasdasdasd</p>', 123.00, 0.00, 1, 1, 6, 15, 0, 0, NULL, NULL, NULL, NULL, 1, 2, 5, 0),
(16, 'Harina Pureza 0000', 'harina-pureza-0000', 16, 'slider-harina.png', '<p>Harina Pureza 0000 Ultra refinada.</p>\r\n<p>Para todos los usos.</p>', 32.50, 45.00, 1, 6, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 19, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblproductocaracteristica`
--

DROP TABLE IF EXISTS `tblproductocaracteristica`;
CREATE TABLE IF NOT EXISTS `tblproductocaracteristica` (
  `idProductocaracteristica` int(11) NOT NULL AUTO_INCREMENT,
  `refProducto` int(11) DEFAULT NULL,
  `refCaracteristica` int(11) DEFAULT NULL,
  `refSeleccionada` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProductocaracteristica`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tblproductocaracteristica`
--

INSERT INTO `tblproductocaracteristica` (`idProductocaracteristica`, `refProducto`, `refCaracteristica`, `refSeleccionada`) VALUES
(14, 5, 4, 5),
(5, 14, 1, 3),
(6, 2, 1, 2),
(7, 3, 1, 2),
(8, 4, 1, 2),
(13, 5, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblproductoopcion`
--

DROP TABLE IF EXISTS `tblproductoopcion`;
CREATE TABLE IF NOT EXISTS `tblproductoopcion` (
  `idProductoopcion` int(11) NOT NULL AUTO_INCREMENT,
  `refProducto` int(11) DEFAULT NULL,
  `refOpcion` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProductoopcion`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tblproductoopcion`
--

INSERT INTO `tblproductoopcion` (`idProductoopcion`, `refProducto`, `refOpcion`) VALUES
(4, 2, 1),
(5, 3, 1),
(6, 4, 1),
(8, 14, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblproductovisita`
--

DROP TABLE IF EXISTS `tblproductovisita`;
CREATE TABLE IF NOT EXISTS `tblproductovisita` (
  `idProductovisita` int(11) NOT NULL AUTO_INCREMENT,
  `refUsuario` int(11) DEFAULT NULL,
  `refProducto` int(11) DEFAULT NULL,
  `fchFecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idProductovisita`)
) ENGINE=MyISAM AUTO_INCREMENT=94 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tblproductovisita`
--

INSERT INTO `tblproductovisita` (`idProductovisita`, `refUsuario`, `refProducto`, `fchFecha`) VALUES
(4, 11, 2, '2019-03-21 20:26:08'),
(3, 11, 3, '2019-03-21 20:25:40'),
(5, 11, 14, '2019-03-21 20:26:12'),
(6, 11, 4, '2019-03-21 21:05:12'),
(7, 11, 3, '2019-03-22 12:07:49'),
(8, 11, 5, '2019-03-22 12:07:59'),
(9, 11, 14, '2019-03-22 14:04:06'),
(10, 11, 14, '2019-03-22 14:19:08'),
(11, 11, 2, '2019-03-22 14:24:14'),
(12, 11, 3, '2019-03-22 14:24:16'),
(13, 11, 3, '2019-03-22 14:27:32'),
(14, 11, 3, '2019-03-22 14:28:03'),
(15, 11, 16, '2019-03-22 14:33:45'),
(16, 11, 16, '2019-03-22 14:34:37'),
(17, 11, 16, '2019-03-22 14:34:41'),
(18, 11, 16, '2019-03-22 14:36:05'),
(19, 11, 16, '2019-03-22 14:37:15'),
(20, 11, 16, '2019-03-22 14:38:04'),
(21, 11, 16, '2019-03-22 15:07:07'),
(22, 11, 16, '2019-03-22 15:07:32'),
(23, 11, 16, '2019-03-22 15:08:58'),
(24, 11, 16, '2019-03-22 15:08:59'),
(25, 11, 16, '2019-03-22 15:09:00'),
(26, 11, 16, '2019-03-22 15:16:39'),
(27, 11, 16, '2019-03-22 15:16:40'),
(28, 11, 16, '2019-03-22 15:17:15'),
(29, 11, 16, '2019-03-22 15:17:17'),
(30, 11, 16, '2019-03-22 15:17:19'),
(31, 11, 16, '2019-03-22 15:17:21'),
(32, 11, 16, '2019-03-22 15:17:23'),
(33, 11, 16, '2019-03-22 15:18:55'),
(34, 11, 16, '2019-03-22 15:19:53'),
(35, 11, 16, '2019-03-22 15:19:56'),
(36, 11, 16, '2019-03-22 15:19:59'),
(37, 11, 16, '2019-03-22 15:20:02'),
(38, 11, 16, '2019-03-22 15:22:02'),
(39, 11, 16, '2019-03-22 15:22:05'),
(40, 11, 16, '2019-03-22 15:22:08'),
(41, 11, 16, '2019-03-22 15:23:34'),
(42, 11, 16, '2019-03-22 15:24:05'),
(43, 11, 16, '2019-03-22 15:24:07'),
(44, 11, 16, '2019-03-22 15:24:10'),
(45, 11, 16, '2019-03-22 15:24:12'),
(46, 11, 16, '2019-03-22 15:24:15'),
(47, 11, 16, '2019-03-22 15:24:17'),
(48, 11, 16, '2019-03-22 15:24:58'),
(49, 11, 16, '2019-03-22 15:25:33'),
(50, 11, 16, '2019-03-22 15:25:54'),
(51, 11, 16, '2019-03-22 15:26:25'),
(52, 11, 16, '2019-03-22 15:26:26'),
(53, 11, 16, '2019-03-22 15:26:28'),
(54, 11, 16, '2019-03-22 15:26:29'),
(55, 11, 16, '2019-03-22 15:26:31'),
(56, 11, 16, '2019-03-22 15:27:00'),
(57, 11, 16, '2019-03-22 15:27:08'),
(58, 11, 16, '2019-03-22 15:27:20'),
(59, 11, 16, '2019-03-22 15:27:24'),
(60, 11, 16, '2019-03-22 15:27:39'),
(61, 11, 16, '2019-03-22 15:35:29'),
(62, 11, 16, '2019-03-22 15:35:32'),
(63, 11, 16, '2019-03-22 15:35:58'),
(64, 11, 16, '2019-03-22 15:36:03'),
(65, 11, 16, '2019-03-22 15:36:04'),
(66, 11, 16, '2019-03-22 15:36:22'),
(67, 11, 16, '2019-03-22 15:36:26'),
(68, 11, 16, '2019-03-22 15:36:27'),
(69, 11, 16, '2019-03-22 15:36:28'),
(70, 11, 16, '2019-03-22 15:37:03'),
(71, 11, 16, '2019-03-22 15:37:31'),
(72, 11, 16, '2019-03-22 15:38:20'),
(73, 11, 16, '2019-03-22 15:38:22'),
(74, 11, 16, '2019-03-22 15:38:23'),
(75, 11, 16, '2019-03-22 15:38:23'),
(76, 11, 16, '2019-03-22 15:38:24'),
(77, 11, 16, '2019-03-22 15:38:24'),
(78, 11, 16, '2019-03-22 15:38:24'),
(79, 11, 16, '2019-03-22 15:38:25'),
(80, 11, 16, '2019-03-22 15:38:25'),
(81, 11, 16, '2019-03-22 15:38:25'),
(82, 11, 16, '2019-03-22 15:38:25'),
(83, 11, 16, '2019-03-22 15:39:29'),
(84, 11, 16, '2019-03-22 15:39:33'),
(85, 11, 16, '2019-03-22 15:39:38'),
(86, 11, 16, '2019-03-22 15:39:40'),
(87, 11, 16, '2019-03-22 15:39:59'),
(88, 11, 16, '2019-03-22 15:40:25'),
(89, 11, 16, '2019-03-22 15:40:36'),
(90, 11, 16, '2019-03-22 15:40:43'),
(91, 11, 16, '2019-03-22 15:51:37'),
(92, 11, 16, '2019-03-22 15:53:04'),
(93, 11, 16, '2019-03-22 15:53:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblslider`
--

DROP TABLE IF EXISTS `tblslider`;
CREATE TABLE IF NOT EXISTS `tblslider` (
  `idSlider` int(11) NOT NULL AUTO_INCREMENT,
  `strTexto` text,
  `strImagen` varchar(120) DEFAULT NULL,
  `strLink` varchar(220) DEFAULT NULL,
  `intEstado` int(11) DEFAULT NULL,
  `intOrden` int(11) DEFAULT NULL,
  PRIMARY KEY (`idSlider`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tblslider`
--

INSERT INTO `tblslider` (`idSlider`, `strTexto`, `strImagen`, `strLink`, `intEstado`, `intOrden`) VALUES
(1, '<h1>Oferta hasta agotar stock</h1>\r\n<h2 style=\"box-sizing: border-box; font-family: Roboto, sans-serif; font-weight: 500; line-height: 1.1; color: #363432; margin-top: 0px; margin-bottom: 10px; font-size: 20px; background-color: #ffffff;\">Harina Pureza 0000</h2>\r\n<p><span style=\"color: #363432; font-family: Roboto, sans-serif; font-size: 16px; background-color: #ffffff;\">Solo valida hasta el 24/03/19 23:59</span></p>', 'slider-harina.png', '/harinas/harina-pureza-0000.html', 1, 1),
(2, '<h1>Aprovech&aacute; esta oferta!</h1>\r\n<h2>Aceite de oliva intenso</h2>\r\n<p>Solo valida hasta el 24/03/19</p>', 'SLIDER.png', '/yerba-mate/yerba-mate-con-palo-barbacua.html', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblusuario`
--

DROP TABLE IF EXISTS `tblusuario`;
CREATE TABLE IF NOT EXISTS `tblusuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `strEmail` varchar(50) DEFAULT NULL,
  `strPassword` varchar(50) DEFAULT NULL,
  `strNombre` varchar(30) DEFAULT NULL,
  `intNivel` int(11) NOT NULL DEFAULT '0',
  `intEstado` int(11) NOT NULL DEFAULT '1',
  `strImagen` varchar(50) DEFAULT NULL,
  `fchAlta` datetime DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `strEmail` (`strEmail`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblusuario`
--

INSERT INTO `tblusuario` (`idUsuario`, `strEmail`, `strPassword`, `strNombre`, `intNivel`, `intEstado`, `strImagen`, `fchAlta`) VALUES
(1, 'sdfrrdsf@333fsd.com', '26fe0cdfe99bfa306e31733c4e2b17dc', 'Pepe López', 0, 1, 'face2.jpg', NULL),
(2, 'jorvidu@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Jorge', 1, 1, '', NULL),
(3, 'wdfdes@fsdf.com', '42be65bff2c5725e883a43de69147c85', '0980', 10, 1, '', NULL),
(4, '345345@dsgftd.comn', 'a06cef7b78ecfb2461fe6ab2ac847fa0', '876', 100, 1, '', NULL),
(5, 'publico@fsdf.com', '4ede4fbf6e52d6dd0f25ad91c016db82', '098', 0, 1, NULL, NULL),
(6, 'dksjf@sdfdsf.com', 'df6d2338b2b8fce1ec2f6dda0a630eb0', 'Luis José', 0, 1, 'facerisas.jpg', NULL),
(8, 'wefwf', '5f9a177892f1e4ecb3484ba5a82fb813', 'fewfe', 0, 1, NULL, NULL),
(9, 'ergerg@dsfgf.com', '92daa86ad43a42f28f4bf58e94667c95', '09u', 0, 1, NULL, NULL),
(10, 'casassfranco@gmail.com', 'c2a665a59507e2dc1422a133d361299a', 'franco casas', 1, 1, NULL, NULL),
(11, 'tiendaonline@tradeactivities.com', '81dc9bdb52d04dc20036dbd8313ed055', 'AdminPublico', 0, 1, NULL, NULL),
(25, '123456@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'xxx123456', 0, 1, NULL, NULL),
(26, NULL, 'd41d8cd98f00b204e9800998ecf8427e', NULL, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblzona`
--

DROP TABLE IF EXISTS `tblzona`;
CREATE TABLE IF NOT EXISTS `tblzona` (
  `idZona` int(11) NOT NULL AUTO_INCREMENT,
  `strNombre` varchar(50) DEFAULT NULL,
  `intEstado` int(11) DEFAULT NULL,
  `refPadre` int(11) DEFAULT NULL,
  `dblInferior` double DEFAULT NULL,
  `dblSuperior` double DEFAULT NULL,
  `dblCoste` double DEFAULT NULL,
  PRIMARY KEY (`idZona`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tblzona`
--

INSERT INTO `tblzona` (`idZona`, `strNombre`, `intEstado`, `refPadre`, `dblInferior`, `dblSuperior`, `dblCoste`) VALUES
(1, 'Barrio Norte', 1, 0, NULL, NULL, NULL),
(4, 'Peso Minimo', 1, 1, -1, 5, 25),
(5, 'Peso Medio', 1, 1, 5, 15, 35),
(6, 'Peso Maximo', 1, 1, 15, 50, 50),
(8, 'Barrio Sur', 1, 0, NULL, NULL, NULL),
(9, 'Peso Minimo', 1, 8, -1, 5, 30),
(10, 'Peso Medio', 1, 8, 5, 15, 40),
(11, 'Peso Maximo', 1, 8, 15, 50, 55);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
