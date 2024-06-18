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

        public function getPreguntasEditor()
        {
            $sql = "SELECT * FROM pregunta";
            return $this->database->query($sql);
        }
    }
?>
