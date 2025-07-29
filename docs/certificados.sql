-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-07-2025 a las 03:49:21
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `certificados`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `td_curso_usuario`
--

CREATE TABLE `td_curso_usuario` (
  `curd_id` int(11) NOT NULL,
  `cur_id` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL,
  `fech_crea` datetime NOT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `td_curso_usuario`
--

INSERT INTO `td_curso_usuario` (`curd_id`, `cur_id`, `usu_id`, `fech_crea`, `est`) VALUES
(34, 12, 139, '2025-07-28 18:33:09', 1),
(35, 13, 138, '2025-07-28 18:43:35', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_categoria`
--

CREATE TABLE `tm_categoria` (
  `cat_id` int(11) NOT NULL,
  `cat_nom` varchar(150) NOT NULL,
  `fech_crea` datetime DEFAULT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tm_categoria`
--

INSERT INTO `tm_categoria` (`cat_id`, `cat_nom`, `fech_crea`, `est`) VALUES
(1, 'CURSO', '2024-07-21 11:44:44', 1),
(2, 'ESCAVADORA', '2024-09-18 18:08:21', 1),
(3, 'RETROEXCAVADORA', '2024-09-23 20:52:29', 1),
(4, 'EXCEL NIVEL III', '2024-11-19 18:08:28', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_certificados_especiales`
--

CREATE TABLE `tm_certificados_especiales` (
  `cert_esp_id` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL,
  `cert_esp_titulo` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cert_esp_descrip` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cert_esp_fechini` date DEFAULT NULL,
  `cert_esp_fechfin` date DEFAULT NULL,
  `cert_esp_img` varchar(250) DEFAULT NULL,
  `cert_esp_qr` varchar(250) DEFAULT NULL,
  `fech_crea` datetime DEFAULT current_timestamp(),
  `est` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tm_certificados_especiales`
--

INSERT INTO `tm_certificados_especiales` (`cert_esp_id`, `usu_id`, `cert_esp_titulo`, `cert_esp_descrip`, `cert_esp_fechini`, `cert_esp_fechfin`, `cert_esp_img`, `cert_esp_qr`, `fech_crea`, `est`) VALUES
(1, 139, 'diplamado', 'diplamdo en soldadura', '2025-06-01', '2025-06-18', '../../public/cert_esp_img/499912335.png', '../../public/cert_esp_qr/1.png', '2025-06-19 14:41:46', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_curso`
--

CREATE TABLE `tm_curso` (
  `cur_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `cur_nom` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cur_descrip` varchar(1000) NOT NULL,
  `cur_fechini` date DEFAULT NULL,
  `cur_fechfin` date DEFAULT NULL,
  `cur_fecha_vencimiento` date DEFAULT NULL,
  `inst_id` int(11) NOT NULL,
  `cur_img` varchar(250) DEFAULT NULL,
  `fech_crea` datetime DEFAULT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tm_curso`
--

INSERT INTO `tm_curso` (`cur_id`, `cat_id`, `cur_nom`, `cur_descrip`, `cur_fechini`, `cur_fechfin`, `cur_fecha_vencimiento`, `inst_id`, `cur_img`, `fech_crea`, `est`) VALUES
(12, 2, 'CURSO PRUEBA', '60', '2024-01-15', '2025-01-15', NULL, 1, '../../public/137813702.png', '2025-05-16 20:24:47', 1),
(13, 4, 'CAPACITACIÓN', '10', '2025-07-20', '2025-07-28', '2026-07-28', 1, '../../public/264659934.png', '2025-07-28 17:21:16', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_director`
--

CREATE TABLE `tm_director` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `apellido_paterno` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `apellido_materno` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `cargo` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `firma` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `visualizar` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_instructor`
--

CREATE TABLE `tm_instructor` (
  `inst_id` int(11) NOT NULL,
  `inst_nom` varchar(150) NOT NULL,
  `inst_apep` varchar(150) NOT NULL,
  `inst_apem` varchar(150) NOT NULL,
  `inst_correo` varchar(150) NOT NULL,
  `inst_sex` varchar(1) NOT NULL,
  `inst_telf` varchar(12) NOT NULL,
  `inst_firma` varchar(200) NOT NULL,
  `fech_crea` datetime DEFAULT NULL,
  `est` int(11) NOT NULL,
  `visualizar` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tm_instructor`
--

INSERT INTO `tm_instructor` (`inst_id`, `inst_nom`, `inst_apep`, `inst_apem`, `inst_correo`, `inst_sex`, `inst_telf`, `inst_firma`, `fech_crea`, `est`, `visualizar`) VALUES
(1, 'Pedro', 'Castillo', 'Terrones', 'pedro@gmail.com', 'M', '12345678', '../../public/firma_img/1636238540.png', '2024-07-21 11:45:30', 1, 0),
(2, 'Alan ', 'Garcia', 'Garcia', 'alan@jaidec.com', 'M', '982223598', '../../public/firma_img/1011689821.png', '2024-09-23 20:49:05', 1, 0),
(3, 'Alan ', 'Castillo', 'Terrones', 'alan@jaidec.com', 'M', '12345678', '../../public/firma_img/2118199474.png', '2024-10-15 21:17:21', 1, 0),
(4, 'Alan ', 'Castillo', 'Terrones', 'alan@jaidec.com', 'M', '12345678', '', '2024-11-18 22:59:15', 0, 0),
(5, 'Anastasio', 'Castillo', 'Terrones', 'alan@jaidec.com', 'M', '12345678', '', '2024-11-18 22:59:41', 0, 0),
(6, 'Jose', 'Marcos', 'Torrees', 'alan@jaidec.com', 'M', '982223598', 'Formato de imagen no permitido. Se permite solo PNG.', '2024-11-18 23:00:14', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_usuario`
--

CREATE TABLE `tm_usuario` (
  `usu_id` int(11) NOT NULL,
  `usu_nom` varchar(150) NOT NULL,
  `usu_apep` varchar(150) NOT NULL,
  `usu_apem` varchar(150) NOT NULL,
  `usu_correo` varchar(150) NOT NULL,
  `usu_pass` varchar(10) NOT NULL,
  `usu_sex` varchar(1) NOT NULL,
  `usu_telf` varchar(12) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `usu_dni` varchar(20) DEFAULT NULL,
  `usu_foto` varchar(255) DEFAULT NULL,
  `fech_crea` datetime DEFAULT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tm_usuario`
--

INSERT INTO `tm_usuario` (`usu_id`, `usu_nom`, `usu_apep`, `usu_apem`, `usu_correo`, `usu_pass`, `usu_sex`, `usu_telf`, `rol_id`, `usu_dni`, `usu_foto`, `fech_crea`, `est`) VALUES
(1, 'DEV', 'CAYAO', 'DEVELOPER', 'admin@admin.com', '1234567', 'M', '123456789', 2, '4445464', '../../public/usuario_fotos/578962040.jpg', '2021-04-26 20:14:08', 1),
(138, 'Karol', 'Karol', 'Developer', 'karol@gmail.com', '1234567', 'M', '12345685', 1, '47469980', '', '2024-12-16 18:30:19', 1),
(139, 'Nilson', 'Cayao', 'Fernandez', 'karol@gmail.com', '1234567', 'M', '12345678', 1, '47469940', '', '2025-06-18 11:42:57', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `td_curso_usuario`
--
ALTER TABLE `td_curso_usuario`
  ADD PRIMARY KEY (`curd_id`);

--
-- Indices de la tabla `tm_categoria`
--
ALTER TABLE `tm_categoria`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indices de la tabla `tm_certificados_especiales`
--
ALTER TABLE `tm_certificados_especiales`
  ADD PRIMARY KEY (`cert_esp_id`),
  ADD KEY `usu_id` (`usu_id`);

--
-- Indices de la tabla `tm_curso`
--
ALTER TABLE `tm_curso`
  ADD PRIMARY KEY (`cur_id`);

--
-- Indices de la tabla `tm_director`
--
ALTER TABLE `tm_director`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tm_instructor`
--
ALTER TABLE `tm_instructor`
  ADD PRIMARY KEY (`inst_id`);

--
-- Indices de la tabla `tm_usuario`
--
ALTER TABLE `tm_usuario`
  ADD PRIMARY KEY (`usu_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `td_curso_usuario`
--
ALTER TABLE `td_curso_usuario`
  MODIFY `curd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `tm_categoria`
--
ALTER TABLE `tm_categoria`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tm_certificados_especiales`
--
ALTER TABLE `tm_certificados_especiales`
  MODIFY `cert_esp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tm_curso`
--
ALTER TABLE `tm_curso`
  MODIFY `cur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tm_director`
--
ALTER TABLE `tm_director`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tm_instructor`
--
ALTER TABLE `tm_instructor`
  MODIFY `inst_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tm_usuario`
--
ALTER TABLE `tm_usuario`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tm_certificados_especiales`
--
ALTER TABLE `tm_certificados_especiales`
  ADD CONSTRAINT `fk_cesp_usuario` FOREIGN KEY (`usu_id`) REFERENCES `tm_usuario` (`usu_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
