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
            $sql = "SELECT * FROM pregunta WHERE estado = 'Activa' AND nivel = 'Intermedio' AND id NOT IN (
                            SELECT idPregunta FROM partida WHERE idUsuario = $idUsuario) 
                            LIMIT 1";
            return $this -> database -> query($sql);
        }

        public function getPreguntaByNivel($idUsuario, $nivel){
            $sql = "SELECT * FROM pregunta AS p WHERE  (p.nivel = '$nivel' OR p.nivel IS NULL) AND p.id NOT IN (
                            SELECT idPregunta FROM partida WHERE idUsuario = $idUsuario)
                        LIMIT 1";
            return $this->database->query($sql);
        }

        public function verificarRespuestaCorrecta($idPregunta, $idRespuesta){
            $sql = "SELECT correcta FROM respuesta WHERE idrespuesta = '$idRespuesta' AND pregunta = '$idPregunta'";
            $result = $this -> database -> query($sql);
            if ($result[0]['correcta'] == 1) {
                return 1;
            } else {
                return 0;
            }
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
            $porcentajeHits = $this -> obtenerPorcentajeDeHits($idPregunta);
            $porcentajeFinal = $porcentajeHits[0]['porcentajeHits'];
            $nivel = 'Dificil';

            if($porcentajeFinal > '66.6'){
                $nivel = 'Facil';
            }else if($porcentajeFinal > 33.3 AND $porcentajeFinal <= 66.6){
                $nivel = 'Intermedio';
            }

            $sqlUpdate = "UPDATE pregunta SET nivel = '$nivel' WHERE id = '$idPregunta'";
            $this -> database -> execute($sqlUpdate);
        }

        private function obtenerPorcentajeDeHits($idPregunta){
            $sql = "SELECT (hits / veces_entregada) * 100 AS porcentajeHits FROM pregunta 
                            WHERE id = '$idPregunta' AND veces_entregada >= '10'";

            return $this -> database -> query($sql);
        }

        public function partidasTotalesPorUsuario($idUsuario){
            $sql = "SELECT COUNT(*) AS partidasTotales FROM partida WHERE idUsuario = '$idUsuario'";
            return $this->database->query($sql);
        }

        public function partidasTotalesPorPregunta($idPregunta){
            $sql = "SELECT veces_entregada FROM pregunta WHERE id = '$idPregunta'";
            return $this->database->query($sql);
        }

        public function marcarHitEnLaPregunta($idPregunta){
            $sql = "UPDATE pregunta SET hits = hits + 1 WHERE id = '$idPregunta'";
            $this -> database -> execute($sql);
        }

        public function marcarEntregaEnLaPregunta($idPregunta){
            $sql = "UPDATE pregunta SET veces_entregada = veces_entregada + 1 WHERE id = '$idPregunta'";
            $this -> database -> execute($sql);
        }
    }
?>
