<?php
class AdminController
{
    private $model;
    private $presenter;

    public function __construct($model, $presenter)
    {
        $this->model = $model;
        $this->presenter = $presenter;
    }

    public function agregarPregunta(){
        if($_POST["categoria"] != null && $_POST["pregunta"] != null &&
            $_POST["correcta"] != null && $_POST["opcion2"] != null &&
            $_POST["opcion3"] != null && $_POST["opcion4"] != null){
            $categoria = $_POST["categoria"];
            $pregunta = $_POST["pregunta"];
            $correcta = $_POST["correcta"];
            $opcion2 = $_POST["opcion2"];
            $opcion3 = $_POST["opcion3"];
            $opcion4 = $_POST["opcion4"];

            $this -> model -> agregarPregunta($categoria, $pregunta, $correcta, $opcion2, $opcion3, $opcion4);

            $this -> presenter -> render("view/agregarPreguntaView.mustache", ["success" => "La pregunta se ha agregado correctamente!"]);
        }else {
            $this -> presenter -> render("view/agregarPreguntaView.mustache", ["error" => "Error! Todos los campos deben completarse"]);
        }
    }

    public function setEstadoPregunta(){
        $idPregunta = $_POST['idPregunta'];
        $this -> model -> cambiarEstadoPregunta($idPregunta);
        
        $preguntas = $this->model->getPreguntasEditor();
        $this->presenter->render("view/listaPregunta.mustache", ['preguntas' => $preguntas]);
    }

    public function vistaAgregarPregunta()
    {
        $this->presenter->render("view/agregarPreguntaView.mustache");
    }

    public function vistaListaPregunta()
    {
        $preguntas = $this->model->getPreguntasEditor();
        $this->presenter->render("view/listaPregunta.mustache", ['preguntas' => $preguntas]);
    }
}
