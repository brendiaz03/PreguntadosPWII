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
     estado VARCHAR(50), -- activa, reportada, sugerida
     nivel VARCHAR(50),
     fechaRealizado datetime
);

CREATE TABLE respuesta(
      idrespuesta INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
      respuesta VARCHAR(200),
      correcta bool,
      pregunta INTEGER,
      FOREIGN KEY(pregunta) REFERENCES pregunta(id)
);

CREATE TABLE partida(
    id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
    idPregunta INTEGER,
    idUsuario INTEGER,
    correcta BOOLEAN,
    fechaRealizado DATETIME,
    FOREIGN KEY(idPregunta) REFERENCES pregunta(id),
    FOREIGN KEY(idUsuario) REFERENCES usuario(id)
);

-- Preguntas con dificultad baja
INSERT INTO pregunta (categoria, pregunta, estado, nivel, fechaRealizado)
VALUES ('Historia', '¿En qué año fue la independencia de Argentina?', 'Activa', 'Baja', NOW()),
       ('Geografía', '¿Cuál es la capital de Francia?', 'Activa', 'Baja', NOW()),
       ('Ciencia', '¿Cuál es el símbolo químico del agua?', 'Activa', 'Baja', NOW()),
       ('Arte', '¿Quién pintó la Mona Lisa?', 'Activa', 'Baja', NOW()),
       ('Entretenimiento', '¿En qué película aparece el personaje de Harry Potter?', 'Activa', 'Baja', NOW());

-- Respuestas para las preguntas con dificultad baja
INSERT INTO respuesta (respuesta, correcta, pregunta)
VALUES ('1816', true, 1),
       ('1810', false, 1),
       ('1820', false, 1),
       ('París', true, 2),
       ('Londres', false, 2),
       ('Madrid', false, 2),
       ('H2O', true, 3),
       ('CO2', false, 3),
       ('NaCl', false, 3),
       ('Leonardo da Vinci', true, 4),
       ('Vincent van Gogh', false, 4),
       ('Pablo Picasso', false, 4),
       ('La piedra filosofal', true, 5),
       ('El prisionero de Azkaban', false, 5),
       ('El cáliz de fuego', false, 5);

-- Preguntas con dificultad media
INSERT INTO pregunta (categoria, pregunta, estado, nivel, fechaRealizado)
VALUES ('Historia', '¿En qué año comenzó la Segunda Guerra Mundial?', 'Activa', 'Media', NOW()),
       ('Geografía', '¿Cuál es el río más largo del mundo?', 'Activa', 'Media', NOW()),
       ('Ciencia', '¿Qué planeta es conocido como "el planeta rojo"?', 'Activa', 'Media', NOW()),
       ('Arte', '¿Quién escribió la obra "Romeo y Julieta"?', 'Activa', 'Media', NOW()),
       ('Entretenimiento', '¿Cuál es el nombre del actor que interpretó a Batman en "El caballero de la noche"?', 'Activa', 'Media', NOW());

-- Respuestas para las preguntas con dificultad media
INSERT INTO respuesta (respuesta, correcta, pregunta)
VALUES ('1939', true, 6),
       ('1941', false, 6),
       ('1935', false, 6),
       ('Amazonas', true, 7),
       ('Nilo', false, 7),
       ('Mississippi', false, 7),
       ('Marte', true, 8),
       ('Venus', false, 8),
       ('Mercurio', false, 8),
       ('William Shakespeare', true, 9),
       ('Miguel de Cervantes', false, 9),
       ('John Milton', false, 9),
       ('Christian Bale', true, 10),
       ('Robert Downey Jr.', false, 10),
       ('Hugh Jackman', false, 10);

-- Preguntas con dificultad alta
INSERT INTO pregunta (categoria, pregunta, estado, nivel, fechaRealizado)
VALUES ('Historia', '¿Quién fue el primer presidente de Estados Unidos?', 'Activa', 'Alta', NOW()),
       ('Geografía', '¿En qué país se encuentra el desierto del Sahara?', 'Activa', 'Alta', NOW()),
       ('Ciencia', '¿Cuál es la velocidad de la luz en el vacío?', 'Activa', 'Alta', NOW()),
       ('Arte', '¿En qué período artístico se desarrolló el Renacimiento?', 'Activa', 'Alta', NOW()),
       ('Entretenimiento', '¿Cuál es el título de la primera película de la saga "Star Wars"?', 'Activa', 'Alta', NOW());

-- Respuestas para las preguntas con dificultad alta
INSERT INTO respuesta (respuesta, correcta, pregunta)
VALUES ('George Washington', true, 11),
       ('Thomas Jefferson', false, 11),
       ('Abraham Lincoln', false, 11),
       ('Marruecos', true, 12),
       ('Argelia', false, 12),
       ('Egipto', false, 12),
       ('299,792,458 metros por segundo', true, 13),
       ('199,792,458 metros por segundo', false, 13),
       ('399,792,458 metros por segundo', false, 13),
       ('Renacimiento', true, 14),
       ('Barroco', false, 14),
       ('Románico', false, 14),
       ('Una nueva esperanza', true, 15),
       ('El imperio contraataca', false, 15),
       ('El retorno del Jedi', false, 15);
