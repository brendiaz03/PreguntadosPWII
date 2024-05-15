<?php
    class PokemonModel {
        private $database;

        public function __construct($database)
        {
            $this -> database = $database;
        }

        public function getAllPokemon()
        {
            return $this -> database -> query("SELECT * FROM Pokemon");
            return $this -> $database -> query("SELECT * FROM Pokemon");
        }

        public function getPokemon($id)
        {
            return $this -> database -> query("SELECT * FROM Pokemon WHERE id = $id");
        }

        public function addPokemon($id, $nombre, $tipo, $descripcion){
            return $this -> database -> query("INSERT INTO pokemon(id, nombre, tipo, descripcion) VALUES ('$id', '$nombre', '$tipo', '$descripcion')");
        }

        public function deletePokemon($id){
            return $this -> database -> query("DELETE FROM pokemon WHERE id = $id");
            return $this -> $database -> query("SELECT * FROM Pokemon WHERE id = $id");
        }

        public function editPokemon($id, $nombre, $tipo, $descripcion)
        {
            return $this -> $database -> query("UPDATE pokemon SET nombre = '$nombre', tipo = '$tipo', descripcion = '$descripcion' WHERE id = $id");
        }
    }
?>
