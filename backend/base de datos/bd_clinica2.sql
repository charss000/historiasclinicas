-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-07-2021 a las 03:35:22
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 7.4.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_clinica2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adjunto`
--

CREATE TABLE `adjunto` (
  `idadjunto` int(11) NOT NULL,
  `idpaciente` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `file` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `size` varchar(255) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `idservicio` int(11) NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `um` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `cantidad` decimal(10,2) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `importe` decimal(10,2) NOT NULL,
  `session_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `idcita` int(11) NOT NULL,
  `idpaciente` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `cupo` int(11) DEFAULT NULL,
  `fec_ho_impresion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` enum('enespera','atendido') COLLATE utf8_spanish2_ci DEFAULT NULL,
  `idventa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `idconfi` int(11) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `razon_social` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `mon_simbolo` varchar(255) NOT NULL,
  `moneda` varchar(100) NOT NULL DEFAULT '''NULL''',
  `imp_num` varchar(255) NOT NULL,
  `imp_letra` varchar(255) NOT NULL,
  `zona_horaria` varchar(255) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `ruc` char(11) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `responsable` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`idconfi`, `logo`, `razon_social`, `mon_simbolo`, `moneda`, `imp_num`, `imp_letra`, `zona_horaria`, `direccion`, `ruc`, `telefono`, `responsable`) VALUES
(1, 'descarga.jpg', 'CLINICA SISTEMASINFOR', 'S/', 'SOLES', '18', 'IGV', 'America/Lima', 'TUMBES-PERU', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleventa`
--

CREATE TABLE `detalleventa` (
  `idventa` int(11) NOT NULL,
  `idservicio_v` int(11) NOT NULL,
  `cantidad` decimal(10,2) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `importe` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dias`
--

CREATE TABLE `dias` (
  `iddia` int(11) NOT NULL,
  `dia` enum('lunes','martes','miercoles','jueves','viernes','sabado','domingo') COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `dias`
--

INSERT INTO `dias` (`iddia`, `dia`) VALUES
(1, 'lunes'),
(2, 'martes'),
(3, 'miercoles'),
(4, 'jueves'),
(5, 'viernes'),
(6, 'sabado'),
(7, 'domingo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dia_usuario`
--

CREATE TABLE `dia_usuario` (
  `idd` int(11) NOT NULL,
  `idu` int(11) NOT NULL,
  `estado` int(11) DEFAULT 0,
  `hora_inicio` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  `duracion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE `especialidad` (
  `idespecial` int(11) NOT NULL,
  `especialidad` varchar(255) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `especialidad`
--

INSERT INTO `especialidad` (`idespecial`, `especialidad`) VALUES
(1, 'administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen`
--

CREATE TABLE `examen` (
  `idexamen` int(11) NOT NULL,
  `idlabo` int(11) NOT NULL,
  `analisis` varchar(255) COLLATE utf8_spanish2_ci DEFAULT '''''''NULL''''''',
  `resultado` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `referencia` varchar(255) COLLATE utf8_spanish2_ci DEFAULT 'NULL'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historia`
--

CREATE TABLE `historia` (
  `idhistoria` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idpaciente` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `edad` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `talla` decimal(10,2) NOT NULL,
  `peso` decimal(10,3) NOT NULL,
  `pre_mmhg` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `frec_res_x` int(11) NOT NULL,
  `temperatura_c` int(11) NOT NULL,
  `frec_cardiaca_x` int(11) NOT NULL,
  `imc` decimal(10,1) NOT NULL,
  `motivo` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `examen_fisico` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `diagnostico` text COLLATE utf8_spanish2_ci NOT NULL,
  `tratamiento` varchar(255) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laboratorio`
--

CREATE TABLE `laboratorio` (
  `idlab` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idpaciente` int(11) NOT NULL,
  `edad` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `examen` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `responsable` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `f_muestra` date DEFAULT NULL,
  `f_entrega` date DEFAULT NULL,
  `idventa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `idpaciente` int(11) NOT NULL,
  `paciente` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `sexo` enum('masculino','femenino') COLLATE utf8_spanish2_ci NOT NULL,
  `fec_nacimiento` date NOT NULL,
  `documento_pa` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `estado_civil` enum('soltero','casado','viudo','divorciado','conviviente') COLLATE utf8_spanish2_ci NOT NULL,
  `direccion_pa` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `telefono` varchar(15) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `apoderado` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `num_historia` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `idservicio` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `um` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `stock` decimal(10,2) DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `idusu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusu` int(11) NOT NULL,
  `idespecialidad` int(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `sexo` enum('masculino','femenino') NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `documento` varchar(15) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `tipo` enum('administrador','usuario','laboratorio') NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `estado` enum('activo','inactivo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusu`, `idespecialidad`, `nombres`, `sexo`, `fecha_nacimiento`, `documento`, `direccion`, `email`, `telefono`, `tipo`, `usuario`, `clave`, `estado`) VALUES
(1, 1, 'sistemasinfor admin', 'masculino', '0000-00-00', '', '', '', '', 'administrador', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `idventa` int(11) NOT NULL,
  `idpaciente_v` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `igv` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `tipo_docu` varchar(30) NOT NULL,
  `num_docu` varchar(255) NOT NULL,
  `serie` varchar(50) NOT NULL,
  `observacion` varchar(255) DEFAULT NULL,
  `usuario` varchar(100) NOT NULL,
  `estado` enum('pagado','pendiente') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adjunto`
--
ALTER TABLE `adjunto`
  ADD PRIMARY KEY (`idadjunto`),
  ADD KEY `FK_adjunto_paciente_idpaciente` (`idpaciente`);

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`idcita`),
  ADD KEY `FK_cita_usuario_idusu` (`idusuario`),
  ADD KEY `FK_cita_paciente_idpaciente` (`idpaciente`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`idconfi`);

--
-- Indices de la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  ADD KEY `FK_detalleventa_venta_idventa` (`idventa`),
  ADD KEY `FK_detalleventa_servicio_idservicio` (`idservicio_v`);

--
-- Indices de la tabla `dias`
--
ALTER TABLE `dias`
  ADD PRIMARY KEY (`iddia`);

--
-- Indices de la tabla `dia_usuario`
--
ALTER TABLE `dia_usuario`
  ADD KEY `FK_dia_usuario_dias_iddia` (`idd`),
  ADD KEY `FK_dia_usuario_usuario_idusu` (`idu`);

--
-- Indices de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  ADD PRIMARY KEY (`idespecial`);

--
-- Indices de la tabla `examen`
--
ALTER TABLE `examen`
  ADD PRIMARY KEY (`idexamen`),
  ADD KEY `FK_examen_laboratorio_idlab` (`idlabo`);

--
-- Indices de la tabla `historia`
--
ALTER TABLE `historia`
  ADD PRIMARY KEY (`idhistoria`),
  ADD KEY `FK_historia_paciente_idpaciente` (`idpaciente`),
  ADD KEY `FK_historia_usuario_idusu` (`idusuario`);

--
-- Indices de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  ADD PRIMARY KEY (`idlab`),
  ADD KEY `FK_laboratorio_usuario_idusu` (`idusuario`),
  ADD KEY `FK_laboratorio_paciente_idpaciente` (`idpaciente`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`idpaciente`),
  ADD UNIQUE KEY `num_historia` (`num_historia`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`idservicio`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusu`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD KEY `FK_usuario_especialidad_idespecial` (`idespecialidad`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`idventa`),
  ADD KEY `FK_venta_paciente_idpaciente` (`idpaciente_v`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `adjunto`
--
ALTER TABLE `adjunto`
  MODIFY `idadjunto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `idcita` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `idconfi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `dias`
--
ALTER TABLE `dias`
  MODIFY `iddia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  MODIFY `idespecial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `examen`
--
ALTER TABLE `examen`
  MODIFY `idexamen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historia`
--
ALTER TABLE `historia`
  MODIFY `idhistoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  MODIFY `idlab` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `idpaciente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `idservicio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `idventa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `adjunto`
--
ALTER TABLE `adjunto`
  ADD CONSTRAINT `FK_adjunto_paciente_idpaciente` FOREIGN KEY (`idpaciente`) REFERENCES `paciente` (`idpaciente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `FK_cita_paciente_idpaciente` FOREIGN KEY (`idpaciente`) REFERENCES `paciente` (`idpaciente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_cita_usuario_idusu` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  ADD CONSTRAINT `FK_detalleventa_servicio_idservicio` FOREIGN KEY (`idservicio_v`) REFERENCES `servicio` (`idservicio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_detalleventa_venta_idventa` FOREIGN KEY (`idventa`) REFERENCES `venta` (`idventa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `dia_usuario`
--
ALTER TABLE `dia_usuario`
  ADD CONSTRAINT `FK_dia_usuario_dias_iddia` FOREIGN KEY (`idd`) REFERENCES `dias` (`iddia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_dia_usuario_usuario_idusu` FOREIGN KEY (`idu`) REFERENCES `usuario` (`idusu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `examen`
--
ALTER TABLE `examen`
  ADD CONSTRAINT `FK_examen_laboratorio_idlab` FOREIGN KEY (`idlabo`) REFERENCES `laboratorio` (`idlab`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `historia`
--
ALTER TABLE `historia`
  ADD CONSTRAINT `FK_historia_paciente_idpaciente` FOREIGN KEY (`idpaciente`) REFERENCES `paciente` (`idpaciente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_historia_usuario_idusu` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  ADD CONSTRAINT `FK_laboratorio_paciente_idpaciente` FOREIGN KEY (`idpaciente`) REFERENCES `paciente` (`idpaciente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_laboratorio_usuario_idusu` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_usuario_especialidad_idespecial` FOREIGN KEY (`idespecialidad`) REFERENCES `especialidad` (`idespecial`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `FK_venta_paciente_idpaciente` FOREIGN KEY (`idpaciente_v`) REFERENCES `paciente` (`idpaciente`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
