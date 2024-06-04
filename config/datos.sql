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