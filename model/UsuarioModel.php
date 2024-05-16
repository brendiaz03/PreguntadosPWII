<?php
    class UsuarioModel {

        private $database;

        public function __construct($database){
            $this -> database = $database;
        }

        public function logearse($usuario, $password)
        {
            return $this -> database -> execute("INSERT INTO usuario(`usuario`, `password`) VALUES (`$usuario`, `$password`)");
        }

        public function getUsuario($usuario){
            return $this -> database -> query("SELECT 1 FROM usuario WHERE usuario = '$usuario'");
        }

    }
?>
