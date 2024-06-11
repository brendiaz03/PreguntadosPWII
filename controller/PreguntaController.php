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
        if(!isset($_SESSION["pregunta"]) || $_SESSION["pregunta"] === null || !isset($_SESSION["respuestas"]) || $_SESSION["respuestas"] === null){
            $usuario = $this -> model -> getUsuarioById($_SESSION["id"]);
            $pregunta = $this -> model -> getPreguntas($usuario['id'], $usuario['nivel']);
            $respuestas = $this -> model -> getRespuestasByPregunta($pregunta[0]['id']);
            $_SESSION["pregunta"] = $pregunta[0];
            $_SESSION["respuestas"] = $respuestas;
        }
        $this -> presenter -> render("view/partida.mustache", ["textoNav" => $textoNav, "pregunta"=>  $_SESSION["pregunta"], "respuestas"=> $_SESSION["respuestas"], "logeado"=>true]);
    }

    public function terminarPartida(){
        $respuestaCorrecta = $this -> model -> verificarRespuestaCorrecta($_POST["idPregunta"], $_POST['idRespuesta']);
        $this -> model-> guardarPartida($_SESSION["id"], $_POST["idPregunta"], $respuestaCorrecta);
        $_SESSION["pregunta"] = null;
        $_SESSION["respuestas"] = null;
        if($respuestaCorrecta){
            header("Location: /preguntados/partida");
            exit();
        }else{
            header("Location: /usuario/lobby");
        }
    }


}

?>
