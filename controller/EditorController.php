<?php

class EditorController
{
    private $model;
    private $presenter;

    public function __construct($model, $presenter)
    {
        $this->model = $model;
        $this->presenter = $presenter;
    }

    public function agregarPregunta()
    {
        $usuario = $this->model->getUsuarioById($_SESSION["id"]);
        if ($_POST["categoria"] != null && $_POST["pregunta"] != null &&
            $_POST["correcta"] != null && $_POST["opcion2"] != null &&
            $_POST["opcion3"] != null && $_POST["opcion4"] != null
            && $_POST["dificultad"] != null) {
            $categoria = $_POST["categoria"];
            $pregunta = $_POST["pregunta"];
            $correcta = $_POST["correcta"];
            $opcion2 = $_POST["opcion2"];
            $opcion3 = $_POST["opcion3"];
            $opcion4 = $_POST["opcion4"];
            $dificultad = $_POST["dificultad"];
            if ($usuario['tipoUsuario'] == 'Editor') {
                $this->model->agregarPregunta($categoria, $pregunta, $correcta, $opcion2, $opcion3, $opcion4, 'Inactiva',$dificultad);
            }
            if ($usuario['tipoUsuario'] == 'Jugador') {
                $this->model->agregarPregunta($categoria, $pregunta, $correcta, $opcion2, $opcion3, $opcion4, 'Sugerida',$dificultad);
            }

            $this->presenter->render("view/agregarPreguntaView.mustache", ["success" => "La pregunta se ha agregado correctamente!"]);
        } else {
            $this->presenter->render("view/agregarPreguntaView.mustache", ["error" => "Error! Todos los campos deben completarse"]);
        }
    }

    public function editarPregunta()
    {
        if ($_POST["id"] != null && $_POST["categoria"] != null && $_POST["pregunta"] != null &&
            $_POST["correcta"] != null && $_POST["opcion2"] != null &&
            $_POST["opcion3"] != null && $_POST["opcion4"] != null) {
            $idPregunta = $_POST["id"];
            $categoria = $_POST["categoria"];
            $pregunta = $_POST["pregunta"];
            $correcta = $_POST["correcta"];
            $opcion2 = $_POST["opcion2"];
            $opcion3 = $_POST["opcion3"];
            $opcion4 = $_POST["opcion4"];

            $this->model->editarPregunta($idPregunta, $categoria, $pregunta, $correcta, $opcion2, $opcion3, $opcion4);

            $this->presenter->render("view/editarPreguntaView.mustache", ["success" => "La pregunta se ha modificado correctamente!"]);
        } else {
            $this->presenter->render("view/editarPreguntaView.mustache", ["error" => "Error! Todos los campos deben completarse"]);
        }
    }

    public function eliminarPregunta()
    {
        if ($_POST['idPregunta']) {
            $idPregunta = $_POST['idPregunta'];

            $this->model->eliminarPregunta($idPregunta);
            $preguntas = $this->model->getPreguntasEditor();
            $this->presenter->render("view/listaPregunta.mustache", ['preguntas' => $preguntas]);
        }
    }

    public function setEstadoPregunta()
    {
        $idPregunta = $_POST['idPregunta'];
        $this->model->cambiarEstadoPregunta($idPregunta);

        $preguntas = $this->model->getPreguntasEditor();
        $this->presenter->render("view/listaPregunta.mustache", ['preguntas' => $preguntas]);
    }

    public function vistaAgregarPregunta()
    {
        $this->presenter->render("view/agregarPreguntaView.mustache");
    }

    public function vistaEditarPregunta()
    {
        $idPregunta = $_GET['id'];
        if ($idPregunta != null) {
            $datosPregunta = $this->model->obtenerPreguntaConRespuestas($idPregunta);
            $this->presenter->render("view/editarPreguntaView.mustache", $datosPregunta);
        }
    }

    public function vistaListaPregunta()
    {
        $preguntas = $this->model->getPreguntasEditor();
        $this->presenter->render("view/listaPregunta.mustache", ['preguntas' => $preguntas]);
    }

    public function vistaPreguntasSugeridas()
    {
        $preguntas = $this->model->getPreguntasEditorSugeridas();
        $this->presenter->render("view/listaPregunta.mustache", ['preguntas' => $preguntas]);
    }

    public function vistaPreguntasReportadas()
    {
        $preguntas = $this->model->getPreguntasEditorReportadas();
        $this->presenter->render("view/listaPregunta.mustache", ['preguntas' => $preguntas]);
    }


}
