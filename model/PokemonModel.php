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
        }
        public function getPokemon($id)
        {
            return $this -> database -> query("SELECT * FROM Pokemon WHERE id = $id");
        }
        public function searchPokemon($busqueda){
            $queryBusqueda = $this -> database -> query("SELECT * FROM pokemon WHERE id = '$busqueda' 
                         OR nombre LIKE '%$busqueda%' OR tipo LIKE '%$busqueda%'");
            $queryTodos = $this -> database -> query("SELECT * FROM Pokemon");
            if(count($queryBusqueda) == 0){
                return $queryTodos;
            }

            return $queryBusqueda;
        }
        public function addPokemon($id, $nombre, $tipo, $descripcion, $imagen_tmp){
            $carpeta = "public/imagenes/";
            $imagen_nombre = "$nombre.webp";
            move_uploaded_file($imagen_tmp, $carpeta.$imagen_nombre);
            return $this -> database -> execute("INSERT INTO `pokemon`(`id`, `nombre`, `tipo`, `descripcion`) VALUES ('$id', '$nombre', '$tipo', '$descripcion')");
        }
        public function deletePokemon($id){
            return $this -> database -> execute("DELETE FROM pokemon WHERE id = $id");
        }
        public function editPokemon($id, $nombre, $tipo, $descripcion, $imagen_tmp){
            $carpeta = "public/imagenes/";
            $imagen_nombre = "$nombre.webp";
            move_uploaded_file($imagen_tmp, $carpeta.$imagen_nombre);

            return $this -> database -> execute("UPDATE pokemon SET nombre = '$nombre', tipo = '$tipo', descripcion = '$descripcion' WHERE id = $id");
        }
    }
?>
