-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 04-08-2025 a las 23:01:42
-- Versión del servidor: 8.0.42
-- Versión de PHP: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mi_base`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activaciones`
--

CREATE TABLE `activaciones` (
  `id` int NOT NULL,
  `id_socio` int NOT NULL,
  `token` varchar(255) NOT NULL,
  `creado_en` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int NOT NULL,
  `id_socio` int NOT NULL,
  `id_tipo_categoria` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disciplinas`
--

CREATE TABLE `disciplinas` (
  `id_disciplina` int NOT NULL,
  `id_socio` int NOT NULL,
  `id_tipo_disciplina` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `id_login` int NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contra` varchar(300) NOT NULL,
  `id_rol` int NOT NULL,
  `id_socio` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`id_login`, `usuario`, `contra`, `id_rol`, `id_socio`) VALUES
(6, 'admin', '$2y$10$JS0KPkHpn/WUQ4p5WfcLteMLlWTXC4M9XKqpxYms8qhRzr1Ryh5Da', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id_pago` int NOT NULL,
  `id_socio` int NOT NULL,
  `fecha_pago` datetime NOT NULL,
  `mes` varchar(20) DEFAULT NULL,
  `monto` decimal(10,2) NOT NULL DEFAULT '0.00',
  `medio_pago` varchar(50) NOT NULL DEFAULT 'efectivo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int NOT NULL,
  `rol_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `rol_name`) VALUES
(1, 'admin'),
(2, 'socio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socios`
--

CREATE TABLE `socios` (
  `id_socio` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `dni` varchar(20) DEFAULT NULL,
  `genero` varchar(50) NOT NULL,
  `correo_electronico` varchar(50) NOT NULL,
  `fecha_nacimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `socios`
--

INSERT INTO `socios` (`id_socio`, `nombre`, `apellido`, `dni`, `genero`, `correo_electronico`, `fecha_nacimiento`) VALUES
(3, 'Lucas', 'Martinez', NULL, 'masculino', 'lucaam@gmail.com', '2005-05-18'),
(4, 'Gonzalo', 'Sierra', NULL, 'masculino', 'gonzaasierra@gmail.com', '2002-09-02'),
(7, 'Joel', 'Vallejos', NULL, 'masculino', 'joelvallejo@gmail.com', '2000-08-15'),
(10, 'Matias', 'Sanchez', NULL, 'masculino', 'matiiisan@gmail.com', '2005-09-15'),
(11, 'Ariel', 'Castellano', NULL, 'masculino', 'arielcastellanox@gmail.com', '1988-08-15'),
(12, 'Pablo', 'Caizza', NULL, 'masculino', 'pablocai@gmail.com', '1987-08-19'),
(13, 'Emiliano', 'Perez', NULL, 'masculino', 'emilianoperezz@gmail.com', '2004-08-17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_categoria`
--

CREATE TABLE `tipo_categoria` (
  `id_tipo_categoria` int NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tipo_categoria`
--

INSERT INTO `tipo_categoria` (`id_tipo_categoria`, `nombre`) VALUES
(1, 'Adherente'),
(2, 'Infantil'),
(3, 'Vitalicio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_disciplina`
--

CREATE TABLE `tipo_disciplina` (
  `id_tipo_disciplina` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `dias` varchar(255) DEFAULT NULL,
  `horarios` varchar(255) DEFAULT NULL,
  `sector` varchar(255) DEFAULT NULL,
  `lugar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tipo_disciplina`
--

INSERT INTO `tipo_disciplina` (`id_tipo_disciplina`, `nombre`, `dias`, `horarios`, `sector`, `lugar`) VALUES
(1, 'Boxeo', NULL, NULL, NULL, NULL),
(2, 'Basquet', NULL, NULL, NULL, NULL),
(3, 'Voley', NULL, NULL, NULL, NULL),
(4, 'Natacion', 'Lunes a Viernes', '08:00 a 22:00 hs', 'Polideportivo', 'Calle falsa 123');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `activaciones`
--
ALTER TABLE `activaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_socio` (`id_socio`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `id_socio_fk2` (`id_socio`),
  ADD KEY `fk_tipo_categoria` (`id_tipo_categoria`);

--
-- Indices de la tabla `disciplinas`
--
ALTER TABLE `disciplinas`
  ADD PRIMARY KEY (`id_disciplina`),
  ADD KEY `id_socio_fk5` (`id_socio`),
  ADD KEY `fk_disciplina_tipo` (`id_tipo_disciplina`);

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`),
  ADD KEY `id_rol_fk` (`id_rol`),
  ADD KEY `fk_login_socio` (`id_socio`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `id_socio_fk4` (`id_socio`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `socios`
--
ALTER TABLE `socios`
  ADD PRIMARY KEY (`id_socio`);

--
-- Indices de la tabla `tipo_categoria`
--
ALTER TABLE `tipo_categoria`
  ADD PRIMARY KEY (`id_tipo_categoria`);

--
-- Indices de la tabla `tipo_disciplina`
--
ALTER TABLE `tipo_disciplina`
  ADD PRIMARY KEY (`id_tipo_disciplina`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `activaciones`
--
ALTER TABLE `activaciones`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `disciplinas`
--
ALTER TABLE `disciplinas`
  MODIFY `id_disciplina` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id_pago` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `socios`
--
ALTER TABLE `socios`
  MODIFY `id_socio` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `tipo_categoria`
--
ALTER TABLE `tipo_categoria`
  MODIFY `id_tipo_categoria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_disciplina`
--
ALTER TABLE `tipo_disciplina`
  MODIFY `id_tipo_disciplina` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `activaciones`
--
ALTER TABLE `activaciones`
  ADD CONSTRAINT `activaciones_ibfk_1` FOREIGN KEY (`id_socio`) REFERENCES `socios` (`id_socio`);

--
-- Filtros para la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `fk_tipo_categoria` FOREIGN KEY (`id_tipo_categoria`) REFERENCES `tipo_categoria` (`id_tipo_categoria`),
  ADD CONSTRAINT `id_socio_fk2` FOREIGN KEY (`id_socio`) REFERENCES `socios` (`id_socio`);

--
-- Filtros para la tabla `disciplinas`
--
ALTER TABLE `disciplinas`
  ADD CONSTRAINT `fk_disciplina_tipo` FOREIGN KEY (`id_tipo_disciplina`) REFERENCES `tipo_disciplina` (`id_tipo_disciplina`),
  ADD CONSTRAINT `id_socio_fk5` FOREIGN KEY (`id_socio`) REFERENCES `socios` (`id_socio`);

--
-- Filtros para la tabla `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `fk_login_socio` FOREIGN KEY (`id_socio`) REFERENCES `socios` (`id_socio`),
  ADD CONSTRAINT `id_rol_fk` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`);

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `id_socio_fk4` FOREIGN KEY (`id_socio`) REFERENCES `socios` (`id_socio`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
