<?php

class PartidaController
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

    public function partida()
    {
        $tiempoInicio = microtime(true);
        $textoNav = "PARTIDA";
        if (!isset($_SESSION["pregunta"]) || $_SESSION["pregunta"] === null || !isset($_SESSION["respuestas"]) || $_SESSION["respuestas"] === null) {
            $usuario = $this->model->getUsuarioById($_SESSION["id"]);

            if ($usuario['nivel'] != null) {
                $pregunta = $this->model->getPreguntaByNivel($usuario['id'], $usuario['nivel']);
            } else {
                $pregunta = $this->model->getPreguntas($usuario['id']);
            }
            $respuestas = $this->model->getRespuestasByPregunta($pregunta[0]['id']);
            $_SESSION["pregunta"] = $pregunta[0];
            $_SESSION["respuestas"] = $respuestas;
            $_SESSION["tiempoInicio"] = $tiempoInicio;
        }
        $this->presenter->render("view/partida.mustache", ["textoNav" => $textoNav, "pregunta" => $_SESSION["pregunta"], "respuestas" => $_SESSION["respuestas"], "logeado" => true, "tiempoInicio" => $tiempoInicio]);
    }

    public function terminarPartida()
    {
        if (empty($_POST["idPregunta"])) {
            $respuestaCorrecta = 0;
        } else {
            $idPregunta = $_POST["idPregunta"];
            $idRespuesta = $_POST["idRespuesta"];
            $respuestaCorrecta = $this->model->verificarRespuestaCorrecta( $idPregunta ,$idRespuesta );
        }
        $this->model->guardarPartida($_SESSION["id"], $idPregunta, $respuestaCorrecta);
        $partidasTotalesUsuario = $this->model->partidasTotalesPorUsuario($_SESSION["id"]);
        $partidasTotalesPregunta = $this->model->partidasTotalesPorPregunta($idPregunta);
        if ($partidasTotalesUsuario[0]['partidasTotales'] == 10) {
            $this->model->nivelarUsuario($_SESSION["id"]);
        }
        if ($partidasTotalesPregunta[0] >= 10) {
            $this->model->nivelarPregunta($idPregunta);
        }
        $_SESSION["pregunta"] = null;
        $_SESSION["respuestas"] = null;
        if ($respuestaCorrecta) {
            $this->model->marcarHitEnLaPregunta($idPregunta);
            $this->model->marcarEntregaEnLaPregunta($idPregunta);
            header("Location: /preguntados/partida");
        } else {
            $this->model->marcarEntregaEnLaPregunta($_SESSION["pregunta"]['id']);
            header("Location: /usuario/lobby");
        }
    }

    public function reportarPregunta(){
        $this->model-> reportarPreguntaPorId($_POST["idPregunta"]);
        $_SESSION["pregunta"] = null;
        $_SESSION["respuestas"] = null;
        header("Location: /usuario/lobby");
    }

}

?>
