<?php
    class PokemonModel {
<<<<<<< HEAD

=======
>>>>>>> a9beca70fcbbf31bb29d6f78988ec00bc3f86d61
        private $database;

        public function __construct($database)
        {
            $this -> database = $database;
        }

        public function getAllPokemon()
        {
<<<<<<< HEAD
            return $this -> database -> query("SELECT * FROM Pokemon");
=======
            return $this -> $database -> query("SELECT * FROM Pokemon");
>>>>>>> a9beca70fcbbf31bb29d6f78988ec00bc3f86d61
        }

        public function getPokemon($id)
        {
<<<<<<< HEAD
            return $this -> database -> query("SELECT * FROM Pokemon WHERE id = $id");
        }

        public function addPokemon($id, $nombre, $tipo, $descripcion){
            return $this -> database -> query("INSERT INTO pokemon(id, nombre, tipo, descripcion) VALUES ('$id', '$nombre', '$tipo', '$descripcion')");
        }

        public function deletePokemon($id){
            return $this -> database -> query("DELETE FROM pokemon WHERE id = $id");
=======
            return $this -> $database -> query("SELECT * FROM Pokemon WHERE id = $id");
>>>>>>> a9beca70fcbbf31bb29d6f78988ec00bc3f86d61
        }

        public function editPokemon($id, $nombre, $tipo, $descripcion)
        {
            return $this -> $database -> query("UPDATE pokemon SET nombre = '$nombre', tipo = '$tipo', descripcion = '$descripcion' WHERE id = $id");
        }
    }
?>
