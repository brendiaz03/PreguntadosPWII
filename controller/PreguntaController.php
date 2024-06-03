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
        $this -> model -> getPartida($_POST["id"], $_POST["nivel"]);
        $this -> presenter -> render("view/partida.mustache", ["textoNav" => $textoNav, "usuario" => $_SESSION['usuario'], "pregunta"=> $_SESSION['pregunta'], "respuestas"=> $_SESSION['respuestas']]);
    }

    public function terminarPartida(){
        $textoNav = "PARTIDA";
       $this -> model -> getRespuestaCorrectaById($_POST["idRespuesta"]);
        if($_POST["respuesta"] ==  $_SESSION['respuestaCorrecta']['respuestaCorrecta']){
            $resultado = "Respuesta correcta";
            $correcta = 1;
            }else{
            $resultado = "Respuesta incorrecta";
            $correcta = 0;
        }
        $this -> model -> getUsuarioById($_POST["idUsuario"]);
        $this -> model-> guardarPartida($_POST["idUsuario"],$_POST["idPregunta"], $correcta);
        $this -> presenter -> render("view/resultado.mustache", ["textoNav" => $textoNav, "usuario" => $_SESSION['usuario'], "resultado"=> $resultado]);
    }

}

?>
