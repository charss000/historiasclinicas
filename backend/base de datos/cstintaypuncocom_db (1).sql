-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 13-02-2024 a las 07:50:44
-- Versión del servidor: 10.5.22-MariaDB-cll-lve
-- Versión de PHP: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cstintaypuncocom_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adjunto`
--

CREATE TABLE `adjunto` (
  `idadjunto` int(11) NOT NULL,
  `idpaciente` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `fecha` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `adjunto`
--

INSERT INTO `adjunto` (`idadjunto`, `idpaciente`, `descripcion`, `fecha`, `file`, `type`, `size`) VALUES
(3, 10, 'hemoglobina', '2024-01-18', '13263-logo-tintay-punco-sin-fondo.png', 'image/png', '365.6669921875'),
(4, 13, 'hemoglobina', '2024-01-20', '96884-logo-tintay-punco-sin-fondo.png', 'image/png', '365.6669921875'),
(6, 12, 'examen de orina', '2024-02-09', '85437-english_comp_urinalysis_mdb-analytes.jpg__850x1078_q80_subsampling-2.jpg', 'image/jpeg', '60.171875');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `idcita` int(11) NOT NULL,
  `idpaciente` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` varchar(50) NOT NULL,
  `cupo` int(11) DEFAULT NULL,
  `fec_ho_impresion` varchar(100) NOT NULL,
  `estado` enum('enespera','atendido') DEFAULT NULL,
  `idventa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cita`
--

INSERT INTO `cita` (`idcita`, `idpaciente`, `idusuario`, `fecha`, `hora`, `cupo`, `fec_ho_impresion`, `estado`, `idventa`) VALUES
(24, 9, 3, '2024-01-23', '09:00', NULL, '2024-01-19 16:04:55', 'enespera', 51),
(26, 13, 13, '2024-01-20', '09:15', NULL, '2024-01-20 08:23:15', 'atendido', 55),
(27, 13, 13, '2024-01-25', '09:50', NULL, '2024-01-20 09:07:05', 'enespera', 58),
(29, 12, 13, '2024-01-29', '09:55', NULL, '2024-01-29 09:35:43', 'atendido', 59),
(31, 14, 13, '2024-02-10', '09:15', NULL, '2024-02-09 14:44:00', 'atendido', 61),
(32, 12, 13, '2024-02-12', '10:45', NULL, '2024-02-10 11:56:38', 'enespera', 63),
(33, 10, 13, '2024-02-19', '09:30', NULL, '2024-02-12 17:44:10', 'enespera', 64);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`idconfi`, `logo`, `razon_social`, `mon_simbolo`, `moneda`, `imp_num`, `imp_letra`, `zona_horaria`, `direccion`, `ruc`, `telefono`, `responsable`) VALUES
(1, 'LOGO_TINTAY.JPG', 'CENTRO DE SALUD TINTAY PUNCO', 'S/.', 'SOLES', '18', 'IGV', 'America/Lima', 'DISTRITO DE TINTAY PUNCO - PROVINCIA TAYACAJA - DEPARTAMENTO DE HUANCAVELICA', '20601077133', '976108398', 'ERNESTO QUISPEALAYA CALDAS, ANDREA ALEJANDRA CHUCHON SOTO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleventa`
--

CREATE TABLE `detalleventa` (
  `id` int(11) NOT NULL,
  `idventa` int(11) NOT NULL,
  `idservicio_v` int(11) NOT NULL,
  `cantidad` decimal(10,2) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `importe` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `detalleventa`
--

INSERT INTO `detalleventa` (`id`, `idventa`, `idservicio_v`, `cantidad`, `precio`, `importe`) VALUES
(51, 50, 7, 1.00, 14.00, 14.00),
(53, 51, 10, 1.00, 12.00, 12.00),
(54, 52, 10, 1.00, 12.00, 12.00),
(55, 53, 11, 1.00, 12.00, 12.00),
(57, 55, 11, 1.00, 12.00, 12.00),
(58, 56, 3, 1.00, 10.00, 10.00),
(59, 57, 3, 1.00, 10.00, 10.00),
(60, 58, 11, 1.00, 12.00, 12.00),
(62, 59, 11, 1.00, 12.00, 12.00),
(63, 60, 8, 1.00, 1.20, 1.20),
(64, 60, 7, 1.00, 14.00, 14.00),
(66, 61, 11, 1.00, 12.00, 12.00),
(67, 62, 7, 1.00, 14.00, 14.00),
(68, 63, 11, 1.00, 12.00, 12.00),
(69, 64, 11, 1.00, 12.00, 12.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dias`
--

CREATE TABLE `dias` (
  `iddia` int(11) NOT NULL,
  `dia` enum('lunes','martes','miercoles','jueves','viernes','sabado','domingo') NOT NULL
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
  `id` int(11) NOT NULL,
  `idd` int(11) NOT NULL,
  `idu` int(11) NOT NULL,
  `estado` int(11) DEFAULT 0,
  `hora_inicio` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  `duracion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `dia_usuario`
--

INSERT INTO `dia_usuario` (`id`, `idd`, `idu`, `estado`, `hora_inicio`, `hora_fin`, `duracion`) VALUES
(1, 1, 2, 0, NULL, NULL, NULL),
(2, 2, 2, 0, NULL, NULL, NULL),
(3, 3, 2, 0, NULL, NULL, NULL),
(4, 4, 2, 0, NULL, NULL, NULL),
(5, 5, 2, 0, NULL, NULL, NULL),
(6, 6, 2, 0, NULL, NULL, NULL),
(7, 7, 2, 0, NULL, NULL, NULL),
(8, 1, 3, 0, NULL, NULL, NULL),
(9, 2, 3, 1, '08:00:00', '11:00:00', 20),
(10, 3, 3, 0, NULL, NULL, NULL),
(11, 4, 3, 0, NULL, NULL, NULL),
(12, 5, 3, 0, NULL, NULL, NULL),
(13, 6, 3, 0, NULL, NULL, NULL),
(14, 7, 3, 0, NULL, NULL, NULL),
(15, 1, 4, 0, NULL, NULL, NULL),
(16, 2, 4, 0, NULL, NULL, NULL),
(17, 3, 4, 0, NULL, NULL, NULL),
(18, 4, 4, 0, NULL, NULL, NULL),
(19, 5, 4, 1, '08:00:00', '13:00:00', 10),
(20, 6, 4, 0, NULL, NULL, NULL),
(21, 7, 4, 0, NULL, NULL, NULL),
(22, 1, 5, 1, '08:30:00', '11:00:00', 15),
(23, 2, 5, 0, NULL, NULL, NULL),
(24, 3, 5, 0, NULL, NULL, NULL),
(25, 4, 5, 0, NULL, NULL, NULL),
(26, 5, 5, 0, NULL, NULL, NULL),
(27, 6, 5, 0, NULL, NULL, NULL),
(28, 7, 5, 0, NULL, NULL, NULL),
(29, 1, 6, 0, NULL, NULL, NULL),
(30, 2, 6, 0, NULL, NULL, NULL),
(31, 3, 6, 0, NULL, NULL, NULL),
(32, 4, 6, 0, NULL, NULL, NULL),
(33, 5, 6, 0, NULL, NULL, NULL),
(34, 6, 6, 0, NULL, NULL, NULL),
(35, 7, 6, 0, NULL, NULL, NULL),
(36, 1, 7, 0, NULL, NULL, NULL),
(37, 2, 7, 0, NULL, NULL, NULL),
(38, 3, 7, 0, NULL, NULL, NULL),
(39, 4, 7, 0, NULL, NULL, NULL),
(40, 5, 7, 0, NULL, NULL, NULL),
(41, 6, 7, 0, NULL, NULL, NULL),
(42, 7, 7, 0, NULL, NULL, NULL),
(43, 1, 8, 1, '08:41:00', '13:41:00', 35),
(44, 2, 8, 1, '09:43:00', '08:43:00', 30),
(45, 3, 8, 1, '10:44:00', '14:44:00', 30),
(46, 4, 8, 1, '23:35:00', '02:38:00', 17),
(47, 5, 8, 0, NULL, NULL, NULL),
(48, 6, 8, 0, NULL, NULL, NULL),
(49, 7, 8, 0, NULL, NULL, NULL),
(50, 1, 9, 1, '23:20:00', '04:26:00', 1),
(51, 2, 9, 1, '08:23:00', '18:22:00', 2),
(52, 3, 9, 1, '13:00:00', '14:00:00', 5),
(53, 4, 9, 0, NULL, NULL, NULL),
(54, 5, 9, 0, '19:00:00', '21:00:00', 2),
(55, 6, 9, 0, NULL, NULL, NULL),
(56, 7, 9, 0, NULL, NULL, NULL),
(57, 1, 10, 0, NULL, NULL, NULL),
(58, 2, 10, 0, NULL, NULL, NULL),
(59, 3, 10, 0, NULL, NULL, NULL),
(60, 4, 10, 0, NULL, NULL, NULL),
(61, 5, 10, 0, NULL, NULL, NULL),
(62, 6, 10, 0, NULL, NULL, NULL),
(63, 7, 10, 0, NULL, NULL, NULL),
(64, 1, 11, 1, '16:30:00', '18:00:00', 15),
(65, 2, 11, 1, '16:30:00', '18:00:00', 15),
(66, 3, 11, 0, NULL, NULL, NULL),
(67, 4, 11, 0, NULL, NULL, NULL),
(68, 5, 11, 1, '02:00:00', '04:00:00', 20),
(69, 6, 11, 0, '10:00:00', '12:00:00', 20),
(70, 7, 11, 0, NULL, NULL, NULL),
(71, 1, 12, 0, NULL, NULL, NULL),
(72, 2, 12, 0, NULL, NULL, NULL),
(73, 3, 12, 0, NULL, NULL, NULL),
(74, 4, 12, 0, NULL, NULL, NULL),
(75, 5, 12, 0, NULL, NULL, NULL),
(76, 6, 12, 0, NULL, NULL, NULL),
(77, 7, 12, 0, NULL, NULL, NULL),
(78, 1, 13, 1, '09:30:00', '12:30:00', 25),
(79, 2, 13, 0, '09:00:00', '12:00:00', 25),
(80, 3, 13, 0, NULL, NULL, NULL),
(81, 4, 13, 1, '09:00:00', '11:00:00', 25),
(82, 5, 13, 0, NULL, NULL, NULL),
(83, 6, 13, 1, '08:00:00', '10:00:00', 25),
(84, 7, 13, 0, NULL, NULL, NULL),
(85, 1, 14, 0, NULL, NULL, NULL),
(86, 2, 14, 0, NULL, NULL, NULL),
(87, 3, 14, 0, NULL, NULL, NULL),
(88, 4, 14, 0, NULL, NULL, NULL),
(89, 5, 14, 1, '14:30:00', '16:00:00', 20),
(90, 6, 14, 0, NULL, NULL, NULL),
(91, 7, 14, 0, NULL, NULL, NULL),
(92, 1, 15, 0, NULL, NULL, NULL),
(93, 2, 15, 0, NULL, NULL, NULL),
(94, 3, 15, 0, NULL, NULL, NULL),
(95, 4, 15, 0, NULL, NULL, NULL),
(96, 5, 15, 0, NULL, NULL, NULL),
(97, 6, 15, 0, NULL, NULL, NULL),
(98, 7, 15, 0, NULL, NULL, NULL),
(99, 1, 16, 0, NULL, NULL, NULL),
(100, 2, 16, 0, NULL, NULL, NULL),
(101, 3, 16, 0, NULL, NULL, NULL),
(102, 4, 16, 0, NULL, NULL, NULL),
(103, 5, 16, 0, NULL, NULL, NULL),
(104, 6, 16, 0, NULL, NULL, NULL),
(105, 7, 16, 0, NULL, NULL, NULL),
(106, 1, 17, 0, NULL, NULL, NULL),
(107, 2, 17, 0, NULL, NULL, NULL),
(108, 3, 17, 0, NULL, NULL, NULL),
(109, 4, 17, 0, NULL, NULL, NULL),
(110, 5, 17, 0, NULL, NULL, NULL),
(111, 6, 17, 0, NULL, NULL, NULL),
(112, 7, 17, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE `especialidad` (
  `idespecial` int(11) NOT NULL,
  `especialidad` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `especialidad`
--

INSERT INTO `especialidad` (`idespecial`, `especialidad`) VALUES
(1, 'administrador'),
(2, 'ENFERMERIA'),
(3, 'OBSTETRICIA'),
(4, 'MEDICINA GENERAL'),
(6, 'LABORATORIO'),
(7, 'ODONTOLOGIA'),
(8, 'OTORRINOLARINGOLOGÍA'),
(9, 'ADMISION'),
(13, 'PSICOLOGÍA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen`
--

CREATE TABLE `examen` (
  `idexamen` int(11) NOT NULL,
  `idlabo` int(11) NOT NULL,
  `analisis` varchar(255) DEFAULT '''''''NULL''''''',
  `resultado` varchar(255) DEFAULT NULL,
  `referencia` varchar(255) DEFAULT 'NULL'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `examen`
--

INSERT INTO `examen` (`idexamen`, `idlabo`, `analisis`, `resultado`, `referencia`) VALUES
(4, 11, 'examen de orina', 'Infeccion', '10-14'),
(6, 17, 'hemoglobina', 'anemia', '10-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historia`
--

CREATE TABLE `historia` (
  `idhistoria` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idpaciente` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `edad` varchar(255) NOT NULL,
  `talla` decimal(10,2) NOT NULL,
  `peso` decimal(10,3) NOT NULL,
  `pre_mmhg` varchar(100) NOT NULL,
  `frec_res_x` int(11) NOT NULL,
  `temperatura_c` int(11) NOT NULL,
  `frec_cardiaca_x` int(11) NOT NULL,
  `imc` decimal(10,1) NOT NULL,
  `motivo` varchar(255) NOT NULL,
  `examen_fisico` varchar(255) NOT NULL,
  `diagnostico` text NOT NULL,
  `tratamiento` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `historia`
--

INSERT INTO `historia` (`idhistoria`, `idusuario`, `idpaciente`, `fecha`, `edad`, `talla`, `peso`, `pre_mmhg`, `frec_res_x`, `temperatura_c`, `frec_cardiaca_x`, `imc`, `motivo`, `examen_fisico`, `diagnostico`, `tratamiento`) VALUES
(4, 13, 10, '2024-01-19', '36años,  9meses,  2 dias', 15.00, 33.000, '90/99', 18, 24, 59, 0.1, '', '', '', ''),
(5, 13, 13, '2024-01-20', '37años,  8meses,  7 dias', 1.65, 41.000, '90', 18, 36, 18, 15.1, 'asd', 'sdfs', 'Anemia', 'TOmar Sulfato Ferroso'),
(6, 13, 12, '2024-02-09', '43años,  7meses,  17 dias', 1.63, 67.000, '90/99', 19, 35, 19, 25.2, 'Dolor en la cintura y vejiga.', 'Examen de orina', 'Infección Urinaria', 'Pastillas para la infección'),
(7, 13, 14, '2024-02-09', '43años,  9meses,  28 dias', 1.59, 63.000, '90/99', 19, 36, 59, 24.9, 'Dolor de cabeza y mareos', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laboratorio`
--

CREATE TABLE `laboratorio` (
  `idlab` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idpaciente` int(11) NOT NULL,
  `edad` varchar(255) NOT NULL,
  `examen` varchar(255) NOT NULL,
  `responsable` varchar(255) NOT NULL,
  `f_muestra` date DEFAULT NULL,
  `f_entrega` date DEFAULT NULL,
  `idventa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `laboratorio`
--

INSERT INTO `laboratorio` (`idlab`, `fecha`, `idusuario`, `idpaciente`, `edad`, `examen`, `responsable`, `f_muestra`, `f_entrega`, `idventa`) VALUES
(11, '2024-01-18', 13, 10, '36años 9meses 1dias', 'examen de orina', 'mpoma', '2024-01-18', '2024-01-19', 50),
(17, '2024-01-20', 13, 13, '37años 8meses 7dias', 'hemoglobina', 'mpoma', '2024-01-22', '2024-01-23', 56),
(18, '2024-02-09', 13, 12, '43años 7meses 17dias', 'examen de orina', 'jperez', NULL, NULL, 62);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `idpaciente` int(11) NOT NULL,
  `paciente` varchar(100) NOT NULL,
  `sexo` enum('masculino','femenino') NOT NULL,
  `fec_nacimiento` date NOT NULL,
  `documento_pa` varchar(15) NOT NULL,
  `estado_civil` enum('soltero','casado','viudo','divorciado','conviviente') NOT NULL,
  `direccion_pa` varchar(255) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `apoderado` varchar(100) DEFAULT NULL,
  `num_historia` varchar(255) DEFAULT NULL,
  `sis` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`idpaciente`, `paciente`, `sexo`, `fec_nacimiento`, `documento_pa`, `estado_civil`, `direccion_pa`, `telefono`, `email`, `apoderado`, `num_historia`, `sis`) VALUES
(9, 'Roberto', 'masculino', '1957-04-16', '20410011', 'casado', 'Jr. Trujillo 1314', '980144201', 'quispealayatorrearoberto@gmail.com', '', '000009', 1),
(10, 'Lobo Gomez Danitza', 'femenino', '1987-04-18', '71243211', 'soltero', '', '', '', '', '000010', 1),
(11, 'Medrano Maria', 'femenino', '1992-03-23', '23432111', 'soltero', '', '9173454323', '', '', '000011', 1),
(12, 'Torres Pepe', 'masculino', '1980-06-23', '21256443', 'viudo', '', '', 'ptorres@gmail.com', 'Cornelia Torres', '000012', 0),
(13, 'Rodriguez Juan', 'masculino', '1986-05-14', '73214323', 'casado', 'Calle San Antonio MZ. E Lote 34', '', 'jrodriguez@gmail.com', 'Mirella Caso', '000013', 0),
(14, 'Ponce Maria', 'femenino', '1980-04-12', '21342231', 'viudo', 'Pasaje Santa Rosa de Lima N° 23  - Huancayo', '51 960343234', '', '', '000014', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `idservicio` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `um` varchar(100) NOT NULL,
  `stock` decimal(10,2) DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `idusu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`idservicio`, `descripcion`, `um`, `stock`, `precio`, `idusu`) VALUES
(2, 'Espirometría', 'unidad', NULL, 15.00, 11),
(3, 'hemoglobina', 'unidad', NULL, 10.00, 13),
(7, 'examen de orina', 'unidad', NULL, 14.00, 13),
(8, 'Ibuprofeno 500 mg', 'unidad', NULL, 1.20, 1),
(10, 'Medicina General - Consulta Interna', 'unidad', NULL, 12.00, 3),
(11, 'Medicina General 2 - Consulta Interna', 'unidad', NULL, 12.00, 13),
(12, 'Ecografía Abdominal', 'unidad', NULL, 45.00, 13);

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
  `clave` varchar(80) NOT NULL,
  `estado` enum('activo','inactivo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusu`, `idespecialidad`, `nombres`, `sexo`, `fecha_nacimiento`, `documento`, `direccion`, `email`, `telefono`, `tipo`, `usuario`, `clave`, `estado`) VALUES
(1, 1, 'sistemasinfor admin', 'masculino', '2023-01-01', '12345678', '', '', '', 'administrador', 'admin', '$2y$10$UjB/vhLDq42I6u78Xm0ypOZV3ORo7GX/H35vryawTed6VUNf3Lhz.', 'activo'),
(2, 3, 'RIVERA MELENDEZ LORENA ROSMERI', 'femenino', '1993-10-26', '46626574', 'JR. TRUJILLO 1314 EL TAMBO - HUANCAYO', 'LORENAROSMERIRIVERAMELENDEZ30@GMAIL.COM', '978108398', 'usuario', 'lrivera', '$2y$10$ucZErGCM22xTphny5fcFSeROcP3ypJ0FvjjR52qaJCz3ToZVlX.Ne', 'activo'),
(3, 4, 'PUENTE TICONA MARIA ELENA', 'femenino', '1985-06-25', '45849351', '', '', '', 'usuario', 'mpuente', '$2y$10$0EK.omDk3qYj5TY2Vt6wBuh5PuZiDuhinfC9vM.5C5jRPcYvv1hrW', 'inactivo'),
(4, 4, 'SUAREZ VALLE JORGE', 'masculino', '1989-02-13', '72761642', '', '', '', 'usuario', 'jsuarez', '$2y$10$seGCW2frG58pFuKRdFSKIeNOL.liO4tVPv0HhjSCnpoxykMgFxUeq', 'activo'),
(5, 2, 'MIRANDA TORRES YHON PERCY', 'masculino', '1965-10-28', '20059683', '', 'ymiranda@gmail.com', '919265342', 'usuario', 'ymiranda', '$2y$10$DhZDYNAT8/3CNF83B8c2Se9Tz5Alc5QdUqyAkm2jcSA6SnV7VSpWa', 'inactivo'),
(6, 2, 'PAICO RAEZ PAMELA ORIANA', 'femenino', '1990-05-26', '72973796', '', '', '', 'usuario', 'ppaico', '$2y$10$ugywH7vxQZZ/YTTxOW3GJ.qJoScRbUgJrmo5TbGcatgxFF0h4KoXu', 'activo'),
(7, 2, 'QUISPE QUISPE HILDA NERIDA', 'femenino', '1991-03-02', '43478584', '', '', '', 'usuario', 'hquispe', '$2y$10$6Fq6cUAhTiT8CRAMTdoaxOzct7xn3Kd.PNopkbP0ckE8vB8fCX0dq', 'activo'),
(8, 3, 'HINOSTROZA MIRANDA JENNY LAURA', 'femenino', '1993-09-25', '48482098', '', '', '', 'usuario', 'jhinostroza', '$2y$10$W4olxRpu7Isd0LPy5AIUV.Hqd2FAnk4ZCLrF5TQfuUnOhkVFhjS8i', 'inactivo'),
(9, 4, 'charly gabriel pecho', 'masculino', '1988-06-10', '42656051', '', '', '', 'usuario', 'charss000', '$2y$10$vXYJwMyRlJbjVIIt/n61l.RQIcZ2xDsYI1mgjgynOxZGbhtBdHqjG', 'activo'),
(10, 3, 'HINOSTROZA MIRANDA YENNY', 'femenino', '1993-09-15', '48482099', 'Av carrion 765', '', '962762577', 'usuario', 'yhinostroza', '$2y$10$dzfrFGM50L5XJP2/xhcuPOIxxBBD6l85bXddXgQPpEHnMGToxyLo6', 'inactivo'),
(11, 8, 'CHUCHON SOTO ANDREA ALEJANDRA', 'femenino', '1992-12-30', '71223208', 'Costado Torres Marcavalle Mz. A Lote 1', '', '927263053', 'usuario', 'achuchon', '$2y$10$wKLFer0mcA7hWTvEwVeK2uL1yncZNgnnjT4//K42nKTbwIxmtlxX6', 'activo'),
(12, 6, 'PEREZ CASTILLO JEANCARLOS', 'masculino', '1991-01-14', '21234321', '', '', '917345432', 'laboratorio', 'jperez', '$2y$10$daRzfwjdoWvF1irpkTDgvej4j6TeFlqHoqm0qfZjWV87xY5Yc0MTi', 'activo'),
(13, 4, 'IDONE CASO TATYANA ADELY', 'femenino', '1990-06-15', '46745735', 'JR. LOS INCAS  -  JAUJA', 'idonecasotta@gmail.com', '954875554', 'usuario', 'tidone', '$2y$10$hPaayURPQGuyYY8d6PZ6LujHQqtgdwhiVgf9u99g0yFnsAyIbYffi', 'activo'),
(14, 13, 'Santander Arellano Micaela', 'femenino', '1994-07-13', '72432190', 'Av. Loreto N° 123 - Prologanción Ugarte', 'msantander@gmail.com', '967453221', 'usuario', 'msantander', '$2y$10$oCSw3DCknmFZ7lmo3iVscOHK3I2Gx2JQ34jxR3mhYvwR5O.DZxcze', 'activo'),
(15, 6, 'POMA SUAREZ MILENA', 'masculino', '1987-04-28', '21263421', 'A.H. Santa Anita Lote 1 Mz. A', '', '953224875', 'laboratorio', 'mpoma', '$2y$10$GM/7ZqqIXnJ.B6817.STguGVrT0YcRAUQg.ku5bNtUFEX/jDLia/6', 'activo'),
(16, 1, 'Soto Gutierrez Hugo', 'masculino', '1987-01-01', '21283221', 'AA.HH. Violeta Correa N° 123 - La Oroya', 'hgutierrez@outlook.com', '51 943227611', 'administrador', 'hgutierrez', '$2y$10$Prlv3G/crr/8zsxugVdn5uKtPAaeL8DC/h7oWac0MsvzAo7V6m0Iu', 'activo'),
(17, 8, 'ESPEJO ARELLANO JAVIER', 'masculino', '1985-01-29', '21323211', 'Pasaje Marcavalle Mz. C Lote 10', 'jespejo@gmail.com', '918345487', 'usuario', 'jespejo', '$2y$10$xusRRrlOMvhUnynq6ZYh5.Moi5UEC3QmSjK2QVOugygfjmrG33BoK', 'activo');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`idventa`, `idpaciente_v`, `fecha`, `subtotal`, `igv`, `total`, `tipo_docu`, `num_docu`, `serie`, `observacion`, `usuario`, `estado`) VALUES
(50, 10, '2024-01-18', 14.00, 0.00, 14.00, 'RECIBO', '00000050', '001', '', 'tidone', 'pagado'),
(51, 9, '2024-01-23', 12.00, 0.00, 12.00, 'RECIBO', '00000051', '001', '', 'admin', 'pagado'),
(52, 9, '2024-01-19', 12.00, 0.00, 12.00, 'RECIBO', '00000052', '001', '', 'admin', 'pagado'),
(53, 12, '2024-01-20', 12.00, 2.16, 14.16, 'RECIBO', '00000053', '001', '', 'admin', 'pagado'),
(55, 13, '2024-01-20', 12.00, 0.00, 12.00, 'RECIBO', '00000055', '001', '', 'admin', 'pagado'),
(56, 13, '2024-01-20', 10.00, 0.00, 10.00, 'RECIBO', '00000056', '001', '', 'tidone', 'pagado'),
(57, 13, '2024-01-20', 10.00, 1.80, 11.80, 'RECIBO', '00000057', '001', '', 'admin', 'pagado'),
(58, 13, '2024-01-25', 0.00, 0.00, 12.00, 'RECIBO', '00000058', '001', '', 'tidone', 'pagado'),
(59, 12, '2024-01-29', 12.00, 0.00, 12.00, 'RECIBO', '00000059', '001', '', 'admin', 'pagado'),
(60, 12, '2024-02-07', 15.20, 2.74, 17.94, 'RECIBO', '00000060', '001', '', 'admin', 'pagado'),
(61, 14, '2024-02-10', 12.00, 0.00, 12.00, 'RECIBO', '00000061', '001', '', 'admin', 'pagado'),
(62, 12, '2024-02-09', 14.00, 0.00, 14.00, 'RECIBO', '00000062', '001', '', 'tidone', 'pendiente'),
(63, 12, '2024-02-12', 0.00, 0.00, 12.00, 'RECIBO', '00000063', '001', '', 'tidone', 'pagado'),
(64, 10, '2024-02-19', 12.00, 0.00, 12.00, 'RECIBO', '00000064', '001', '', 'admin', 'pendiente');

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
  ADD PRIMARY KEY (`id`),
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
  ADD PRIMARY KEY (`id`),
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
  MODIFY `idadjunto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `idcita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `idconfi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de la tabla `dias`
--
ALTER TABLE `dias`
  MODIFY `iddia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `dia_usuario`
--
ALTER TABLE `dia_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  MODIFY `idespecial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `examen`
--
ALTER TABLE `examen`
  MODIFY `idexamen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `historia`
--
ALTER TABLE `historia`
  MODIFY `idhistoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  MODIFY `idlab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `idpaciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `idservicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `idventa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

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
