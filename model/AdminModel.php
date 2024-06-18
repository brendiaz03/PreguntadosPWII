<?php
    class AdminModel
    {

        private $database;

        public function __construct($database)
        {
            $this->database = $database;
        }

        public function agregarPregunta($categoria, $pregunta, $rtaCorrecta, $opcion2, $opcion3, $opcion4){
            $insertPregunta = "INSERT INTO pregunta (`categoria`, `pregunta`, `estado`, `nivel`, `veces_entregada`, `hits`, `fechaRealizado`) VALUES ('$categoria', '$pregunta', 'Inactiva', null ,0 , 0, NOW())";
            $this -> database -> execute($insertPregunta);
            $preguntaId = mysqli_insert_id($this -> database -> getConnection());

            $insertRespuestas= "INSERT INTO respuesta (`respuesta`, `correcta`, `pregunta`) VALUES ('$rtaCorrecta', true, '$preguntaId'), ('$opcion2', false, '$preguntaId'), ('$opcion3', false, '$preguntaId'), ('$opcion4', false, '$preguntaId')";
            $this -> database -> execute($insertRespuestas);
        }

        public function editarPregunta($idPregunta, $categoria, $pregunta, $rtaCorrecta, $opcion2, $opcion3, $opcion4){
            $updatePregunta = "UPDATE pregunta SET `categoria` = '$categoria', `pregunta` = '$pregunta', `fechaRealizado` = NOW() WHERE `id` = '$idPregunta'";
            $this -> database -> execute($updatePregunta);

            $selectRespuestas = "SELECT idrespuesta FROM respuesta WHERE pregunta = '$idPregunta'";
            $respuestas = $this -> database -> query($selectRespuestas);
            $respuestaIds = array_column($respuestas, 'idrespuesta');
            $updateRespuestas = [
                "UPDATE respuesta SET `respuesta` = '$rtaCorrecta', `correcta` = 1 WHERE `idrespuesta` = '{$respuestaIds[0]}'",
                "UPDATE respuesta SET `respuesta` = '$opcion2', `correcta` = 0 WHERE `idrespuesta` = '{$respuestaIds[1]}'",
                "UPDATE respuesta SET `respuesta` = '$opcion3', `correcta` = 0 WHERE `idrespuesta` = '{$respuestaIds[2]}'",
                "UPDATE respuesta SET `respuesta` = '$opcion4', `correcta` = 0 WHERE `idrespuesta` = '{$respuestaIds[3]}'"
            ];

            foreach ($updateRespuestas as $updateQuery) {
                $this -> database -> execute($updateQuery);
            }
        }

        public function eliminarPregunta($idPregunta){
            try {
                $selectPregunta = "SELECT 1 FROM pregunta WHERE id = '$idPregunta' LIMIT 1";
                $pregunta = $this -> database -> query($selectPregunta);

                if(count($pregunta) == 1){
                    $deleteRespuestas = "DELETE FROM respuesta WHERE pregunta = '$idPregunta'";
                    $this -> database -> execute($deleteRespuestas);

                    $deletePregunta = "DELETE FROM pregunta WHERE id = '$idPregunta'";
                    $this -> database -> execute($deletePregunta);
                }
            } catch (Exception $e) {
                $this->database->rollback();
            }
        }

        public function cambiarEstadoPregunta($idPregunta){
            $query = "SELECT estado FROM pregunta WHERE id = '$idPregunta' LIMIT 1";
            $result = $this->database->query($query);

            if($result[0]['estado'] == 'Inactiva'){
                $this -> database -> execute("UPDATE pregunta SET estado = 'Activa' WHERE id = '$idPregunta'");
            }else {
                $this -> database -> execute("UPDATE pregunta SET estado = 'Inactiva' WHERE id = '$idPregunta'");
            }
        }

        public function obtenerPreguntaConRespuestas($idPregunta) {
            $sqlPregunta = "SELECT * FROM pregunta WHERE id = '$idPregunta'";
            $pregunta = $this->database->query($sqlPregunta);

            $sqlRespuestas = "SELECT respuesta FROM respuesta WHERE pregunta = '$idPregunta'";
            $respuestas = $this->database->query($sqlRespuestas);

            return [
                'pregunta' => $pregunta[0],
                'correcta' => $respuestas[0]['respuesta'],
                'opcion2' => $respuestas[1]['respuesta'],
                'opcion3' => $respuestas[2]['respuesta'],
                'opcion4' => $respuestas[3]['respuesta'],
            ];
        }

        public function getPreguntasEditor()
        {
            $sql = "SELECT * FROM pregunta";
            return $this->database->query($sql);
        }
    }
?>
