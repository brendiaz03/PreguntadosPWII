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

        public function nivelarUsuario($idUsuario){
            $sql = "SELECT SUM(CASE WHEN correcta = 1 THEN 1 ELSE 0 END) AS correctas
                    FROM partida WHERE idUsuario = '$idUsuario' ORDER BY id ASC LIMIT 10";

            $result = $this -> database -> query($sql);
            if(count($result) > 0){
                $correctas = $result[0]['correctas'];
                $nivel = 'Facil';

                if($correctas >= 7){
                    $nivel = 'Dificil';
                }else if($correctas >= 4){
                    $nivel = 'Intermedio';
                }

                $sqlUpdate = "UPDATE usuario SET nivel = '$nivel' WHERE id = '$idUsuario'";
                $this -> database -> execute($sqlUpdate);
            }
        }

        public function nivelarPregunta($idPregunta){

        }

        public function partidasTotalesPorUsuario($idUsuario){
            $sql = "SELECT COUNT(*) AS partidasTotales FROM partida WHERE idUsuario = '$idUsuario'";
            return $this->database->query($sql);
        }
    }
?>
