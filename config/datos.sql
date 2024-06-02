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
    foto BIT,
    password varchar(30),
    nombreUsuario varchar(30),
    tipoUsuario varchar(20),
    puntaje int

);

CREATE TABLE pregunta(
     id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
     categoria VARCHAR(50),
     pregunta VARCHAR(200),
     estado VARCHAR(50),
     fechaRealizado datetime
);

CREATE TABLE respuesta(
      id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
      respuestaCorrecta VARCHAR(200),
      respuestaIncorrecta1 VARCHAR(200),
      respuestaIncorrecta2 VARCHAR(200),
      respuestaIncorrecta3 VARCHAR(200),
      pregunta INTEGER,
      FOREIGN KEY(pregunta) REFERENCES pregunta(id)
);

CREATE TABLE partida(
    id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
    idPregunta INTEGER,
    idUsuario INTEGER,
    fechaRealizado DATETIME,
    FOREIGN KEY(idPregunta) REFERENCES pregunta(id),
    FOREIGN KEY(idUsuario) REFERENCES usuario(id)
);