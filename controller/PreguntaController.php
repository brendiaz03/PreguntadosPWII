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
        $usuario = $this -> model -> getUsuarioById($_POST["id"]);
        $pregunta = $this -> model -> getPreguntaByNivel($_POST["id"], $_POST["nivel"]);
        $respuesta = $this -> model -> getRespuestaByIdPregunta($pregunta[0]['id']);
        $this -> presenter -> render("view/partida.mustache", ["textoNav" => $textoNav, "usuario" => $usuario, "pregunta"=> $pregunta, "respuestas"=> $respuesta]);
    }

    public function terminarPartida(){
        $textoNav = "PARTIDA";
       $respuestaCorrecta = $this -> model -> getRespuestaCorrectaById($_POST["idRespuesta"]);
        if($_POST["respuesta"] ==  $respuestaCorrecta[0]['respuestaCorrecta']){
            $resultado = "Respuesta correcta";
            $correcta = 1;
            }else{
            $resultado = "Respuesta incorrecta";
            $correcta = 0;
        }
        $usuario = $this -> model -> getUsuarioById($_POST["idUsuario"]);
        $this -> model-> guardarPartida($_POST["idUsuario"],$_POST["idPregunta"], $correcta);
        $this -> presenter -> render("view/resultado.mustache", ["textoNav" => $textoNav, "usuario" => $usuario, "resultado"=> $resultado]);
    }

}

?>
