-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 03-11-2020 a las 00:01:02
-- Versión del servidor: 10.4.14-MariaDB-cll-lve
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u893846753_autodb`
--
CREATE DATABASE IF NOT EXISTS `u893846753_autodb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `u893846753_autodb`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idcategoria` int(11) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL,
  `idtipovehiculo` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `nombre`, `estado`, `idtipovehiculo`) VALUES
(23, 'B2', '1', 5),
(22, 'B1', '1', 2),
(21, 'A1', '1', 3),
(24, 'C2', '1', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `nombre` varchar(50) DEFAULT NULL,
  `idcategoria` int(11) DEFAULT NULL,
  `idcurso` int(11) NOT NULL,
  `fechainicio` date DEFAULT NULL,
  `fechafin` date DEFAULT NULL,
  `horainicio` time DEFAULT NULL,
  `horafin` time DEFAULT NULL,
  `idsalon` int(11) DEFAULT NULL,
  `idprofesor` varchar(10) DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`nombre`, `idcategoria`, `idcurso`, `fechainicio`, `fechafin`, `horainicio`, `horafin`, `idsalon`, `idprofesor`, `estado`, `fecha`) VALUES
('Manejo de vehiculo pesado-1', 23, 12, '2020-08-01', '2020-08-31', '06:00:00', '09:00:00', 5, '22222', '1', '2020-09-10'),
('Manejo de motos-1', 21, 13, '2020-08-06', '2020-08-20', '05:00:00', '13:00:00', 7, '22222', '1', '2020-09-10'),
('Manejo de vehiculo pesado-2', 23, 14, '2020-07-27', '2020-09-27', '10:00:00', '17:00:00', 7, '22222', '1', '2020-09-10'),
('Manejo motos-2', 21, 15, '2020-08-01', '2020-10-01', '09:00:00', '15:00:00', 5, '22222', '1', '2020-09-10'),
('Manejo de vehiculo pesado-3', 23, 16, '2020-08-06', '2020-09-24', '11:00:00', '20:00:00', 3, '22222', '1', '2020-09-10'),
('Manejo camioneta', 22, 17, '2020-09-01', '2020-09-30', '10:00:00', '15:00:00', 3, '22222', '1', '2020-09-01'),
('Manejo carro', 22, 18, '2020-09-01', '2020-09-30', '06:00:00', '11:00:00', 7, '22222', '1', '2020-09-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursousuario`
--

CREATE TABLE `cursousuario` (
  `numerodocumento` int(11) NOT NULL,
  `idcurso` int(11) NOT NULL,
  `nota` double DEFAULT NULL,
  `fechamatricula` date DEFAULT NULL,
  `fechacalifica` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cursousuario`
--

INSERT INTO `cursousuario` (`numerodocumento`, `idcurso`, `nota`, `fechamatricula`, `fechacalifica`) VALUES
(44444, 12, 3.4, NULL, NULL),
(44444, 13, 4.6, NULL, NULL),
(44444, 17, 4.5, '2020-09-01', '2020-09-01'),
(1, 15, NULL, NULL, NULL),
(66666, 14, NULL, '2020-09-01', NULL),
(88888, 15, NULL, '2020-09-01', NULL),
(66666, 12, NULL, '2020-09-01', NULL),
(88888, 12, NULL, '2020-09-01', NULL),
(88888, 13, NULL, '2020-09-01', NULL),
(1117549276, 13, NULL, '2020-09-13', NULL),
(54210, 14, 4.2, '2020-09-15', '2020-09-15'),
(54210, 17, 4, '2020-09-15', '2020-09-15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleevaluacion`
--

CREATE TABLE `detalleevaluacion` (
  `numerodocumento` varchar(20) NOT NULL,
  `idevaluacion` varchar(20) NOT NULL,
  `nota` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE `documento` (
  `iddocumento` int(11) NOT NULL,
  `nombre` varchar(40) DEFAULT NULL,
  `url` varchar(40) DEFAULT NULL,
  `numerodocumento` varchar(20) DEFAULT NULL,
  `idtipoarchivo` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `documento`
--

INSERT INTO `documento` (`iddocumento`, `nombre`, `url`, `numerodocumento`, `idtipoarchivo`) VALUES
(7, 'Fotocopia cc', 'tiposbanco.jpeg', '44444', 15),
(8, 'mm', 'bd.png', '1117549276', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `nit` varchar(20) NOT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `direccion` varchar(20) DEFAULT NULL,
  `mision` varchar(500) DEFAULT NULL,
  `vision` varchar(500) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`nit`, `nombre`, `direccion`, `mision`, `vision`, `telefono`) VALUES
('123456', 'Automovilistica Condu-Florencia', 'calle 12 N 3 45', 'Orientar a la persona en su proceso de aprendizaje en la conduccion de vehiculos', 'Convertirnos en el principal centro de enseñanza de conduccion del Caqueta', '4347869');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion`
--

CREATE TABLE `evaluacion` (
  `idevaluacion` int(11) NOT NULL,
  `pregunta1` varchar(300) DEFAULT NULL,
  `pregunta2` varchar(300) DEFAULT NULL,
  `pregunta3` varchar(300) DEFAULT NULL,
  `pregunta4` varchar(300) DEFAULT NULL,
  `pregunta5` varchar(300) DEFAULT NULL,
  `pregunta6` varchar(300) DEFAULT NULL,
  `pregunta7` varchar(300) DEFAULT NULL,
  `pregunta8` varchar(300) DEFAULT NULL,
  `pregunta9` varchar(300) DEFAULT NULL,
  `pregunta10` varchar(300) DEFAULT NULL,
  `categoria` int(11) DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL,
  `nombre` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE `genero` (
  `idgenero` int(11) NOT NULL,
  `nombre` varchar(40) DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`idgenero`, `nombre`, `estado`) VALUES
(1, 'MASCULINO', '1'),
(2, 'FEMENINO', '1'),
(3, 'INDEFINIDO', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `idpermiso` varchar(10) NOT NULL,
  `nombre` varchar(70) DEFAULT NULL,
  `url` varchar(300) DEFAULT NULL,
  `fk_idpermiso` varchar(20) DEFAULT NULL,
  `estado` varchar(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`idpermiso`, `nombre`, `url`, `fk_idpermiso`, `estado`) VALUES
('1', 'Información personal', NULL, NULL, '1'),
('5', 'Información académica', NULL, NULL, '1'),
('6', 'Gestionar documentación', NULL, NULL, '1'),
('10', 'Visualizar información de cursos', 'cursoinstructor.php', NULL, '1'),
('13', 'Administrar cursos', 'agcurso.php', NULL, '1'),
('14', 'Administrar tablas básicas', NULL, NULL, '1'),
('15', 'Cargar documentos financieros', 'archivosfinancieros.php', NULL, '1'),
('16', 'Administrar roles', NULL, NULL, '1'),
('17', 'Administrar usuarios', NULL, NULL, '1'),
('18', 'Ver información de aprendices', NULL, NULL, '1'),
('45', 'Cerrar sesión', 'logout.php', NULL, '1'),
('2', 'Gestionar contenido académico', NULL, NULL, '1'),
('3', 'Gestionar inscripciones', NULL, NULL, '1'),
('4', 'Actualizar información personal', 'actualizarpersonal.php', '1', '1'),
('8', 'Ver horarios', 'horarioaprendiz.php', '5', '1'),
('7', 'Cargar documentos personales', 'cargarapers.php', NULL, '1'),
('19', 'Ver promedio de cursos', 'promediocurso.php', '18', '1'),
('20', 'Crear evaluaciones', 'evaluacion.php', '2', '1'),
('22', 'Inscribir aprendiz a curso', 'matriuso.php', '3', '1'),
('38', 'Administrar permisos de rol', 'adminrol.php', '16', '1'),
('30', 'Administrar salón', 'agsalon.php', '14', '1'),
('26', 'Visualizar totalidad de documentos', 'visualizardocumentos.php', '6', '1'),
('27', 'Administrar tipo de documento identificación', 'agregartd.php', '14', '1'),
('40', 'Administrar tipo de archivo', 'tipoarchivo.php', '14', '1'),
('29', 'Administrar categoría licencia', 'agregarlc.php', '14', '1'),
('39', 'Establecer roles', 'estabrol.php', '16', '1'),
('32', 'Buscar aprendiz', 'visualizarusuario.php', '18', '1'),
('33', 'Cambiar rol de usuario', 'modifirol.php', '17', '1'),
('34', 'Calificar aprendices', 'calificaa.php', '2', '1'),
('41', 'Ver nota', 'visualizarnotaaprendiz.php', '5', '1'),
('36', 'Administrar tipo de sangre', 'tiposangre.php', '14', '1'),
('37', 'Administrar rh', 'rh.php', '14', '1'),
('11', 'Administrar tipos de vehiculos', 'tipovehiculo.php', '14', '1'),
('12', 'Administrar genero', 'admingenero.php', '14', '1'),
('9', 'Administrar datos de la empresa', 'datosempresa.php', '14', '1'),
('23', 'Reportes', NULL, NULL, '1'),
('24', 'No. aprendices que han aprobado y reprobado por fechas', 'reportecantidadaprendicesmatriculadosyaprobadosporfecha.php', '23', '1'),
('25', 'Cantidad de cursos por categoria', 'reportecantidadcursosporcategoria.php', '23', '1'),
('31', 'Cantidad de cursos por salon', 'cantidaddecursosporsalon.php', '23', '1'),
('42', 'Cantidad de usuarios registrados por fecha', 'usuariosregistradosporfecha.php', '23', '1'),
('43', 'Cantidad de aprendices matriculados por fecha', 'aprendicesmatriculadosporfecha.php', '23', '1'),
('44', 'Convertir moneda', 'convertidordemoneda.php', NULL, '1'),
('46', 'Aprendices por genero', 'aprendicesinscritosporgenero.php', '23', '1'),
('47', 'Aprendices por categoria', 'reporteaprendicesporcategoria.php', '23', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisorol`
--

CREATE TABLE `permisorol` (
  `idrol` int(11) NOT NULL,
  `idpermiso` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `permisorol`
--

INSERT INTO `permisorol` (`idrol`, `idpermiso`) VALUES
(1, '1'),
(1, '44'),
(1, '45'),
(1, '5'),
(1, '7'),
(2, '1'),
(2, '10'),
(2, '18'),
(2, '2'),
(2, '44'),
(2, '45'),
(3, '1'),
(3, '15'),
(3, '18'),
(3, '3'),
(3, '44'),
(3, '45'),
(4, '1'),
(4, '13'),
(4, '14'),
(4, '16'),
(4, '17'),
(4, '18'),
(4, '23'),
(4, '44'),
(4, '45'),
(4, '6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rh`
--

CREATE TABLE `rh` (
  `idrh` int(11) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rh`
--

INSERT INTO `rh` (`idrh`, `nombre`, `estado`) VALUES
(8, 'NEGATIVO', '1'),
(7, 'POSITIVO', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `nombre`) VALUES
(1, 'APRENDIZ'),
(2, 'INSTRUCTOR'),
(3, 'RECEPCIONISTA'),
(4, 'ADMINISTRADOR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salon`
--

CREATE TABLE `salon` (
  `idsalon` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `salon`
--

INSERT INTO `salon` (`idsalon`, `nombre`, `estado`) VALUES
(3, 'Sala 472', '1'),
(5, 'Sala 452', '1'),
(7, 'Sala 567', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoarchivo`
--

CREATE TABLE `tipoarchivo` (
  `idtipoarchivo` int(11) NOT NULL,
  `nombre` varchar(40) DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL,
  `rol` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipoarchivo`
--

INSERT INTO `tipoarchivo` (`idtipoarchivo`, `nombre`, `estado`, `rol`) VALUES
(15, 'Foto ', NULL, '1'),
(14, 'Fotocopia cedula ciudadania', NULL, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodocumento`
--

CREATE TABLE `tipodocumento` (
  `idtipodocumento` int(11) NOT NULL,
  `nombre` varchar(40) DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipodocumento`
--

INSERT INTO `tipodocumento` (`idtipodocumento`, `nombre`, `estado`) VALUES
(5, 'Tarjeta de identidad', '1'),
(4, 'Cedula de ciudadania', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposangre`
--

CREATE TABLE `tiposangre` (
  `idtiposangre` int(11) NOT NULL,
  `nombre` varchar(10) DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tiposangre`
--

INSERT INTO `tiposangre` (`idtiposangre`, `nombre`, `estado`) VALUES
(14, 'B', '1'),
(15, 'AB', '1'),
(11, 'O', '1'),
(12, 'A', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipovehiculo`
--

CREATE TABLE `tipovehiculo` (
  `idtipovehiculo` int(11) NOT NULL,
  `nombre` varchar(40) DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipovehiculo`
--

INSERT INTO `tipovehiculo` (`idtipovehiculo`, `nombre`, `estado`) VALUES
(2, 'Automovil', '1'),
(3, 'Moto', '1'),
(6, 'Bus', '1'),
(5, 'Mixto', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `numerodocumento` varchar(20) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `apellido` varchar(20) DEFAULT NULL,
  `direccion` varchar(20) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `celular` varchar(10) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `contraseña` varchar(100) DEFAULT NULL,
  `idrol` int(11) DEFAULT NULL,
  `idtipodocumento` int(11) DEFAULT NULL,
  `idtiposangre` int(11) DEFAULT NULL,
  `idrh` int(11) DEFAULT NULL,
  `nombre2` varchar(20) DEFAULT NULL,
  `apellido2` varchar(20) DEFAULT NULL,
  `idgenero` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`numerodocumento`, `nombre`, `apellido`, `direccion`, `telefono`, `celular`, `email`, `contraseña`, `idrol`, `idtipodocumento`, `idtiposangre`, `idrh`, `nombre2`, `apellido2`, `idgenero`, `fecha`) VALUES
('1007451360', 'Jorge Andrés ', 'Pedroza Zapata', '', '3216175567', '', 'jorgeandrespedrozazapata@gmail.com', '$2y$10$dO0RK1qr2U/IiCLFm.L7EersNm4/pEK21g4OqCf/vSKkrY3jTW8n.', 1, 4, 12, 8, '', '', 3, '2020-09-11'),
('11111', 'Juan', 'Martinez', 'Cra 6 No. 4-76', '3001458796', '4345820', 'juan@gmail.com', '$2y$10$K.sCsLhR4rhGTbweCh/j0eurlvklpVbJ78y.CTc4yVSPdjTQDtIj2', 4, 4, 15, 8, 'David', 'Murcia', 1, NULL),
('111754926', 'Andres', 'Samboni ', NULL, '31028373', NULL, 'andrespaez123@hotmail.com', '$2y$10$obNhPN9lIRYVdAPXlo50r.qvx8aOfMFOo0TaRCltvvCpc0wmfPIpW', 3, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-11'),
('1117549276', 'andres', 'samboni', NULL, '3123123', NULL, 'andres@hotmail.com', '$2y$10$/OSkGi1BFZmKcd6.H5TyV.t/c.m/2fjiISU3yId/xkV8uSwej3m.2', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-11'),
('22222', 'Camila', 'Guevara', NULL, '3126547099', NULL, 'camila@gmail.com', '$2y$10$oZhkOCS9CJh1lqrxK1Jbu.2.yuDCWLCMwjlpz19U3q9lAG0.wvmjO', 2, NULL, NULL, NULL, NULL, NULL, 2, NULL),
('33333', 'Andrea', 'Pedroza', NULL, '3112457008', NULL, 'andrea@gmail.com', '$2y$10$ZPZ0YTJEAbShq2Y9DdXHBu9zp64oIVsUglCfju2wm4XwufqFuQdje', 3, NULL, NULL, NULL, NULL, NULL, 2, NULL),
('44444', 'Marcos', 'Suarez', '', '3155426698', '', 'marcos@gmail.com', '$2y$10$Be.vV0RvENDEipQnN1rSU.7hPsjmLVOjwvAfij1TltgSH.PC8XVdm', 1, 0, 0, 0, '', '', 1, NULL),
('54210', 'Frank', 'Mendoza', 'Cra 6 No. 8-99', '3205124788', '5487541', 'frank00@gmail.com', '$2y$10$7ZJtZZzSV4L2lOt4Yt/GeO0aUFdA8y3keDrY/.QGV1P.kUBi1LBUy', 1, 4, 15, 7, 'Manuel', 'Torres', 1, '2020-09-15'),
('66666', 'Mario', 'Ruiz', NULL, '3201785541', NULL, 'mario@gmail.com', '$2y$10$aXjePyv2e/YGUoePWZ4P8ej3BpnwxY2ewzVDtFiNIkUEmbK5c9fOq', 1, NULL, NULL, NULL, NULL, NULL, 2, '2020-09-01'),
('85421', 'Diego', 'Montes', NULL, '321024', NULL, 'die.montes1025@gmail.com', '$2y$10$YmDfEp95KwdCU8l1P0898uBSTfe3qwLdaawxQow2AV8mBUnGUixO2', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-11'),
('88888', 'Raul ', 'Perez', '', '3208881567', '', 'raul@gmail.com', '$2y$10$XlaAXzIID2LyS9lVIohRHuxOr6inoVBqE5uQN5USyi.BCOi4nvM/q', 1, 4, 11, 8, '', '', 3, '2020-09-01');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`),
  ADD KEY `fk_idtipovehiculo` (`idtipovehiculo`) USING BTREE;

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`idcurso`),
  ADD KEY `fk_idcategoria` (`idcategoria`) USING BTREE,
  ADD KEY `fk_idsalon` (`idsalon`) USING BTREE;

--
-- Indices de la tabla `cursousuario`
--
ALTER TABLE `cursousuario`
  ADD PRIMARY KEY (`numerodocumento`,`idcurso`),
  ADD KEY `fk_numerodocumento` (`numerodocumento`) USING BTREE,
  ADD KEY `fk_idcurso` (`idcurso`) USING BTREE;

--
-- Indices de la tabla `detalleevaluacion`
--
ALTER TABLE `detalleevaluacion`
  ADD PRIMARY KEY (`numerodocumento`,`idevaluacion`);

--
-- Indices de la tabla `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`iddocumento`),
  ADD KEY `fk_numerodocumento` (`numerodocumento`) USING BTREE,
  ADD KEY `fk_idtipoarchivo` (`idtipoarchivo`) USING BTREE;

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`nit`);

--
-- Indices de la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
  ADD PRIMARY KEY (`idevaluacion`);

--
-- Indices de la tabla `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`idgenero`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`idpermiso`),
  ADD KEY `fk_permiso` (`fk_idpermiso`);

--
-- Indices de la tabla `permisorol`
--
ALTER TABLE `permisorol`
  ADD PRIMARY KEY (`idrol`,`idpermiso`),
  ADD KEY `fk_idrol` (`idrol`) USING BTREE,
  ADD KEY `fk_idpermiso` (`idpermiso`) USING BTREE;

--
-- Indices de la tabla `rh`
--
ALTER TABLE `rh`
  ADD PRIMARY KEY (`idrh`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `salon`
--
ALTER TABLE `salon`
  ADD PRIMARY KEY (`idsalon`);

--
-- Indices de la tabla `tipoarchivo`
--
ALTER TABLE `tipoarchivo`
  ADD PRIMARY KEY (`idtipoarchivo`);

--
-- Indices de la tabla `tipodocumento`
--
ALTER TABLE `tipodocumento`
  ADD PRIMARY KEY (`idtipodocumento`);

--
-- Indices de la tabla `tiposangre`
--
ALTER TABLE `tiposangre`
  ADD PRIMARY KEY (`idtiposangre`);

--
-- Indices de la tabla `tipovehiculo`
--
ALTER TABLE `tipovehiculo`
  ADD PRIMARY KEY (`idtipovehiculo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`numerodocumento`),
  ADD KEY `fk_idtipodocumento` (`idtipodocumento`) USING BTREE,
  ADD KEY `fk_idtiposangre` (`idtiposangre`) USING BTREE,
  ADD KEY `fk_idrh` (`idrh`) USING BTREE,
  ADD KEY `fk_idrol` (`idrol`) USING BTREE,
  ADD KEY `fk_idgenero` (`idgenero`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `idcurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `documento`
--
ALTER TABLE `documento`
  MODIFY `iddocumento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
  MODIFY `idevaluacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `genero`
--
ALTER TABLE `genero`
  MODIFY `idgenero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `rh`
--
ALTER TABLE `rh`
  MODIFY `idrh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `salon`
--
ALTER TABLE `salon`
  MODIFY `idsalon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tipoarchivo`
--
ALTER TABLE `tipoarchivo`
  MODIFY `idtipoarchivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tipodocumento`
--
ALTER TABLE `tipodocumento`
  MODIFY `idtipodocumento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tiposangre`
--
ALTER TABLE `tiposangre`
  MODIFY `idtiposangre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `tipovehiculo`
--
ALTER TABLE `tipovehiculo`
  MODIFY `idtipovehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
