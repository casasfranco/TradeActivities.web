-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 21-03-2019 a las 15:18:22
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
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tblcarrito`
--

INSERT INTO `tblcarrito` (`idContador`, `refUsuario`, `refProducto`, `intCantidad`, `intTransaccionEfectuada`) VALUES
(63, 11, 2, 2, 5),
(64, 11, 2, 1, 0);

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
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblcategoria`
--

INSERT INTO `tblcategoria` (`idCategoria`, `strNombre`, `strSEO`, `intEstado`, `refPadre`, `intOrden`) VALUES
(1, 'Chocolates', 'chocolates', 1, 0, 1),
(3, 'Yerba Mate', 'yerba-mate', 1, 0, 2),
(4, 'dfegerg', 'dfegerg', 1, 0, 54),
(6, 'sub chocolates', 'sub-chocolates', 1, 1, 1),
(12, 'Premezclas', 'premezclas', 1, 0, 1),
(13, '9 de Oro', '9-de-oro', 1, 0, 1),
(14, 'Yerba Mate BCP', 'yerba-mate-bcp', 1, 3, 1),
(15, 'Todos los chocolates', 'todos-los-chocolates', 1, 1, 123);

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tblcompra`
--

INSERT INTO `tblcompra` (`idCompra`, `idUsuario`, `fchCompra`, `intTipoPago`, `dblTotalIVA`, `dblTotalsinIVA`, `intFacturacion`, `intEnvio`, `intEstado`, `intZona`, `strNombre`, `strDNI`, `strDireccion`, `strPiso`, `strProvincia`, `strCP`, `strEmail`, `strTelefono`) VALUES
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblproducto`
--

INSERT INTO `tblproducto` (`idProducto`, `strNombre`, `strSEO`, `refCategoria1`, `strImagen1`, `strDescripcion`, `dblPrecio`, `dblPrecioAnterior`, `intEstado`, `refMarca`, `refCategoria2`, `refCategoria3`, `refCategoria4`, `refCategoria5`, `strImagen2`, `strImagen3`, `strImagen4`, `strImagen5`, `intPrincipal`, `intStock`, `refImpuesto`, `dblPeso`) VALUES
(1, 'Seat África', 'seat-africa', 1, NULL, '<p>Coche grande y espacioso</p>', 8000.00, 0.00, 1, 1, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 10, 5, 0),
(2, 'Yerba Mate Rosamonte', 'yerba-mate-rosamonte', 3, 'YERBA-MATE-ROSAMONTE.jpg', '<p>Yerba mate Rosamonte</p>', 36.05, 445.00, 1, 8, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 10, 5, 12),
(3, 'Yerba Mate con palo Barbacuá', 'yerba-mate-con-palo-barbacua', 3, 'YERLABOC500.jpg', '<p>87</p>', 43.00, 0.00, 1, 7, 0, 0, 0, 0, 'bananitaDLC.png', NULL, NULL, NULL, 1, 10, 2, 0),
(4, 'Galleta Azucaradas', 'galleta-azucaradas', 1, '9doroazucarados.jpg', '<p>Galltas azucaradas 9 de oro</p>', 31.00, 0.00, 1, 6, 6, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 10, 5, 0),
(5, 'Kit Kat', 'kit-kat', 1, 'KitKat.jpeg', NULL, 27.34, 0.00, 1, 1, 6, 15, 0, 0, NULL, NULL, NULL, NULL, 1, 10, 4, 23),
(14, 'Leche Condensada', 'leche-condensada', 1, 'LaLechera-Nestle-400x400.jpg', '<p>Leche condensada Nestl&eacute;</p>', 24.17, 0.00, 1, 1, 6, 0, 0, 0, '250225.jpg', 'KitKatCaja.jpg', NULL, NULL, 1, 8, 5, 11),
(15, 'Prueba imagenNoDisponible', 'prueba-imagennodisponible', 1, NULL, '<p>sdasdasdasdasd</p>', 123.00, 0.00, 1, 1, 6, 15, 0, 0, NULL, NULL, NULL, NULL, 1, 2, 5, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

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
(17, NULL, NULL, NULL, 0, 1, NULL, '2019-03-13 04:10:32'),
(18, NULL, NULL, NULL, 0, 1, NULL, '2019-03-20 11:01:41'),
(19, NULL, NULL, NULL, 0, 1, NULL, '2019-03-21 00:17:25'),
(25, 'xxxx123456@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'xxx123456', 0, 1, NULL, NULL);

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
