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

    public function iniciarPartida(){
        $_SESSION["pregunta"] = null;
        $_SESSION["respuestas"] = null;
        $_SESSION["tiempoInicio"]=null;
        $_SESSION["idPartida"] =  $this->model->getIdPartida($_SESSION['id']);
        header("Location: /preguntados/partida");
    }
    public function partida()
    {
        $usuario = $this->model->getUsuarioById($_SESSION["id"]);
        if ($usuario['tipoUsuario'] == 'Jugador') {
            $tiempoInicio = microtime(true);
            if (!isset($_SESSION["pregunta"]) || $_SESSION["pregunta"] === null || !isset($_SESSION["respuestas"]) || $_SESSION["respuestas"] === null) {
                $pregunta = $this->model->getPreguntaParaUsuario($_SESSION["id"]);
                $respuestas = $this->model->getRespuestasByPregunta($pregunta[0]['id']);
                $color = $this->model->colorDeCategoria($pregunta[0]['categoria']);
                $_SESSION["pregunta"] = $pregunta[0];
                $_SESSION["respuestas"] = $respuestas;
                $_SESSION["tiempoInicio"] = $tiempoInicio;
                $_SESSION["color"] = $color;
            }
            $this->presenter->render("view/partida.mustache", ["textoNav" => "PARTIDA", "pregunta" => $_SESSION["pregunta"], "respuestas" => $_SESSION["respuestas"],
                "logeado" => true, "tiempoInicio" =>$_SESSION["tiempoInicio"], "color" => $_SESSION["color"]]);
        }

        header("location:/");

    }

    public function terminarPartida()
    {
        $correcta = $this->model->guardarPreguntaDePartida($_SESSION["id"], $_SESSION["idPartida"] , $_POST["idPregunta"], $_POST["idRespuesta"]);
        $_SESSION["pregunta"] = null;
        $_SESSION["respuestas"] = null;
        $_SESSION["tiempoInicio"]=null;
        if ($correcta) {
            header("Location: /preguntados/partida");
        } else {
            $_SESSION["idPartida"] = null;
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
