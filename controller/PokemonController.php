<?php
    class PokemonController
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
            $pokemones = $this -> model -> getAllPokemon();
            $this -> presenter -> render("view/pokemonListView.mustache", ["pokemones" => $pokemones]);
        }
        public function delete(){
            $id = $_POST["id"];
            $this -> model -> deletePokemon($id);
            header("location:/pokedex/index.php");
            exit();
        }

        public function add(){
            $pokemonId = $_POST["id"];
            $pokemonNombre = $_POST["nombre"];
            $pokemonTipo = $_POST["tipo"];
            $pokemonDescripcion = $_POST["descripcion"];
            $imagenTmp = $_FILES['imagen']['tmp_name'];
            $this -> model -> addPokemon($pokemonId, $pokemonNombre, $pokemonTipo, $pokemonDescripcion, $imagenTmp);
            header("location:/pokedex/index.php");
            exit();
        }

        public function search(){
            $busqueda = $_POST["busqueda"];
            $pokemones = $this -> model -> searchPokemon($busqueda);
            $this -> presenter -> render("view/pokemonListView.mustache", ["pokemones" => $pokemones]);
        }

        public function addView(){
            $this -> presenter -> render("view/agregarPokemonView.mustache");
        }

        public function edit(){
            $pokemonId = $_POST["id"];
            $pokemonNombre = $_POST["nombre"];
            $pokemonTipo = $_POST["tipo"];
            $pokemonDescripcion = $_POST["descripcion"];
            $imagenTmp = $_FILES['imagen']['tmp_name'];

            $this -> model -> editPokemon($pokemonId, $pokemonNombre, $pokemonTipo, $pokemonDescripcion, $imagenTmp);
            header("location:/pokedex/index.php");
            exit();
        }

        public function editView(){
            $id = $_POST["id"];
            $pokemon = $this -> model -> getPokemon($id);
            $this -> presenter -> render("view/editarPokemonView.mustache", ["pokemon" => $pokemon]);
        }
    }
?>
