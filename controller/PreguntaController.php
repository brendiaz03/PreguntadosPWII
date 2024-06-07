<?php

class PreguntaController
{
    private $model;
    private $presenter;

    public function __construct($model, $presenter)
    {
        $this->model = $model;
        $this->presenter = $presenter;
    }

    public function get()
    {
        $this->presenter->render("view/home.mustache");
    }

    public function vistaregistrar()
    {
        $this->presenter->render("view/registro.mustache");
    }

    public function partida(){
        $textoNav = "PARTIDA";
        $usuario = $_SESSION['usuario']["id"];
        $pregunta = $this -> model -> getPreguntas($_SESSION['usuario']["id"], $_SESSION['usuario']["nivel"]);
        $respuestas = $this -> model -> getRespuestasByPregunta($pregunta[0]['id']);

        $this -> presenter -> render("view/partida.mustache", ["textoNav" => $textoNav, "usuario" => $usuario, "pregunta"=> $pregunta, "respuestas"=> $respuestas]);
    }

    public function terminarPartida(){
        $textoNav = "PARTIDA";
        $respuestaCorrecta = $this -> model -> verificarRespuestaCorrecta($_POST["idPregunta"], $_POST['idRespuesta']);
        if($respuestaCorrecta){
            $resultado = "Respuesta correcta";
            $respondioBien = 1;
        }else{
            $resultado = "Respuesta incorrecta";
            $respondioBien = 0;
        }
        $usuarioId = $_SESSION['usuario']['id'];
        $this -> model-> guardarPartida($usuarioId, $_POST["idPregunta"], $respondioBien);
        $this -> presenter -> render("view/resultado.mustache", ["textoNav" => $textoNav, "usuarioId" => $usuarioId, "resultado"=> $resultado]);
    }

}

?>
