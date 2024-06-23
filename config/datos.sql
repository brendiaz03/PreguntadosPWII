-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-06-2024 a las 02:29:35
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `preguntados`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_color`
--

CREATE TABLE `categoria_color` (
  `id` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria_color`
--

INSERT INTO `categoria_color` (`id`, `categoria`, `color`) VALUES
(1, 'Ciencia', '#04D960'),
(2, 'Matemáticas', '#C848D9'),
(3, 'Cultura General', '#F20505'),
(4, 'Geografía', '#0088EE'),
(5, 'Historia', '#F2D027'),
(6, 'Deportes', '#F27405'),
(7, 'Arte', '#34E7F8');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida`
--

CREATE TABLE `partida` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `fechaRealizado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `partida`
--

INSERT INTO `partida` (`id`, `idUsuario`, `fechaRealizado`) VALUES
(1, 1, '2024-06-21 23:17:09'),
(2, 1, '2024-06-21 23:18:13'),
(3, 1, '2024-06-21 23:20:45'),
(4, 1, '2024-06-21 23:22:11'),
(5, 1, '2024-06-21 23:23:35'),
(6, 1, '2024-06-21 23:27:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida_pregunta`
--

CREATE TABLE `partida_pregunta` (
  `id` int(11) NOT NULL,
  `idPartida` int(11) DEFAULT NULL,
  `idPregunta` int(11) DEFAULT NULL,
  `correcta` tinyint(1) DEFAULT NULL,
  `fechaRealizado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `partida_pregunta`
--

INSERT INTO `partida_pregunta` (`id`, `idPartida`, `idPregunta`, `correcta`, `fechaRealizado`) VALUES
(1, 1, 2, 1, '2024-06-21 23:17:22'),
(2, 1, 28, 1, '2024-06-21 23:17:29'),
(3, 1, 8, 1, '2024-06-21 23:17:36'),
(4, 1, 8, 1, '2024-06-21 23:17:41'),
(5, 1, 2, 1, '2024-06-21 23:17:45'),
(6, 1, 11, 0, '2024-06-21 23:18:00'),
(7, 2, 27, 1, '2024-06-21 23:18:18'),
(8, 2, 27, 1, '2024-06-21 23:18:21'),
(9, 2, 5, 1, '2024-06-21 23:18:24'),
(10, 2, 27, 1, '2024-06-21 23:18:27'),
(11, 2, 26, 1, '2024-06-21 23:18:31'),
(12, 2, 26, 1, '2024-06-21 23:18:34'),
(13, 2, 19, 1, '2024-06-21 23:18:39'),
(14, 2, 16, 1, '2024-06-21 23:18:43'),
(15, 2, 16, 1, '2024-06-21 23:18:47'),
(16, 2, 4, 1, '2024-06-21 23:18:50'),
(17, 2, 10, 1, '2024-06-21 23:18:53'),
(18, 2, 13, 1, '2024-06-21 23:19:00'),
(19, 2, 29, 1, '2024-06-21 23:19:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `id` int(11) NOT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `pregunta` varchar(200) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `nivel` varchar(50) DEFAULT NULL,
  `veces_entregada` int(11) DEFAULT NULL,
  `hits` int(11) DEFAULT NULL,
  `fechaRealizado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`id`, `categoria`, `pregunta`, `estado`, `nivel`, `veces_entregada`, `hits`, `fechaRealizado`) VALUES
(1, 'Matemáticas', '¿Cuál es el valor de π?', 'Activa', 'Intermedio', 0, 0, '2024-06-21 18:10:23'),
(2, 'Geografía', '¿Cuál es la capital de Francia?', 'Activa', 'Facil', 2, 2, '2024-06-21 18:10:23'),
(3, 'Ciencia', '¿Qué planeta es conocido como el Planeta Rojo?', 'Activa', 'Intermedio', 0, 0, '2024-06-21 18:10:23'),
(4, 'Historia', '¿Quién fue el primer presidente de los Estados Unidos?', 'Activa', 'Dificil', 1, 1, '2024-06-21 18:10:23'),
(5, 'Matemáticas', '¿Cuánto es 2 + 2?', 'Activa', 'Facil', 1, 1, '2024-06-21 18:10:23'),
(6, 'Matemáticas', '¿Cuál es el resultado de 3 * 4?', 'Activa', 'Intermedio', 0, 0, '2024-06-21 18:10:23'),
(7, 'Matemáticas', '¿Cuánto es la raíz cuadrada de 16?', 'Activa', 'Dificil', 0, 0, '2024-06-21 18:10:23'),
(8, 'Geografía', '¿Cuál es el río más largo del mundo?', 'Activa', 'Facil', 2, 2, '2024-06-21 18:10:23'),
(9, 'Geografía', '¿En qué continente se encuentra Australia?', 'Activa', 'Intermedio', 0, 0, '2024-06-21 18:10:23'),
(10, 'Geografía', '¿Cuál es la capital de Japón?', 'Activa', 'Dificil', 1, 1, '2024-06-21 18:10:23'),
(11, 'Ciencia', '¿Cuál es el elemento más abundante en la Tierra?', 'Activa', 'Facil', 1, 0, '2024-06-21 18:10:23'),
(12, 'Ciencia', '¿Quién descubrió la penicilina?', 'Activa', 'Intermedio', 0, 0, '2024-06-21 18:10:23'),
(13, 'Ciencia', '¿Cuál es la velocidad de la luz en el vacío?', 'Activa', 'Dificil', 1, 1, '2024-06-21 18:10:23'),
(14, 'Historia', '¿En qué año llegó Cristóbal Colón a América?', 'Activa', 'Facil', 0, 0, '2024-06-21 18:10:23'),
(15, 'Historia', '¿Quién fue el emperador romano que construyó el Coliseo?', 'Activa', 'Intermedio', 0, 0, '2024-06-21 18:10:23'),
(16, 'Historia', '¿Qué tratado puso fin a la Primera Guerra Mundial?', 'Activa', 'Dificil', 2, 2, '2024-06-21 18:10:23'),
(17, 'Cultura General', '¿Quién escribió la novela \"Cien años de soledad\"?', 'Activa', 'Facil', 0, 0, '2024-06-21 18:10:23'),
(18, 'Cultura General', '¿Qué instrumento tocaba Ludwig van Beethoven?', 'Activa', 'Intermedio', 0, 0, '2024-06-21 18:10:23'),
(19, 'Cultura General', '¿En qué país se originó el sushi?', 'Activa', 'Dificil', 1, 1, '2024-06-21 18:10:23'),
(20, 'Ciencia', '¿Cuál es la unidad de medida de la temperatura?', 'Activa', 'Intermedio', 0, 0, '2024-06-21 18:10:24'),
(21, 'Geografía', '¿Cuál es el río más largo del mundo?', 'Activa', 'Intermedio', 0, 0, '2024-06-21 18:10:24'),
(22, 'Arte', '¿Quién pintó la Mona Lisa?', 'Activa', 'Intermedio', 0, 0, '2024-06-21 18:10:24'),
(23, 'Deportes', '¿En qué deporte se utiliza una raqueta?', 'Activa', 'Intermedio', 0, 0, '2024-06-21 18:10:24'),
(24, 'Ciencia', '¿Qué elemento químico tiene el símbolo H?', 'Activa', 'Intermedio', 0, 0, '2024-06-21 18:10:24'),
(25, 'Cultura General', '¿Cuál es el país más grande del mundo por territorio?', 'Activa', 'Intermedio', 0, 0, '2024-06-21 18:10:24'),
(26, 'Historia', '¿En qué año se firmó la Declaración de Independencia de los Estados Unidos?', 'Activa', 'Dificil', 2, 2, '2024-06-21 18:10:24'),
(27, 'Geografía', '¿En qué continente se encuentra el desierto del Sahara?', 'Activa', 'Facil', 3, 3, '2024-06-21 18:10:24'),
(28, 'Arte', '¿Quién escribió la obra \"Don Quijote de la Mancha\"?', 'Activa', 'Facil', 1, 1, '2024-06-21 18:10:24'),
(29, 'Deportes', '¿En qué deporte se utiliza un octógono como forma del área de competición?', 'Reportada', 'Dificil', 1, 1, '2024-06-21 18:10:24'),
(30, 'Ciencia', '¿Cuál es el hueso más largo del cuerpo humano?', 'Activa', 'Intermedio', 0, 0, '2024-06-21 18:10:24'),
(33, 'Historia', 'De que color era el caballo blanco de san martin?', 'Inactiva', 'Dificil', 0, 0, '2024-06-21 18:51:36'),
(35, 'Historia', 'Hola?', 'Sugerida', 'Dificil', 0, 0, '2024-06-21 19:00:04'),
(36, 'Geografia', 'asdasd', 'Sugerida', 'Dificil', 0, 0, '2024-06-21 19:23:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

CREATE TABLE `respuesta` (
  `id` int(11) NOT NULL,
  `respuesta` varchar(200) DEFAULT NULL,
  `correcta` tinyint(1) DEFAULT NULL,
  `pregunta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `respuesta`
--

INSERT INTO `respuesta` (`id`, `respuesta`, `correcta`, `pregunta`) VALUES
(1, '3.14', 1, 1),
(2, '2.71', 0, 1),
(3, '1.62', 0, 1),
(4, '3.41', 0, 1),
(5, 'París', 1, 2),
(6, 'Londres', 0, 2),
(7, 'Madrid', 0, 2),
(8, 'Berlín', 0, 2),
(9, 'Marte', 1, 3),
(10, 'Júpiter', 0, 3),
(11, 'Saturno', 0, 3),
(12, 'Venus', 0, 3),
(13, 'George Washington', 1, 4),
(14, 'Thomas Jefferson', 0, 4),
(15, 'Abraham Lincoln', 0, 4),
(16, 'John Adams', 0, 4),
(17, '4', 1, 5),
(18, '3', 0, 5),
(19, '5', 0, 5),
(20, '6', 0, 5),
(21, '12', 1, 6),
(22, '8', 0, 6),
(23, '16', 0, 6),
(24, '6', 0, 6),
(25, '4', 1, 7),
(26, '3', 0, 7),
(27, '5', 0, 7),
(28, '6', 0, 7),
(29, 'Amazonas', 1, 8),
(30, 'Nilo', 0, 8),
(31, 'Misisipi', 0, 8),
(32, 'Yangtsé', 0, 8),
(33, 'Oceanía', 1, 9),
(34, 'Europa', 0, 9),
(35, 'América', 0, 9),
(36, 'Asia', 0, 9),
(37, 'Tokio', 1, 10),
(38, 'Pekín', 0, 10),
(39, 'Seúl', 0, 10),
(40, 'Bangkok', 0, 10),
(41, 'Oxígeno', 1, 11),
(42, 'Carbono', 0, 11),
(43, 'Hidrógeno', 0, 11),
(44, 'Nitrógeno', 0, 11),
(45, 'Alexander Fleming', 1, 12),
(46, 'Albert Einstein', 0, 12),
(47, 'Marie Curie', 0, 12),
(48, 'Isaac Newton', 0, 12),
(49, '299,792,458 metros por segundo', 1, 13),
(50, '300,000,000 metros por segundo', 0, 13),
(51, '200,000,000 metros por segundo', 0, 13),
(52, '400,000,000 metros por segundo', 0, 13),
(53, '1492', 1, 14),
(54, '1501', 0, 14),
(55, '1510', 0, 14),
(56, '1485', 0, 14),
(57, 'Vespasiano', 1, 15),
(58, 'Nerón', 0, 15),
(59, 'Augusto', 0, 15),
(60, 'Trajano', 0, 15),
(61, 'Tratado de Versalles', 1, 16),
(62, 'Tratado de París', 0, 16),
(63, 'Tratado de Londres', 0, 16),
(64, 'Tratado de Viena', 0, 16),
(65, 'Gabriel García Márquez', 1, 17),
(66, 'Pablo Neruda', 0, 17),
(67, 'Jorge Luis Borges', 0, 17),
(68, 'Mario Vargas Llosa', 0, 17),
(69, 'Piano', 1, 18),
(70, 'Violín', 0, 18),
(71, 'Flauta', 0, 18),
(72, 'Guitarra', 0, 18),
(73, 'Japón', 1, 19),
(74, 'China', 0, 19),
(75, 'Corea del Sur', 0, 19),
(76, 'Tailandia', 0, 19),
(77, 'Grado Celsius', 1, 20),
(78, 'Grado Fahrenheit', 0, 20),
(79, 'Kelvin', 0, 20),
(80, 'Grado Réaumur', 0, 20),
(81, 'Río Amazonas', 1, 21),
(82, 'Río Nilo', 0, 21),
(83, 'Río Yangtsé', 0, 21),
(84, 'Río Misisipi-Misuri', 0, 21),
(85, 'Leonardo da Vinci', 1, 22),
(86, 'Pablo Picasso', 0, 22),
(87, 'Vincent van Gogh', 0, 22),
(88, 'Michelangelo Buonarroti', 0, 22),
(89, 'Tenis', 1, 23),
(90, 'Fútbol', 0, 23),
(91, 'Baloncesto', 0, 23),
(92, 'Golf', 0, 23),
(93, 'Hidrógeno', 1, 24),
(94, 'Helio', 0, 24),
(95, 'Hierro', 0, 24),
(96, 'Plata', 0, 24),
(97, 'Rusia', 1, 25),
(98, 'Canadá', 0, 25),
(99, 'China', 0, 25),
(100, 'Estados Unidos', 0, 25),
(101, '1776', 1, 26),
(102, '1789', 0, 26),
(103, '1812', 0, 26),
(104, '1865', 0, 26),
(105, 'África', 1, 27),
(106, 'Asia', 0, 27),
(107, 'América del Sur', 0, 27),
(108, 'Australia', 0, 27),
(109, 'Miguel de Cervantes', 1, 28),
(110, 'William Shakespeare', 0, 28),
(111, 'Gabriel García Márquez', 0, 28),
(112, 'Pablo Neruda', 0, 28),
(113, 'Artes marciales mixtas (MMA)', 1, 29),
(114, 'Boxeo', 0, 29),
(115, 'Fútbol americano', 0, 29),
(116, 'Tenis de mesa', 0, 29),
(117, 'Fémur', 1, 30),
(118, 'Húmero', 0, 30),
(119, 'Tibia', 0, 30),
(120, 'Fíbula', 0, 30),
(129, 'blanco', 1, 33),
(130, 'negro', 0, 33),
(131, 'azul', 0, 33),
(132, 'amarillo', 0, 33),
(137, '1', 1, 35),
(138, '2', 0, 35),
(139, '3', 0, 35),
(140, '4', 0, 35),
(141, '1', 1, 36),
(142, '2', 0, 36),
(143, '3', 0, 36),
(144, '4', 0, 36);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombreCompleto` varchar(50) DEFAULT NULL,
  `anioNacimiento` int(11) DEFAULT NULL,
  `sexo` varchar(20) DEFAULT NULL,
  `pais` varchar(30) DEFAULT NULL,
  `ciudad` varchar(30) DEFAULT NULL,
  `mail` varchar(30) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `nombreUsuario` varchar(30) DEFAULT NULL,
  `fechaRegistro` datetime DEFAULT NULL,
      `tipoUsuario` varchar(20) DEFAULT NULL,
  `nivel` varchar(50) DEFAULT NULL,
  `puntaje` int(11) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `hash` varchar(250) DEFAULT NULL,
  `latitud` decimal(9,6) DEFAULT NULL,
  `longitud` decimal(9,6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombreCompleto`, `anioNacimiento`, `sexo`, `pais`, `ciudad`, `mail`, `foto`, `password`, `nombreUsuario`, `tipoUsuario`, `nivel`, `puntaje`, `activo`, `hash`, `latitud`, `longitud`) VALUES
(1, 'Agustin', 2024, 'Masculino', 'Argentina', 'Buenos Aires', 'asdasd@gmail.com', 'agustin123.jpg', '123', 'agustin123', 'Jugador', 'Dificil', 18, 1, '', -34.683380, -58.591535),
(2, 'editor', 2024, 'Masculino', 'Argentina', 'Buenos Aires', 'editor@tamosprobando.com', 'editor.jpg', '123', 'editor', 'Editor', NULL, 0, 1, '', NULL, NULL),
(3, 'Admin', 2024, 'Masculino', 'Argentina', 'Buenos Aires', 'admin@tamosprobando.com', 'admin.jpg', '123', 'admin', 'Admin', NULL, 0, 1, '', NULL, NULL),
(7, 'PruebaMapa2', 2024, 'Masculino', 'Argentina', 'Buenos Aires', 'asdasadvvvvvcsd@gmail.com', 'pruebamapa2.jpg', '123', 'pruebamapa2', 'Jugador', NULL, 0, 1, '', -34.619172, -58.374387);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria_color`
--
ALTER TABLE `categoria_color`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `partida`
--
ALTER TABLE `partida`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `partida_pregunta`
--
ALTER TABLE `partida_pregunta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPartida` (`idPartida`),
  ADD KEY `idPregunta` (`idPregunta`);

--
-- Indices de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pregunta` (`pregunta`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria_color`
--
ALTER TABLE `categoria_color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `partida`
--
ALTER TABLE `partida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `partida_pregunta`
--
ALTER TABLE `partida_pregunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `partida`
--
ALTER TABLE `partida`
  ADD CONSTRAINT `partida_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `partida_pregunta`
--
ALTER TABLE `partida_pregunta`
  ADD CONSTRAINT `partida_pregunta_ibfk_1` FOREIGN KEY (`idPartida`) REFERENCES `partida` (`id`),
  ADD CONSTRAINT `partida_pregunta_ibfk_2` FOREIGN KEY (`idPregunta`) REFERENCES `pregunta` (`id`);

--
-- Filtros para la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD CONSTRAINT `respuesta_ibfk_1` FOREIGN KEY (`pregunta`) REFERENCES `pregunta` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
