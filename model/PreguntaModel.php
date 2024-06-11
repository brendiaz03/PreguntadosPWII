<?php
    class PreguntaModel {
        private $database;

        public function __construct($database)
        {
            $this -> database = $database;
        }

        public function getRespuestasByPregunta($preguntaID){
            $sql = "SELECT * FROM respuesta AS r WHERE r.pregunta = '$preguntaID' ORDER BY RAND()";
            return $this->database->query($sql);
        }

        public function getPreguntas($idUsuario){
            $sql = "SELECT * FROM pregunta WHERE estado = 'Activa' AND id NOT IN (
                            SELECT idPregunta FROM partida WHERE idUsuario = $idUsuario) 
                            LIMIT 1";
            return $this -> database -> query($sql);
        }

        public function getPreguntaByNivel($idUsuario, $nivel){
            $sql = "SELECT * FROM pregunta AS p  p.nivel = '$nivel' AND p.id NOT IN (
                            SELECT idPregunta FROM partida WHERE idUsuario = $idUsuario)
                        LIMIT 1";
            return $this->database->query($sql);
        }

        public function verificarRespuestaCorrecta($idPregunta, $idRespuesta){
            $idPregunta = intval($idPregunta);
            $idRespuesta = intval($idRespuesta);
            $sql = "SELECT correcta FROM respuesta WHERE idrespuesta = '$idRespuesta' AND pregunta = '$idPregunta'";
            $result = $this -> database -> queryNotAll($sql);
            $row = mysqli_fetch_assoc($result);
            if(!$row){
                return false;
            }
            return intval($row['correcta']) === 1;
        }

        private function sumarPuntajeAUsuario($idUsuario){
            return $this -> database -> execute("UPDATE Usuario SET puntaje = puntaje + 1 WHERE id = '$idUsuario'");
        }

        public function guardarPartida($idUsuario, $idPregunta, $respondioBien){
            if($respondioBien){
                $this -> sumarPuntajeAUsuario($idUsuario);
            }
            $fecha_actual = date('Y-m-d H:i:s');
            return $this -> database -> execute("INSERT INTO partida (idPregunta, idUsuario, fechaRealizado, correcta) VALUES ('$idPregunta', '$idUsuario', '$fecha_actual', '$respondioBien')");
        }

        public function getUsuarioById($idUsuario)
        {
            $sql = "SELECT * FROM usuario WHERE id = '$idUsuario' LIMIT 1";
            $result = $this->database->query($sql);
            return $result[0];
        }
    }
?>
