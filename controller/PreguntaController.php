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
        $usuario = $this -> model -> getUsuarioById($_SESSION["id"]);

        if($usuario['nivel'] != null){
            $pregunta = $this -> model -> getPreguntaByNivel($usuario['id'], $usuario['nivel']);
        }else {
            $pregunta = $this -> model -> getPreguntas($usuario['id'], $usuario['nivel']);
        }
        $respuestas = $this -> model -> getRespuestasByPregunta($pregunta[0]['id']);

        $this -> presenter -> render("view/partida.mustache", ["textoNav" => $textoNav, "pregunta"=> $pregunta, "respuestas"=> $respuestas, "logeado"=>true, "foto" => $usuario['foto']]);
    }

    public function terminarPartida(){
        $textoNav = "RESULTADO";
        $respuestaCorrecta = $this -> model -> verificarRespuestaCorrecta($_POST["idPregunta"], $_POST['idRespuesta']);
        if($respuestaCorrecta){
            $resultado = "Respuesta correcta";
            $respondioBien = 1;
        }else{
            $resultado = "Respuesta incorrecta";
            $respondioBien = 0;
        }
        $usuarioId = $_SESSION["id"];
        $partidasTotales = $this -> model -> partidasTotalesPorUsuario($usuarioId);

        $this -> model-> guardarPartida($usuarioId, $_POST["idPregunta"], $respondioBien);

        if($partidasTotales[0]['partidasTotales'] == 10){
            $this -> model -> nivelarUsuario($usuarioId);
        }
        $this -> presenter -> render("view/resultado.mustache", ["textoNav" => $textoNav, "usuarioId" => $usuarioId, "resultado"=> $resultado, "logeado"=>true]);
    }



}

?>
