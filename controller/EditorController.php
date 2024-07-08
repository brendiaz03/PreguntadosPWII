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
        $textoNav = "SUGERIR PREGUNTA";
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

            $this->presenter->render("view/agregarPreguntaView.mustache", ["success" => "¡La pregunta se ha agregado correctamente!", 'logeado' => true, "textoNav" => $textoNav, "foto" => $usuario['foto']]);
        } else {
            $this->presenter->render("view/agregarPreguntaView.mustache", ["error" => "¡Error! Todos los campos deben completarse", 'logeado' => true, "textoNav" => $textoNav, "foto" => $usuario['foto']]);
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
            header("Location: /usuario/lobby");
        }
    }

    public function setEstadoPregunta()
    {
        $usuario = $this->model->getUsuarioById($_SESSION["id"]);
        $textoNav = "PREGUNTAS";
        $idPregunta = $_POST['idPregunta'];
        $this->model->cambiarEstadoPregunta($idPregunta);

        $preguntas = $this->model->getPreguntasEditor();
        $this->presenter->render("view/listaPregunta.mustache", ['preguntas' => $preguntas, 'logeado' => true, "foto" => $usuario['foto'], "textoNav" => $textoNav]);
    }

    public function vistaAgregarPregunta()
    {
        $usuario = $this->model->getUsuarioById($_SESSION["id"]);

        if ($usuario['tipoUsuario'] == 'Editor') {
            $this->presenter->render("view/agregarPreguntaView.mustache", ['logeado' => true]);
        }

        header("location:/");
     }

    public function vistaEditarPregunta()
    {
        $usuario = $this->model->getUsuarioById($_SESSION["id"]);

        if ($usuario['tipoUsuario'] == 'Editor') {
            $idPregunta = $_GET['id'];
            if ($idPregunta != null) {
                $datosPregunta = $this->model->obtenerPreguntaConRespuestas($idPregunta);
                $this->presenter->render("view/editarPreguntaView.mustache", $datosPregunta);
            }
        }
        header("location:/");
    }

    public function vistaListaPregunta()
    {
        $usuario = $this->model->getUsuarioById($_SESSION["id"]);
        $textoNav = "PREGUNTAS";
        if ($usuario['tipoUsuario'] == 'Editor') {
            $preguntas = $this->model->getPreguntasEditor();
            $this->presenter->render("view/listaPregunta.mustache", ['preguntas' => $preguntas, 'logeado' => true, "foto" => $usuario['foto'], "textoNav" => $textoNav]);
        }
        header("location:/");
      }

    public function vistaPreguntasSugeridas()
    {
        $usuario = $this->model->getUsuarioById($_SESSION["id"]);
        $textoNav = "PREGUNTAS SUGERIDAS";
        if ($usuario['tipoUsuario'] == 'Editor') {
            $preguntas = $this->model->getPreguntasEditorSugeridas();
            $this->presenter->render("view/listaPregunta.mustache", ['preguntas' => $preguntas, 'logeado' => true, "foto" => $usuario['foto'], "textoNav" => $textoNav]);
        }

        header("location:/");
    }

    public function vistaPreguntasReportadas()
    {
        $usuario = $this->model->getUsuarioById($_SESSION["id"]);
        if ($usuario['tipoUsuario'] == 'Editor') {
            $textoNav = "PREGUNTAS SUGERIDAS";
            $preguntas = $this->model->getPreguntasEditorReportadas();
            $this->presenter->render("view/listaPregunta.mustache", ['preguntas' => $preguntas, 'logeado' => true, "foto" => $usuario['foto'], "textoNav" => $textoNav]);
        }

        header("location:/");
    }


}
