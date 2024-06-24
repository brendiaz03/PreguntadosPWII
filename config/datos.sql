
INSERT INTO `partida` (`id`, `idUsuario`, `fechaRealizado`) VALUES
(1, 1, '2024-06-21 23:17:09'),
(2, 1, '2024-06-21 23:18:13'),
(3, 1, '2024-06-21 23:20:45'),
(4, 1, '2024-06-21 23:22:11'),
(5, 1, '2024-06-21 23:23:35'),
(6, 1, '2024-06-21 23:27:15');


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
(36, 'Geografia', 'asdasd', 'Sugerida', 'Dificil', 0, 0, '2024-06-21 19:23:31'),
(37, 'Arte', '¿Quién pintó la obra \"La noche estrellada\"?', 'Activa', 'Facil', 0, 0, '2024-06-24 12:00:00'),
(38, 'Ciencia', '¿Cuál es el elemento químico con el símbolo Na?', 'Activa', 'Intermedio', 0, 0, '2024-06-24 12:00:00'),
(39, 'Geografía', '¿Cuál es la capital de Canadá?', 'Activa', 'Facil', 0, 0, '2024-06-24 12:00:00'),
(40, 'Historia', '¿En qué año comenzó la Segunda Guerra Mundial?', 'Activa', 'Dificil', 0, 0, '2024-06-24 12:00:00'),
(41, 'Cultura General', '¿Quién escribió la novela \"El principito\"?', 'Activa', 'Facil', 0, 0, '2024-06-24 12:00:00'),
(42, 'Deportes', '¿En qué deporte se utiliza un balón de rugby?', 'Activa', 'Intermedio', 0, 0, '2024-06-24 12:00:00'),
(43, 'Ciencia', '¿Cuál es la fórmula química del agua?', 'Activa', 'Intermedio', 0, 0, '2024-06-24 12:00:00'),
(44, 'Geografía', '¿En qué país se encuentra el Taj Mahal?', 'Activa', 'Dificil', 0, 0, '2024-06-24 12:00:00'),
(45, 'Historia', '¿Qué reina de Inglaterra gobernó por más de 63 años?', 'Activa', 'Facil', 0, 0, '2024-06-24 12:00:00'),
(46, 'Cultura General', '¿Qué instrumento musical tiene teclas blancas y negras?', 'Activa', 'Facil', 0, 0, '2024-06-24 12:00:00'),
(47, 'Arte', '¿Quién es el autor de la obra \"El grito\"?', 'Activa', 'Intermedio', 0, 0, '2024-06-24 12:00:00'),
(48, 'Ciencia', '¿Cuál es el planeta más grande del sistema solar?', 'Activa', 'Dificil', 0, 0, '2024-06-24 12:00:00'),
(49, 'Geografía', '¿Cuál es la montaña más alta del mundo?', 'Activa', 'Intermedio', 0, 0, '2024-06-24 12:00:00'),
(50, 'Historia', '¿En qué año terminó la Segunda Guerra Mundial?', 'Activa', 'Dificil', 0, 0, '2024-06-24 12:00:00'),
(51, 'Cultura General', '¿Quién fue el primer hombre en pisar la luna?', 'Activa', 'Facil', 0, 0, '2024-06-24 12:00:00'),
(52, 'Deportes', '¿En qué deporte se utiliza una red y una pelota?', 'Activa', 'Intermedio', 0, 0, '2024-06-24 12:00:00'),
(53, 'Ciencia', '¿Cuál es el metal más ligero?', 'Activa', 'Intermedio', 0, 0, '2024-06-24 12:00:00'),
(54, 'Geografía', '¿En qué país se encuentra el volcán Kilimanjaro?', 'Activa', 'Dificil', 0, 0, '2024-06-24 12:00:00'),
(55, 'Historia', '¿Quién fue el último emperador de Rusia?', 'Activa', 'Facil', 0, 0, '2024-06-24 12:00:00'),
(56, 'Cultura General', '¿Quién escribió la obra \"Hamlet\"?', 'Activa', 'Facil', 0, 0, '2024-06-24 12:00:00'),
(57, 'Arte', '¿Quién pintó \"Las meninas\"?', 'Activa', 'Intermedio', 0, 0, '2024-06-24 12:00:00'),
(58, 'Ciencia', '¿Cuál es el elemento químico con el símbolo Fe?', 'Activa', 'Dificil', 0, 0, '2024-06-24 12:00:00'),
(59, 'Geografía', '¿Cuál es el país más pequeño del mundo?', 'Activa', 'Intermedio', 0, 0, '2024-06-24 12:00:00'),
(60, 'Historia', '¿En qué año comenzó la Primera Guerra Mundial?', 'Activa', 'Dificil', 0, 0, '2024-06-24 12:00:00'),
(61, 'Cultura General', '¿Quién fue el inventor de la bombilla eléctrica?', 'Activa', 'Facil', 0, 0, '2024-06-24 12:00:00'),
(62, 'Deportes', '¿En qué deporte se utiliza una pista y un balón?', 'Activa', 'Intermedio', 0, 0, '2024-06-24 12:00:00'),
(63, 'Ciencia', '¿Cuál es el único metal líquido a temperatura ambiente?', 'Activa', 'Intermedio', 0, 0, '2024-06-24 12:00:00'),
(64, 'Geografía', '¿En qué país se encuentra el lago Titicaca?', 'Activa', 'Dificil', 0, 0, '2024-06-24 12:00:00'),
(65, 'Historia', '¿Quién fue el primer presidente de Estados Unidos que fue negro?', 'Activa', 'Facil', 0, 0, '2024-06-24 12:00:00'),
(66, 'Cultura General', '¿Quién escribió la novela \"1984\"?', 'Activa', 'Facil', 0, 0, '2024-06-24 12:00:00'),
(67, 'Arte', '¿Quién pintó \"Guernica\"?', 'Activa', 'Intermedio', 0, 0, '2024-06-24 12:00:00'),
(68, 'Ciencia', '¿Cuál es el único planeta del sistema solar que gira de lado?', 'Activa', 'Dificil', 0, 0, '2024-06-24 12:00:00'),
(69, 'Geografía', '¿En qué país se encuentra el monte Everest?', 'Activa', 'Intermedio', 0, 0, '2024-06-24 12:00:00'),
(70, 'Historia', '¿En qué año se firmó la Declaración Universal de los Derechos Humanos?', 'Activa', 'Dificil', 0, 0, '2024-06-24 12:00:00'),
(71, 'Cultura General', '¿Quién es el autor de la obra \"Romeo y Julieta\"?', 'Activa', 'Facil', 0, 0, '2024-06-24 12:00:00'),
(72, 'Deportes', '¿En qué deporte se utiliza un guante de béisbol?', 'Activa', 'Intermedio', 0, 0, '2024-06-24 12:00:00'),
(73, 'Ciencia', '¿Cuál es el nombre del ácido presente en el vinagre?', 'Activa', 'Intermedio', 0, 0, '2024-06-24 12:00:00'),
(74, 'Geografía', '¿Cuál es el río más largo de África?', 'Activa', 'Dificil', 0, 0, '2024-06-24 12:00:00'),
(75, 'Historia', '¿En qué año se firmó la Constitución de los Estados Unidos?', 'Activa', 'Facil', 0, 0, '2024-06-24 12:00:00'),
(76, 'Cultura General', '¿Quién fue el director de la película \"El Padrino\"?', 'Activa', 'Facil', 0, 0, '2024-06-24 12:00:00'),
(77, 'Arte', '¿Quién pintó \"El nacimiento de Venus\"?', 'Activa', 'Intermedio', 0, 0, '2024-06-24 12:00:00'),
(78, 'Ciencia', '¿Cuál es el metal más abundante en la corteza terrestre?', 'Activa', 'Dificil', 0, 0, '2024-06-24 12:00:00'),
(79, 'Geografía', '¿Cuál es el país más poblado del mundo?', 'Activa', 'Intermedio', 0, 0, '2024-06-24 12:00:00'),
(80, 'Historia', '¿Quién fue el primer presidente de México?', 'Activa', 'Facil', 0, 0, '2024-06-24 12:00:00');

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
(144, '4', 0, 36),
(145, 'Vincent van Gogh', 1, 37),
(146, 'Pablo Picasso', 0, 37),
(147, 'Leonardo da Vinci', 0, 37),
(148, 'Claude Monet', 0, 37),
(149, 'Sodio', 1, 38),
(150, 'Calcio', 0, 38),
(151, 'Potasio', 0, 38),
(152, 'Hierro', 0, 38),
(153, 'Ottawa', 1, 39),
(154, 'Toronto', 0, 39),
(155, 'Montreal', 0, 39),
(156, 'Vancouver', 0, 39),
(157, '1939', 1, 40),
(158, '1941', 0, 40),
(159, '1945', 0, 40),
(160, '1947', 0, 40),
(161, 'Antoine de Saint-Exupéry', 1, 41),
(162, 'Franz Kafka', 0, 41),
(163, 'Jorge Luis Borges', 0, 41),
(164, 'Gabriel García Márquez', 0, 41),
(165, 'Rugby', 1, 42),
(166, 'Tenis', 0, 42),
(167, 'Golf', 0, 42),
(168, 'Cricket', 0, 42),
(169, 'H2O', 1, 43),
(170, 'CO2', 0, 43),
(171, 'NaCl', 0, 43),
(172, 'CH4', 0, 43),
(173, 'India', 1, 44),
(174, 'China', 0, 44),
(175, 'Japón', 0, 44),
(176, 'Indonesia', 0, 44),
(177, 'Victoria', 1, 45),
(178, 'Isabel I', 0, 45),
(179, 'Ana Bolena', 0, 45),
(180, 'María Estuardo', 0, 45),
(181, 'Piano', 1, 46),
(182, 'Saxofón', 0, 46),
(183, 'Trompeta', 0, 46),
(184, 'Batería', 0, 46),
(185, 'Edvard Munch', 1, 47),
(186, 'Henri Matisse', 0, 47),
(187, 'Pablo Picasso', 0, 47),
(188, 'Salvador Dalí', 0, 47),
(189, 'Júpiter', 1, 48),
(190, 'Saturno', 0, 48),
(191, 'Neptuno', 0, 48),
(192, 'Urano', 0, 48),
(193, 'Himalaya', 1, 49),
(194, 'Andes', 0, 49),
(195, 'Alpes', 0, 49),
(196, 'Rockies', 0, 49),
(197, '1945', 1, 50),
(198, '1943', 0, 50),
(199, '1941', 0, 50),
(200, '1939', 0, 50),
(201, 'Neil Armstrong', 1, 51),
(202, 'Buzz Aldrin', 0, 51),
(203, 'Yuri Gagarin', 0, 51),
(204, 'Alan Shepard', 0, 51),
(205, 'Bádminton', 1, 52),
(206, 'Voleibol', 0, 52),
(207, 'Hockey sobre hielo', 0, 52),
(208, 'Balonmano', 0, 52),
(209, 'Aluminio', 1, 53),
(210, 'Oro', 0, 53),
(211, 'Plata', 0, 53),
(212, 'Cobre', 0, 53),
(213, 'Tanzania', 1, 54),
(214, 'Sudáfrica', 0, 54),
(215, 'Etiopía', 0, 54),
(216, 'Kenia', 0, 54),
(217, 'Nicolás II', 1, 55),
(218, 'Pedro I', 0, 55),
(219, 'Alejandro I', 0, 55),
(220, 'Iván IV', 0, 55),
(221, 'William Shakespeare', 1, 56),
(222, 'Miguel de Cervantes', 0, 56),
(223, 'Homero', 0, 56),
(224, 'Jorge Luis Borges', 0, 56),
(225, 'Diego Velázquez', 1, 57),
(226, 'Francisco de Goya', 0, 57),
(227, 'El Greco', 0, 57),
(228, 'Pablo Picasso', 0, 57),
(229, 'Hierro', 1, 58),
(230, 'Oro', 0, 58),
(231, 'Plata', 0, 58),
(232, 'Cobre', 0, 58),
(233, 'Ciudad del Vaticano', 1, 59),
(234, 'Mónaco', 0, 59),
(235, 'San Marino', 0, 59),
(236, 'Tuvalu', 0, 59),
(237, '1914', 1, 60),
(238, '1915', 0, 60),
(239, '1917', 0, 60),
(240, '1918', 0, 60),
(241, 'Thomas Edison', 1, 61),
(242, 'Nikola Tesla', 0, 61),
(243, 'Alexander Graham Bell', 0, 61),
(244, 'James Watt', 0, 61),
(245, 'Baloncesto', 1, 62),
(246, 'Voleibol', 0, 62),
(247, 'Rugby', 0, 62),
(248, 'Hockey sobre césped', 0, 62),
(249, 'Mercurio', 1, 63),
(250, 'Plomo', 0, 63),
(251, 'Estaño', 0, 63),
(252, 'Aluminio', 0, 63),
(253, 'Tanzania', 1, 64),
(254, 'Sudáfrica', 0, 64),
(255, 'Etiopía', 0, 64),
(256, 'Kenia', 0, 64),
(257, '1776', 1, 65),
(258, '1810', 0, 65),
(259, '1821', 0, 65),
(260, '1848', 0, 65),
(261, 'George Orwell', 1, 66),
(262, 'Aldous Huxley', 0, 66),
(263, 'Ray Bradbury', 0, 66),
(264, 'Jules Verne', 0, 66),
(265, 'Pablo Picasso', 1, 67),
(266, 'Salvador Dalí', 0, 67),
(267, 'Henri Matisse', 0, 67),
(268, 'Francisco de Goya', 0, 67),
(269, 'Urano', 1, 68),
(270, 'Neptuno', 0, 68),
(271, 'Saturno', 0, 68),
(272, 'Júpiter', 0, 68),
(273, 'Nepal', 1, 69),
(274, 'China', 0, 69),
(275, 'India', 0, 69),
(276, 'Bután', 0, 69),
(277, '1948', 1, 70),
(278, '1950', 0, 70),
(279, '1952', 0, 70),
(280, '1955', 0, 70),
(281, 'William Shakespeare', 1, 71),
(282, 'Miguel de Cervantes', 0, 71),
(283, 'Homero', 0, 71),
(284, 'Jorge Luis Borges', 0, 71),
(285, 'Béisbol', 1, 72),
(286, 'Hockey sobre hierba', 0, 72),
(287, 'Baloncesto', 0, 72),
(288, 'Fútbol', 0, 72),
(289, 'Ácido acético', 1, 73),
(290, 'Ácido sulfúrico', 0, 73),
(291, 'Ácido clorhídrico', 0, 73),
(292, 'Ácido nítrico', 0, 73),
(293, 'Nilo', 1, 74),
(294, 'Congo', 0, 74),
(295, 'Zambeze', 0, 74),
(296, 'Níger', 0, 74),
(297, '1787', 1, 75),
(298, '1776', 0, 75),
(299, '1789', 0, 75),
(300, '1791', 0, 75),
(301, 'Francis Ford Coppola', 1, 76),
(302, 'Martin Scorsese', 0, 76),
(303, 'Quentin Tarantino', 0, 76),
(304, 'Steven Spielberg', 0, 76),
(305, 'Sandro Botticelli', 1, 77),
(306, 'Leonardo da Vinci', 0, 77),
(307, 'Rafael', 0, 77),
(308, 'Michelangelo', 0, 77),
(309, 'Aluminio', 1, 78),
(310, 'Hierro', 0, 78),
(311, 'Calcio', 0, 78),
(312, 'Cobre', 0, 78),
(313, 'China', 1, 79),
(314, 'India', 0, 79),
(315, 'Estados Unidos', 0, 79),
(316, 'Indonesia', 0, 79),
(317, 'Guadalupe Victoria', 1, 80),
(318, 'Benito Juárez', 0, 80),
(319, 'Porfirio Díaz', 0, 80),
(320, 'Emiliano Zapata', 0, 80);


INSERT INTO `usuario` (`nombreCompleto`, `anioNacimiento`, `sexo`, `pais`, `ciudad`, `mail`, `foto`, `password`, `nombreUsuario`, `tipoUsuario`, `nivel`, `puntaje`, `activo`, `hash`, `latitud`, `longitud`) VALUES
( 'Agustin', 2024, 'Masculino', 'Argentina', 'Buenos Aires', 'asdasd@gmail.com', 'agustin123.jpg', '123', 'agustin123', 'Jugador', 'Dificil', 18, 1, '', -34.683380, -58.591535),
('editor', 2024, 'Masculino', 'Argentina', 'Buenos Aires', 'editor@tamosprobando.com', 'editor.jpg', '123', 'editor', 'Editor', NULL, 0, 1, '', NULL, NULL),
 ('Admin', 2024, 'Masculino', 'Argentina', 'Buenos Aires', 'admin@tamosprobando.com', 'admin.jpg', '123', 'admin', 'Admin', NULL, 0, 1, '', NULL, NULL),
('PruebaMapa2', 2024, 'Masculino', 'Argentina', 'Buenos Aires', 'asdasadvvvvvcsd@gmail.com', 'pruebamapa2.jpg', '123', 'pruebamapa2', 'Jugador', NULL, 0, 1, '', -34.619172, -58.374387);



CREATE TABLE `usuario` (
                           `id` int(11) NOT NULL PRIMARY KEY,
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
);

ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `usuario`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;




CREATE TABLE `categoria_color` (
                                   `id` int(11) NOT NULL PRIMARY KEY,
                                   `categoria` varchar(50) NOT NULL,
                                   `color` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `categoria_color` (`id`, `categoria`, `color`) VALUES
                                                               (1, 'Ciencia', '#04D960'),
                                                               (2, 'Matemáticas', '#C848D9'),
                                                               (3, 'Cultura General', '#F20505'),
                                                               (4, 'Geografía', '#0088EE'),
                                                               (5, 'Historia', '#F2D027'),
                                                               (6, 'Deportes', '#F27405'),
                                                               (7, 'Arte', '#34E7F8');


ALTER TABLE `categoria_color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `categoria_color`
    ADD PRIMARY KEY (`id`);



CREATE TABLE `partida` (
                           `id` int(11) NOT NULL PRIMARY KEY,
                           `idUsuario` int(11) DEFAULT NULL,
                           `fechaRealizado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `partida`
  ADD CONSTRAINT `partida_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`);

ALTER TABLE `partida`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `partida`
    ADD PRIMARY KEY (`id`),
    ADD KEY `idUsuario` (`idUsuario`);


CREATE TABLE `partida_pregunta` (
                                    `id` int(11) NOT NULL PRIMARY KEY,
                                    `idPartida` int(11) DEFAULT NULL,
                                    `idPregunta` int(11) DEFAULT NULL,
                                    `correcta` tinyint(1) DEFAULT NULL,
                                    `fechaRealizado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
ALTER TABLE `partida_pregunta`
    ADD CONSTRAINT `partida_pregunta_ibfk_1` FOREIGN KEY (`idPartida`) REFERENCES `partida` (`id`),
    ADD CONSTRAINT `partida_pregunta_ibfk_2` FOREIGN KEY (`idPregunta`) REFERENCES `pregunta` (`id`);

ALTER TABLE `partida_pregunta`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
ALTER TABLE `partida_pregunta`
    ADD PRIMARY KEY (`id`),
    ADD KEY `idPartida` (`idPartida`),
    ADD KEY `idPregunta` (`idPregunta`);


CREATE TABLE `pregunta` (
                            `id` int(11) NOT NULL PRIMARY KEY,
                            `categoria` varchar(50) DEFAULT NULL,
                            `pregunta` varchar(200) DEFAULT NULL,
                            `estado` varchar(50) DEFAULT NULL,
                            `nivel` varchar(50) DEFAULT NULL,
                            `veces_entregada` int(11) DEFAULT NULL,
                            `hits` int(11) DEFAULT NULL,
                            `fechaRealizado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `pregunta`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;



ALTER TABLE `pregunta`
    ADD PRIMARY KEY (`id`);



CREATE TABLE `respuesta` (
                             `id` int(11) NOT NULL PRIMARY KEY,
                             `respuesta` varchar(200) DEFAULT NULL,
                             `correcta` tinyint(1) DEFAULT NULL,
                             `pregunta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `respuesta`
  ADD CONSTRAINT `respuesta_ibfk_1` FOREIGN KEY (`pregunta`) REFERENCES `pregunta` (`id`);
COMMIT;
ALTER TABLE `respuesta`
    ADD PRIMARY KEY (`id`),
    ADD KEY `pregunta` (`pregunta`);

ALTER TABLE `respuesta`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;
# dgijdlgkdjg slos quiweubfre
CREATE TABLE pregunta(
                         id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
                         categoria VARCHAR(50),
                         pregunta VARCHAR(200),
                         estado VARCHAR(50), -- activa, inactiva , reportada, sugerida
                         nivel VARCHAR(50),
                         veces_entregada int,
                         hits int,
                         fechaRealizado datetime
);

CREATE TABLE respuesta(
                          id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
                          respuesta VARCHAR(200),
                          correcta bool,
                          pregunta INTEGER,
                          FOREIGN KEY(pregunta) REFERENCES pregunta(id)
);
CREATE TABLE partida(
                        id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
                        idUsuario INTEGER,
                        fechaRealizado DATETIME,
                        FOREIGN KEY(idUsuario) REFERENCES usuario(id)
);

CREATE TABLE partida_pregunta (
                                  id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
                                  idPartida INTEGER,
                                  idPregunta INTEGER,
                                  correcta BOOLEAN,
                                  fechaRealizado DATETIME,
                                  FOREIGN KEY (idPartida) REFERENCES partida(id),
                                  FOREIGN KEY (idPregunta) REFERENCES pregunta(id)
);
CREATE TABLE categoria_color (
                                 id INTEGER PRIMARY KEY AUTO_INCREMENT,
                                 categoria VARCHAR(50) NOT NULL,
                                 color VARCHAR(50) NOT NULL
);
INSERT INTO categoria_color (categoria, color) VALUES
                                                   ('Ciencia', '#04D960'),
                                                   ('Matemáticas', '#C848D9'),
                                                   ('Cultura General', '#F20505'),
                                                   ('Geografía', '#0088EE'),
                                                   ('Historia', '#F2D027'),
                                                   ('Deportes', '#F27405'),
                                                   ('Arte', '#34E7F8');


