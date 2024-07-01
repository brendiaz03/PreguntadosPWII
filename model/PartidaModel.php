<?php

class PartidaModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function iniciarPartidaConUsuario($idUsuario){
        $fecha_actual = date('Y-m-d H:i:s');
        $this->database->execute("INSERT INTO partida (idUsuario, fechaRealizado) VALUES ('$idUsuario', '$fecha_actual');");
    }

    public function getIdPartida($idUsuario){
        $this->iniciarPartidaConUsuario($idUsuario);
        $sql = "SELECT id FROM partida ORDER BY id DESC LIMIT 1;";
        $resultado= $this->database->query($sql);
        return $resultado[0]['id'];
    }

    public function getRespuestasByPregunta($preguntaID)
    {
        $sql = "SELECT * FROM respuesta AS r WHERE r.pregunta = '$preguntaID' ORDER BY RAND()";
        return $this->database->query($sql);
    }

    public function getPreguntaSinNivel($idUsuario)
    {
        $sql = "SELECT * FROM pregunta AS p
WHERE estado = 'Activa'
AND p.id NOT IN (
    SELECT pp.idPregunta 
    FROM partida_pregunta AS pp
    JOIN partida AS pa ON pp.idPartida = pa.id
    WHERE pa.idUsuario = '$idUsuario'
)
LIMIT 1";
        $result= $this->database->query($sql);
        return $result;
    }

    public function getPreguntaConNivel($idUsuario, $nivel)
    {
        $sql = "SELECT * FROM pregunta AS p
            WHERE p.nivel = '$nivel' and estado = 'Activa'
            AND p.id NOT IN (
                SELECT pp.idPregunta 
                FROM partida_pregunta AS pp
                JOIN partida AS pa ON pp.idPartida = pa.id
                WHERE pa.idUsuario = '$idUsuario'
            )
            LIMIT 1";
        return $this->database->query($sql);
    }

    public function getPreguntaParaUsuario($idUsuario)
    {
        $usuario = $this->getUsuarioById($idUsuario);
        $nivel = $usuario['nivel'];
        if($usuario['nivel'] !== null) {
            $result = $this->getPreguntaConNivel($idUsuario, $nivel);
            if ($result == null) {
                $sqlRandom = "SELECT * FROM pregunta WHERE estado = 'Activa' AND nivel = '$nivel' ORDER BY RAND() LIMIT 1";
                return $this->database->query($sqlRandom);
            }
        }else{
            $result = $this->getPreguntaSinNivel($idUsuario);
            if ($result == null) {
                $sqlRandom = "SELECT * FROM pregunta WHERE estado = 'Activa' ORDER BY RAND() LIMIT 1";
                return $this->database->query($sqlRandom);
            }
    }
        return $result[0];
    }

    public function guardarPreguntaDePartida($idUsuario, $idPartida,$idPregunta, $idRespuesta)
    {
        $this->marcarEntregaEnLaPregunta($idPregunta);
        if (empty($idRespuesta)) {
            $correcta = 0;
        } else {
            $correcta = $this->verificarRespuestaCorrecta($idPregunta ,$idRespuesta);
        }
        if ($correcta) {
            $this->sumarPuntajeAUsuario($idUsuario);
            $this->marcarHitEnLaPregunta($idPregunta);
        }
        $fecha_actual = date('Y-m-d H:i:s');
        $this->database->execute("INSERT INTO partida_pregunta (idPartida, idPregunta, fechaRealizado, correcta) VALUES ('$idPartida', '$idPregunta', '$fecha_actual', '$correcta')");
        $partidasTotalesPregunta = $this->partidasTotalesPorPregunta($idPregunta);
        if ($partidasTotalesPregunta >= 10) {
            $this->nivelarPregunta($idPregunta);
        }
        $partidasTotalesUsuario = $this->partidasTotalesPorUsuario($idUsuario);
        if ($partidasTotalesUsuario >= 10) {
            $this->nivelarUsuario($idUsuario);
        }
        return $correcta;
    }

    public function verificarRespuestaCorrecta($idPregunta, $idRespuesta)
    {
        $sql = "SELECT correcta FROM respuesta WHERE id = '$idRespuesta' AND pregunta = '$idPregunta'";
        $result = $this->database->query($sql);
        if ($result[0]['correcta'] == 1) {
            return 1;
        } else {
            return 0;
        }
    }

    private function sumarPuntajeAUsuario($idUsuario)
    {
        return $this->database->execute("UPDATE Usuario SET puntaje = puntaje + 1 WHERE id = '$idUsuario'");
    }

    public function getUsuarioById($idUsuario)
    {
        $sql = "SELECT * FROM usuario WHERE id = '$idUsuario' LIMIT 1";
        $result = $this->database->query($sql);
        return $result[0];
    }

    public function nivelarUsuario($idUsuario)
    {
        $sql = " SELECT SUM(CASE WHEN pp.correcta = 1 THEN 1 ELSE 0 END) AS correctas
        FROM partida p
        INNER JOIN partida_pregunta pp ON p.id = pp.idPartida
        WHERE p.idUsuario = '$idUsuario'
        ORDER BY p.id DESC
        LIMIT 10";

        $result = $this->database->query($sql);
        if (count($result) > 0) {
            $correctas = $result[0]['correctas'];
            $nivel = 'Facil';

            if ($correctas >= 7) {
                $nivel = 'Dificil';
            } else if ($correctas >= 4) {
                $nivel = 'Intermedio';
            }

            $sqlUpdate = "UPDATE usuario SET nivel = '$nivel' WHERE id = '$idUsuario'";
            $this->database->execute($sqlUpdate);
        }
    }

    public function nivelarPregunta($idPregunta)
    {
        $porcentajeHits = $this->obtenerPorcentajeDeHits($idPregunta);
        $porcentajeFinal = $porcentajeHits;
        $nivel = 'Dificil';

        if ($porcentajeFinal > '66.6') {
            $nivel = 'Facil';
        } else if ($porcentajeFinal > 33.3 and $porcentajeFinal <= 66.6) {
            $nivel = 'Intermedio';
        }

        $sqlUpdate = "UPDATE pregunta SET nivel = '$nivel' WHERE id = '$idPregunta'";
        $this->database->execute($sqlUpdate);
    }

    private function obtenerPorcentajeDeHits($idPregunta)
    {
        $sql = "
        SELECT 
            CASE 
                WHEN veces_entregada IS NULL OR veces_entregada < 10 THEN NULL
                ELSE (COALESCE(hits, 0) / veces_entregada) * 100 
            END AS porcentajeHits 
        FROM pregunta 
        WHERE id = '$idPregunta'
    ";

        $result = $this->database->query($sql);
        if (count($result) > 0) {
            return $result[0]['porcentajeHits'];
        } else {
            return 0;
        }
    }

    public function partidasTotalesPorUsuario($idUsuario)
    {
        $sql = " SELECT COUNT(*) AS preguntasTotales
        FROM partida_pregunta pp
        JOIN partida p ON pp.idPartida = p.id
        WHERE p.idUsuario = '$idUsuario'";
        $result= $this->database->query($sql);
        return $result[0]['preguntasTotales'];
    }

    public function partidasTotalesPorPregunta($idPregunta)
    {
        $sql = "SELECT veces_entregada FROM pregunta WHERE id = '$idPregunta'";
        $result= $this->database->query($sql);
        return $result[0]['veces_entregada'];
    }

    public function marcarHitEnLaPregunta($idPregunta)
    {
        $sql = "UPDATE pregunta SET hits = hits + 1 WHERE id = '$idPregunta'";
        $this->database->execute($sql);
    }

    public function marcarEntregaEnLaPregunta($idPregunta)
    {
        $sql = "UPDATE pregunta SET veces_entregada = veces_entregada + 1 WHERE id = '$idPregunta'";
        $this->database->execute($sql);
    }

    public function colorDeCategoria($categoria){
        $sql = "SELECT color FROM categoria_color WHERE categoria = '$categoria'";
        $result= $this->database->query($sql);
        return $result[0]['color'];
    }

    public function reportarPreguntaPorId($idPregunta){
        $sql = "UPDATE pregunta SET estado = 'Reportada' WHERE id = '$idPregunta'";
        $this->database->execute($sql);
    }

}

?>
