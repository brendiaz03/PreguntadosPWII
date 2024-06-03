<?php
    class PreguntaModel {
        private $database;

        public function __construct($database)
        {
            $this -> database = $database;
        }


        public function getPreguntaByNivel($nivel, $idUsuario){
            $sql = "SELECT *
FROM pregunta AS p
WHERE p.nivel = '$nivel'
AND p.id NOT IN (
    SELECT idPregunta
    FROM partida
    WHERE idUsuario = $idUsuario)
LIMIT 1";
            $pregunta = $this->database->query($sql);
            $_SESSION['pregunta'] = $pregunta[0];
            $preguntaID = $_SESSION['pregunta']['id'];
            $sqlDos = "SELECT *
FROM respuesta AS r
WHERE r.pregunta = '$preguntaID'
LIMIT 1";
            $respuestas = $this->database->query($sqlDos);
            $_SESSION['respuestas'] = $respuestas[0];
        }

        public function getUsuarioById($idUsuario){
            $sql = "SELECT * FROM usuario WHERE id = '$idUsuario' LIMIT 1";
            $result = $this->database->query($sql);
            $_SESSION['usuario'] = $result[0];
        }

    public function getRespuestaCorrectaById($idRespuesta){
        $sql = "SELECT respuestaCorrecta FROM respuesta WHERE id = '$idRespuesta' LIMIT 1";
        $result = $this->database->query($sql);

        $_SESSION['respuestaCorrecta'] = $result[0]; ;
    }


        public function getPartida($idUsuario, $nivel){
            $this->getUsuarioById($idUsuario);
            $this->getPreguntaByNivel($nivel, $idUsuario);
        }

        public function sumarPuntajeAUsuario($idUsuario){
            return $this -> database -> execute("UPDATE Usuario
SET puntaje = puntaje + 1
WHERE id = '$idUsuario'");
        }
        public function guardarPartida($idUsuario, $idPregunta, $correcto){
            if($correcto){
                $this->sumarPuntajeAUsuario($_SESSION['usuario']['id']);
            }
            $fecha_actual = date('Y-m-d H:i:s');
            return $this -> database -> execute("INSERT INTO partida (idPregunta, idUsuario, correcta, fechaRealizado) VALUES ($idPregunta, $idUsuario, $correcto, '$fecha_actual')");
        }
    }
?>
