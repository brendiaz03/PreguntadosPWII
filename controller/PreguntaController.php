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
        date_default_timezone_set('America/Buenos_Aires');
        $textoNav = "PARTIDA";
        if(!isset($_SESSION["pregunta"]) || $_SESSION["pregunta"] === null || !isset($_SESSION["respuestas"]) || $_SESSION["respuestas"] === null){
            $usuario = $this -> model -> getUsuarioById($_SESSION["id"]);
            $pregunta = $this -> model -> getPreguntas($usuario['id'], $usuario['nivel']);
            $respuestas = $this -> model -> getRespuestasByPregunta($pregunta[0]['id']);
            $_SESSION["pregunta"] = $pregunta[0];
            $_SESSION["respuestas"] = $respuestas;
            $_SESSION["tiempoInicio"] = time();
            $tiempoInicio = $_SESSION["tiempoInicio"];
        }
        $this -> presenter -> render("view/partida.mustache", ["textoNav" => $textoNav, "pregunta"=>  $_SESSION["pregunta"], "respuestas"=> $_SESSION["respuestas"], "logeado"=>true, "tiempoInicio" => $tiempoInicio]);
    }

//    public function partida(){
//        $textoNav = "PARTIDA";
//        $usuario = $this -> model -> getUsuarioById($_SESSION["id"]);
//
//        if($usuario['nivel'] != null){
//            $pregunta = $this -> model -> getPreguntaByNivel($usuario['id'], $usuario['nivel']);
//        }else {
//            $pregunta = $this -> model -> getPreguntas($usuario['id']);
//        }
//
//        $respuestas = $this -> model -> getRespuestasByPregunta($pregunta[0]['id']);
//
//        $this -> presenter -> render("view/partida.mustache", ["textoNav" => $textoNav, "pregunta"=> $pregunta, "respuestas"=> $respuestas, "logeado"=>true, "foto" => $usuario['foto']]);
//    }

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


//    public function terminarPartida(){
//        $textoNav = "RESULTADO";
//        $usuarioId = $_SESSION["id"];
//        $preguntaId = $_POST['idPregunta'];
//        $usuario = $this -> model -> getUsuarioById($usuarioId);
//        $respuestaCorrecta = $this -> model -> verificarRespuestaCorrecta($preguntaId, $_POST['idRespuesta']);
//
//        if($respuestaCorrecta){
//            $resultado = "Respuesta correcta";
//            $respondioBien = 1;
//            $this -> model -> marcarHitEnLaPregunta($preguntaId);
//            $this -> model -> marcarEntregaEnLaPregunta($preguntaId);
//        }else{
//            $resultado = "Respuesta incorrecta";
//            $respondioBien = 0;
//            $this -> model -> marcarEntregaEnLaPregunta($preguntaId);
//        }
//        $partidasTotalesUsuario = $this -> model -> partidasTotalesPorUsuario($usuarioId);
//        $partidasTotalesPregunta = $this -> model -> partidasTotalesPorPregunta($preguntaId);
//
//        $this -> model-> guardarPartida($usuarioId, $preguntaId, $respondioBien);
//
//        if($partidasTotalesUsuario[0]['partidasTotales'] == 10){
//            $this -> model -> nivelarUsuario($usuarioId);
//        }
//        if($partidasTotalesPregunta[0] >= 10){
//            $this -> model -> nivelarPregunta($preguntaId);
//        }
//        $this -> presenter -> render("view/resultado.mustache", ["textoNav" => $textoNav, "usuarioId" => $usuarioId, "resultado"=> $resultado, "logeado"=>true, "foto" => $usuario['foto']]);
//    }

}

?>
