<?php
    class PreguntaModel {
        private $database;

        public function __construct($database)
        {
            $this -> database = $database;
        }

        public function getRespuestaByIdPregunta($preguntaID){
            $sqlDos = "SELECT *
FROM respuesta AS r
WHERE r.pregunta = '$preguntaID'
LIMIT 1";
            return $this->database->query($sqlDos);
        }

        public function getPreguntaByNivel($idUsuario, $nivel){
            $sql = "SELECT *
FROM pregunta AS p
WHERE p.nivel = '$nivel'
AND p.id NOT IN (
    SELECT idPregunta
    FROM partida
    WHERE idUsuario = $idUsuario)
LIMIT 1";
            return $this->database->query($sql);
        }

        public function getUsuarioById($idUsuario){
            $sql = "SELECT * FROM usuario WHERE id = '$idUsuario' LIMIT 1";
            return $this->database->query($sql);
        }

    public function getRespuestaCorrectaById($idRespuesta){
        $sql = "SELECT respuestaCorrecta FROM respuesta WHERE id = '$idRespuesta' LIMIT 1";
        return $this->database->query($sql);
    }

        public function sumarPuntajeAUsuario($idUsuario){
            return $this -> database -> execute("UPDATE Usuario
SET puntaje = puntaje + 1
WHERE id = '$idUsuario'");
        }
        public function guardarPartida($idUsuario, $idPregunta, $correcto){
            if($correcto){
                $this->sumarPuntajeAUsuario($idUsuario);
            }
            $fecha_actual = date('Y-m-d H:i:s');
            return $this -> database -> execute("INSERT INTO partida (idPregunta, idUsuario, correcta, fechaRealizado) VALUES ($idPregunta, $idUsuario, $correcto, '$fecha_actual')");
        }
    }
?>
