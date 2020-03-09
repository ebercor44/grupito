-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-03-2020 a las 11:13:06
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `grupito`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepedido`
--

CREATE TABLE `detallepedido` (
  `idDetallePedido` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detallepedido`
--

INSERT INTO `detallepedido` (`idDetallePedido`, `idPedido`, `idProducto`, `cantidad`, `precio`) VALUES
(1, 16, 4, 2, '9.99'),
(2, 17, 4, 2, '9.99'),
(3, 19, 5, 2, '12.99'),
(4, 19, 8, 1, '18.99'),
(5, 19, 4, 1, '9.99');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadopedido`
--

CREATE TABLE `estadopedido` (
  `idEstadoPedido` int(11) NOT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estadopedido`
--

INSERT INTO `estadopedido` (`idEstadoPedido`, `estado`) VALUES
(1, 'Pendiente de envío'),
(2, 'Enviado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `idPedido` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total` decimal(10,2) NOT NULL,
  `estado` int(11) NOT NULL,
  `online` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`idPedido`, `idUsuario`, `fecha`, `total`, `estado`, `online`) VALUES
(16, 1, '2020-03-05 13:52:37', '19.98', 1, 1),
(17, 1, '2020-03-05 13:52:59', '19.98', 1, 1),
(19, 1, '2020-03-09 10:49:36', '54.96', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProducto` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `introDescripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `precioOferta` decimal(10,2) NOT NULL,
  `online` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `nombre`, `introDescripcion`, `descripcion`, `imagen`, `precio`, `precioOferta`, `online`) VALUES
(4, 'Pizza', 'Oferta en nuestra pizzas medianas.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vulputate urna at lobortis auctor. Curabitur ultricies vestibulum diam eget hendrerit. Ut ac justo laoreet, tempor justo id, semper elit.', 'telepizza.jpg', '15.99', '9.99', 1),
(5, 'Sushi', 'Oferta bandeja de sushi completa.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vulputate urna at lobortis auctor. Curabitur ultricies vestibulum diam eget hendrerit. Ut ac justo laoreet, tempor justo id, semper elit.', 'sushi.jpg', '19.99', '12.99', 1),
(6, 'Tazas', 'Pack de 3 tazas personalizables con fotos.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vulputate urna at lobortis auctor. Curabitur ultricies vestibulum diam eget hendrerit. Ut ac justo laoreet, tempor justo id, semper elit.', 'tazas.jpg', '14.99', '9.99', 1),
(7, 'Masaje', 'Masaje relajante con piedras calientes.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vulputate urna at lobortis auctor. Curabitur ultricies vestibulum diam eget hendrerit. Ut ac justo laoreet, tempor justo id, semper elit.', 'masaje.jpg', '30.99', '22.99', 1),
(8, 'Yelmo', 'Oferta familiar en Yelmo Cines.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vulputate urna at lobortis auctor. Curabitur ultricies vestibulum diam eget hendrerit. Ut ac justo laoreet, tempor justo id, semper elit.', 'yelmo.jpg', '25.99', '18.99', 1),
(9, 'Comida mexicana', 'Oferta en tacos mexicanos.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vulputate urna at lobortis auctor. Curabitur ultricies vestibulum diam eget hendrerit. Ut ac justo laoreet, tempor justo id, semper elit.', 'comida.jpg', '22.99', '14.99', 1),
(10, 'Peluqueria', 'Oferta en peinados y tinte.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vulputate urna at lobortis auctor. Curabitur ultricies vestibulum diam eget hendrerit. Ut ac justo laoreet, tempor justo id, semper elit.', 'moza.jpg', '12.99', '8.99', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `online` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `email`, `password`, `nombre`, `apellidos`, `direccion`, `telefono`, `online`) VALUES
(1, 'eber@gmail.com', '$2y$10$I8hPkjspXOldvx.FpZP2fepKQVKBoFUVKEX8I/TyivRYP5pD46672', 'Éber', 'Cordeiro Martínez', 'C/ María Martín nº2 2ºE', '629262356', 1),
(2, 'nerea@gmail.com', '$2y$10$GBC.LeGhuD6ju89xESdknuBWtph2.8rA5uP.anx2/1TbYwGCL0YIu', 'Nerea', 'Pena Fernández', 'Avenida Fragata Almansa nº20 P2 4ºA', '628477469', 1),
(3, 'manuel@gmail.com', '$2y$10$NocV12YE8NfN5KklyDSSi.lLMRtdt8yhWq.nqw0HDb6DSeiaNPpYm', 'Manuel', 'Vázquez Suárez', 'C/ Albarren nº18', '677899498', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD PRIMARY KEY (`idDetallePedido`),
  ADD KEY `idPedido` (`idPedido`),
  ADD KEY `idProducto` (`idProducto`);

--
-- Indices de la tabla `estadopedido`
--
ALTER TABLE `estadopedido`
  ADD PRIMARY KEY (`idEstadoPedido`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idPedido`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `estado` (`estado`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProducto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  MODIFY `idDetallePedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estadopedido`
--
ALTER TABLE `estadopedido`
  MODIFY `idEstadoPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD CONSTRAINT `detallepedido_ibfk_1` FOREIGN KEY (`idPedido`) REFERENCES `pedidos` (`idPedido`),
  ADD CONSTRAINT `detallepedido_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`estado`) REFERENCES `estadopedido` (`idEstadoPedido`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
