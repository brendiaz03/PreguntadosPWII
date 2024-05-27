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
        $isLogueado = false;

        $this->presenter->render("view/home.mustache", ["isLogueado" => $isLogueado]);
    }

//    public function delete()
//    {
//        $id = $_POST["id"];
//        $this->model->deletePokemon($id);
//        header("location:/pokedex/index.php");
//        exit();
//    }
//
//    public function add()
//    {
//        $pokemonId = $_POST["id"];
//        $pokemonNombre = $_POST["nombre"];
//        $pokemonTipo = $_POST["tipo"];
//        $pokemonDescripcion = $_POST["descripcion"];
//        $imagenTmp = $_FILES['imagen']['tmp_name'];
//        $this->model->addPokemon($pokemonId, $pokemonNombre, $pokemonTipo, $pokemonDescripcion, $imagenTmp);
//        header("location:/pokedex/index.php");
//        exit();
//    }
//
//    public function search()
//    {
//        $busqueda = $_POST["busqueda"];
//        $pokemones = $this->model->searchPokemon($busqueda);
//        $user = false;
//        if($_COOKIE['usernameCookie'] != null){
//            $user = $_COOKIE['usernameCookie'];
//        }
//        $this->presenter->render("view/lobby.mustache", ["pokemones" => $pokemones, "user" => $user]);
//    }
//
//    public function addView()
//    {
//        $user = false;
//        if($_COOKIE['usernameCookie'] != null){
//            $user = $_COOKIE['usernameCookie'];
//        }
//        $this->presenter->render("view/agregarPokemonView.mustache", ["user" => $user]);
//    }
//
//    public function edit()
//    {
//        $pokemonId = $_POST["id"];
//        $pokemonNombre = $_POST["nombre"];
//        $pokemonTipo = $_POST["tipo"];
//        $pokemonDescripcion = $_POST["descripcion"];
//        $imagenTmp = $_FILES['imagen']['tmp_name'];
//
//        $this->model->editPokemon($pokemonId, $pokemonNombre, $pokemonTipo, $pokemonDescripcion, $imagenTmp);
//        header("location:/pokedex/index.php");
//        exit();
//    }
//
//    public function editView()
//    {
//        $id = $_POST["id"];
//        $pokemon = $this->model->getPokemon($id);
//        $user = false;
//        if($_COOKIE['usernameCookie'] != null){
//            $user = $_COOKIE['usernameCookie'];
//        }
//        $this->presenter->render("view/editarPokemonView.mustache", ["pokemon" => $pokemon, "user" => $user]);
//    }
//
//
//    public function detallePokemonView()
//    {
//        $id = $_GET["id"];
//        $pokemon = $this->model->getPokemon($id);
//        $user = false;
//        if($_COOKIE['usernameCookie'] != null){
//            $user = $_COOKIE['usernameCookie'];
//        }
//        $this->presenter->render("view/detallePokemonView.mustache", ["pokemon" => $pokemon, "user" => $user]);
//    }

}

?>
