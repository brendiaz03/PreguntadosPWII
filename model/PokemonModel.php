<?php
    class PokemonModel {

        private $database;

        public function __construct($database)
        {
            $this -> database = $database;
        }

        public function getAllPokemon()
        {
            return $this -> $database -> query("SELECT * FROM Pokemon");
        }

        public function getPokemon($id)
        {
            return $this -> $database -> query("SELECT * FROM Pokemon WHERE id = $id");
        }

        public function editPokemon($id, $nombre, $tipo, $descripcion)
        {
            return $this -> $database -> query("UPDATE pokemon SET nombre = '$nombre', tipo = '$tipo', descripcion = '$descripcion' WHERE id = $id");
        }
    }
?>
