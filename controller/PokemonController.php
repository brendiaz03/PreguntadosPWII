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
            $pokemones = $this->model->getAllPokemon();
            $this->presenter->render("view/pokemonList.mustache", ["pokemones" => $pokemones]);
        }
    }
?>
