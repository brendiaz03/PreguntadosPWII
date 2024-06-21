CREATE DATABASE preguntados;
USE preguntados;

CREATE TABLE Usuario(
    id int PRIMARY KEY AUTO_INCREMENT,
    nombreCompleto varchar(50),
    anioNacimiento int,
    sexo varchar(20),
    pais varchar(30),
    ciudad varchar(30),
    mail varchar(30),
    foto varchar(100),
    password varchar(30),
    nombreUsuario varchar(30),
    tipoUsuario varchar(20),
    nivel VARCHAR(50),
    puntaje int,
    activo bool,
    hash VARCHAR(250)
);

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
# CREATE TABLE partida(
#     id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
#     idPregunta INTEGER,
#     idUsuario INTEGER,
#     correcta BOOLEAN,
#     fechaRealizado DATETIME,
#     FOREIGN KEY(idPregunta) REFERENCES pregunta(id),
#     FOREIGN KEY(idUsuario) REFERENCES usuario(id)
# );
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

INSERT INTO pregunta (categoria, pregunta, estado, nivel, veces_entregada, hits, fechaRealizado)
VALUES
    ('Matemáticas', '¿Cuál es el valor de π?', 'Activa', 'Intermedio', 0, 0, NOW()),
    ('Geografía', '¿Cuál es la capital de Francia?', 'Activa', 'Facil', 0, 0, NOW()),
    ('Ciencia', '¿Qué planeta es conocido como el Planeta Rojo?', 'Activa', 'Intermedio', 0, 0, NOW()),
    ('Historia', '¿Quién fue el primer presidente de los Estados Unidos?', 'Activa', 'Dificil', 0, 0, NOW());
-- Preguntas de Matemáticas
INSERT INTO pregunta (categoria, pregunta, estado, nivel, veces_entregada, hits, fechaRealizado)
VALUES
    ('Matemáticas', '¿Cuánto es 2 + 2?', 'Activa', 'Facil', 0, 0, NOW()),
    ('Matemáticas', '¿Cuál es el resultado de 3 * 4?', 'Activa', 'Intermedio', 0, 0, NOW()),
    ('Matemáticas', '¿Cuánto es la raíz cuadrada de 16?', 'Activa', 'Dificil', 0, 0, NOW());

-- Preguntas de Geografía
INSERT INTO pregunta (categoria, pregunta, estado, nivel, veces_entregada, hits, fechaRealizado)
VALUES
    ('Geografía', '¿Cuál es el río más largo del mundo?', 'Activa', 'Facil', 0, 0, NOW()),
    ('Geografía', '¿En qué continente se encuentra Australia?', 'Activa', 'Intermedio', 0, 0, NOW()),
    ('Geografía', '¿Cuál es la capital de Japón?', 'Activa', 'Dificil', 0, 0, NOW());

-- Preguntas de Ciencia
INSERT INTO pregunta (categoria, pregunta, estado, nivel, veces_entregada, hits, fechaRealizado)
VALUES
    ('Ciencia', '¿Cuál es el elemento más abundante en la Tierra?', 'Activa', 'Facil', 0, 0, NOW()),
    ('Ciencia', '¿Quién descubrió la penicilina?', 'Activa', 'Intermedio', 0, 0, NOW()),
    ('Ciencia', '¿Cuál es la velocidad de la luz en el vacío?', 'Activa', 'Dificil', 0, 0, NOW());

-- Preguntas de Historia
INSERT INTO pregunta (categoria, pregunta, estado, nivel, veces_entregada, hits, fechaRealizado)
VALUES
    ('Historia', '¿En qué año llegó Cristóbal Colón a América?', 'Activa', 'Facil', 0, 0, NOW()),
    ('Historia', '¿Quién fue el emperador romano que construyó el Coliseo?', 'Activa', 'Intermedio', 0, 0, NOW()),
    ('Historia', '¿Qué tratado puso fin a la Primera Guerra Mundial?', 'Activa', 'Dificil', 0, 0, NOW());

-- Preguntas de Cultura General
INSERT INTO pregunta (categoria, pregunta, estado, nivel, veces_entregada, hits, fechaRealizado)
VALUES
    ('Cultura General', '¿Quién escribió la novela "Cien años de soledad"?', 'Activa', 'Facil', 0, 0, NOW()),
    ('Cultura General', '¿Qué instrumento tocaba Ludwig van Beethoven?', 'Activa', 'Intermedio', 0, 0, NOW()),
    ('Cultura General', '¿En qué país se originó el sushi?', 'Activa', 'Dificil', 0, 0, NOW());
INSERT INTO respuesta (respuesta, correcta, pregunta)
VALUES
    ('3.14', true, 1),
    ('2.71', false, 1),
    ('1.62', false, 1),
    ('3.41', false, 1);
INSERT INTO respuesta (respuesta, correcta, pregunta)
VALUES
    ('París', true, 2),
    ('Londres', false, 2),
    ('Madrid', false, 2),
    ('Berlín', false, 2);
INSERT INTO respuesta (respuesta, correcta, pregunta)
VALUES
    ('Marte', true, 3),
    ('Júpiter', false, 3),
    ('Saturno', false, 3),
    ('Venus', false, 3);
INSERT INTO respuesta (respuesta, correcta, pregunta)
VALUES
    ('George Washington', true, 4),
    ('Thomas Jefferson', false, 4),
    ('Abraham Lincoln', false, 4),
    ('John Adams', false, 4);
INSERT INTO respuesta (respuesta, correcta, pregunta)
VALUES
    ('4', true, 5),
    ('3', false, 5),
    ('5', false, 5),
    ('6', false, 5);
INSERT INTO respuesta (respuesta, correcta, pregunta)
VALUES
    ('12', true, 6),
    ('8', false, 6),
    ('16', false, 6),
    ('6', false, 6);
INSERT INTO respuesta (respuesta, correcta, pregunta)
VALUES
    ('4', true, 7),
    ('3', false, 7),
    ('5', false, 7),
    ('6', false, 7);
INSERT INTO respuesta (respuesta, correcta, pregunta)
VALUES
    ('Amazonas', true, 8),
    ('Nilo', false, 8),
    ('Misisipi', false, 8),
    ('Yangtsé', false, 8);
INSERT INTO respuesta (respuesta, correcta, pregunta)
VALUES
    ('Oceanía', true, 9),
    ('Europa', false, 9),
    ('América', false, 9),
    ('Asia', false, 9);
INSERT INTO respuesta (respuesta, correcta, pregunta)
VALUES
    ('Tokio', true, 10),
    ('Pekín', false, 10),
    ('Seúl', false, 10),
    ('Bangkok', false, 10);
INSERT INTO respuesta (respuesta, correcta, pregunta)
VALUES
    ('Oxígeno', true, 11),
    ('Carbono', false, 11),
    ('Hidrógeno', false, 11),
    ('Nitrógeno', false, 11);
INSERT INTO respuesta (respuesta, correcta, pregunta)
VALUES
    ('Alexander Fleming', true, 12),
    ('Albert Einstein', false, 12),
    ('Marie Curie', false, 12),
    ('Isaac Newton', false, 12);
INSERT INTO respuesta (respuesta, correcta, pregunta)
VALUES
    ('299,792,458 metros por segundo', true, 13),
    ('300,000,000 metros por segundo', false, 13),
    ('200,000,000 metros por segundo', false, 13),
    ('400,000,000 metros por segundo', false, 13);
INSERT INTO respuesta (respuesta, correcta, pregunta)
VALUES
    ('1492', true, 14),
    ('1501', false, 14),
    ('1510', false, 14),
    ('1485', false, 14);
INSERT INTO respuesta (respuesta, correcta, pregunta)
VALUES
    ('Vespasiano', true, 15),
    ('Nerón', false, 15),
    ('Augusto', false, 15),
    ('Trajano', false, 15);
INSERT INTO respuesta (respuesta, correcta, pregunta)
VALUES
    ('Tratado de Versalles', true, 16),
    ('Tratado de París', false, 16),
    ('Tratado de Londres', false, 16),
    ('Tratado de Viena', false, 16);
INSERT INTO respuesta (respuesta, correcta, pregunta)
VALUES
    ('Gabriel García Márquez', true, 17),
    ('Pablo Neruda', false, 17),
    ('Jorge Luis Borges', false, 17),
    ('Mario Vargas Llosa', false, 17);
INSERT INTO respuesta (respuesta, correcta, pregunta)
VALUES
    ('Piano', true, 18),
    ('Violín', false, 18),
    ('Flauta', false, 18),
    ('Guitarra', false, 18);
INSERT INTO respuesta (respuesta, correcta, pregunta)
VALUES
    ('Japón', true, 19),
    ('China', false, 19),
    ('Corea del Sur', false, 19),
    ('Tailandia', false, 19);
INSERT INTO pregunta (categoria, pregunta, estado, nivel, veces_entregada, hits, fechaRealizado)
VALUES
    ('Ciencia', '¿Cuál es la unidad de medida de la temperatura?', 'Activa', 'Intermedio', 0, 0, NOW());
INSERT INTO respuesta (respuesta, correcta, pregunta)
VALUES
    ('Grado Celsius', true, 20),
    ('Grado Fahrenheit', false, 20),
    ('Kelvin', false, 20),
    ('Grado Réaumur', false, 20);
INSERT INTO pregunta (categoria, pregunta, estado, nivel, veces_entregada, hits, fechaRealizado)
VALUES
    ('Geografía', '¿Cuál es el río más largo del mundo?', 'Activa', 'Intermedio', 0, 0, NOW());
INSERT INTO respuesta (respuesta, correcta, pregunta)
VALUES
    ('Río Amazonas', true, 21),
    ('Río Nilo', false, 21),
    ('Río Yangtsé', false, 21),
    ('Río Misisipi-Misuri', false, 21);
INSERT INTO pregunta (categoria, pregunta, estado, nivel, veces_entregada, hits, fechaRealizado)
VALUES
    ('Arte', '¿Quién pintó la Mona Lisa?', 'Activa', 'Intermedio', 0, 0, NOW());
INSERT INTO respuesta (respuesta, correcta, pregunta)
VALUES
    ('Leonardo da Vinci', true, 22),
    ('Pablo Picasso', false, 22),
    ('Vincent van Gogh', false, 22),
    ('Michelangelo Buonarroti', false, 22);
INSERT INTO pregunta (categoria, pregunta, estado, nivel, veces_entregada, hits, fechaRealizado)
VALUES
    ('Deportes', '¿En qué deporte se utiliza una raqueta?', 'Activa', 'Intermedio', 0, 0, NOW());
INSERT INTO respuesta (respuesta, correcta, pregunta)
VALUES
    ('Tenis', true, 23),
    ('Fútbol', false, 23),
    ('Baloncesto', false, 23),
    ('Golf', false, 23);
INSERT INTO pregunta (categoria, pregunta, estado, nivel, veces_entregada, hits, fechaRealizado)
VALUES
    ('Ciencia', '¿Qué elemento químico tiene el símbolo H?', 'Activa', 'Intermedio', 0, 0, NOW());
INSERT INTO respuesta (respuesta, correcta, pregunta)
VALUES
    ('Hidrógeno', true, 24),
    ('Helio', false, 24),
    ('Hierro', false, 24),
    ('Plata', false, 24);
INSERT INTO pregunta (categoria, pregunta, estado, nivel, veces_entregada, hits, fechaRealizado)
VALUES
    ('Cultura General', '¿Cuál es el país más grande del mundo por territorio?', 'Activa', 'Intermedio', 0, 0, NOW());
INSERT INTO respuesta (respuesta, correcta, pregunta)
VALUES
    ('Rusia', true, 25),
    ('Canadá', false, 25),
    ('China', false, 25),
    ('Estados Unidos', false, 25);
INSERT INTO pregunta (categoria, pregunta, estado, nivel, veces_entregada, hits, fechaRealizado)
VALUES
    ('Historia', '¿En qué año se firmó la Declaración de Independencia de los Estados Unidos?', 'Activa', 'Dificil', 0, 0, NOW());
INSERT INTO respuesta (respuesta, correcta, pregunta)
VALUES
    ('1776', true, 26),
    ('1789', false, 26),
    ('1812', false, 26),
    ('1865', false, 26);
INSERT INTO pregunta (categoria, pregunta, estado, nivel, veces_entregada, hits, fechaRealizado)
VALUES
    ('Geografía', '¿En qué continente se encuentra el desierto del Sahara?', 'Activa', 'Facil', 0, 0, NOW());
INSERT INTO respuesta (respuesta, correcta, pregunta)
VALUES
    ('África', true, 27),
    ('Asia', false, 27),
    ('América del Sur', false, 27),
    ('Australia', false, 27);
INSERT INTO pregunta (categoria, pregunta, estado, nivel, veces_entregada, hits, fechaRealizado)
VALUES
    ('Arte', '¿Quién escribió la obra "Don Quijote de la Mancha"?', 'Activa', 'Facil', 0, 0, NOW());
INSERT INTO respuesta (respuesta, correcta, pregunta)
VALUES
    ('Miguel de Cervantes', true, 28),
    ('William Shakespeare', false, 28),
    ('Gabriel García Márquez', false, 28),
    ('Pablo Neruda', false, 28);
INSERT INTO pregunta (categoria, pregunta, estado, nivel, veces_entregada, hits, fechaRealizado)
VALUES
    ('Deportes', '¿En qué deporte se utiliza un octógono como forma del área de competición?', 'Activa', 'Dificil', 0, 0, NOW());
INSERT INTO respuesta (respuesta, correcta, pregunta)
VALUES
    ('Artes marciales mixtas (MMA)', true, 29),
    ('Boxeo', false, 29),
    ('Fútbol americano', false, 29),
    ('Tenis de mesa', false, 29);
INSERT INTO pregunta (categoria, pregunta, estado, nivel, veces_entregada, hits, fechaRealizado)
VALUES
    ('Ciencia', '¿Cuál es el hueso más largo del cuerpo humano?', 'Activa', 'Intermedio', 0, 0, NOW());
INSERT INTO respuesta (respuesta, correcta, pregunta)
VALUES
    ('Fémur', true, 30),
    ('Húmero', false, 30),
    ('Tibia', false, 30),
    ('Fíbula', false, 30);