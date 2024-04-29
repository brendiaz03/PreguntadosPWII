CREATE DATABASE pokedex;
USE pokedex;
CREATE TABLE pokemon( id bigint not null primary key, nombre varchar(100), tipo varchar(30) );
INSERT INTO Pokemon (id, nombre, tipo) VALUES (1, 'Squirtle', 'Agua'), (2, 'Psyduck', 'Agua'), (3, 'Magikarp', 'Agua'),
                                    (4, 'Charmander', 'Fuego'), (5, 'Growlithe', 'Fuego'), (6, 'Pikachu', 'Eléctrico'),
                                    (7, 'Electabuzz', 'Eléctrico'), (8, 'Geodude', 'Tierra'), (9, 'Sandshrew', 'Tierra'),
                                    (10, 'Bulbasaur', 'Planta'), (11, 'Oddish', 'Planta'), (12, 'Exeggcute', 'Planta'),
                                    (13, 'Chikorita', 'Planta'), (14, 'Treecko', 'Planta'), (15, 'Lotad', 'Planta');
