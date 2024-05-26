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
                        password varchar(30),
                        nombreUsuario varchar(30),
                        foto LONGBLOB,
                        tipoUsuario varchar(20),
                        puntaje int
);
INSERT into Usuario(nombreCompleto,anioNacimiento,sexo,pais,ciudad,mail,password,nombreUsuario,tipoUsuario,puntaje)
values ('Pepito',1996,'M','Argentina','Buenos Aires','pepito@hotmail.com','123','Pepe','ADMIN',10);




CREATE TABLE Pregunta(
                         id int PRIMARY KEY AUTO_INCREMENT,
                         pregunta varchar(200),
                         categoria varchar(50),
                         respuestaCorrecta varchar(100),
                         respuesIncorrectaUno varchar(100),
                         respuestaIncorrectaDos varchar(100),
                         respuestaIncorrectaTres varchar(100),
                         estado varchar(30),
                         fechaRealizado DATE
);
INSERT into Pregunta(pregunta,categoria,respuestaCorrecta,respuesIncorrectaUno,respuestaIncorrectaDos,respuestaIncorrectaTres,estado)
values ('Usamos PHP y Mustache en este proyecto','Ingenieria','Si','NO','No','no','aprobada');
