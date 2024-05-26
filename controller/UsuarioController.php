<?php

    class UsuarioController{
        private $model;
        private $presenter;

        public function __construct($model, $presenter)
        {
            $this->model = $model;
            $this->presenter = $presenter;
        }

        public function login(){
            if($_POST["usuario"] != null && $_POST["password"] != null){
                $username = $_POST['usuario'];
                $password = $_POST['password'];
                $this -> model -> logearse($username, $password);
                header("location:/pokedex/index.php");
                exit();
            }
            $this -> presenter -> render("view/home.mustache");
        }

        public function logout(){
            $this -> model -> logout();
            header("location:/pokedex/index.php");
            exit();
        }
        public function registro(){
            if($_POST["nombreCompleto"] != null && $_POST["añoNacimiento"] != null&& $_POST["sexo"] != null&& $_POST["pais"] != null&& $_POST["ciudad"] != null&& $_POST["mail"] != null&& $_POST["añoNacimiento"] != null&& $_POST["contraseña"] != null&& $_POST["nombreUsuario"] !=null && $_POST["tipoUsuario"] != null && $_POST["foto"] != null){

                $this -> model -> registro($_POST["nombreCompleto"],$_POST["añoNacimiento"],$_POST["sexo"],$_POST["pais"],$_POST["ciudad"],$_POST["mail"],$_POST["añoNacimiento"],$_POST["contraseña"],$_POST["nombreUsuario"],$_POST["tipoUsuario"],$_POST["foto"],0);
                header("location:/PreguntadosPW/index.php");
                exit();
            }
            $this -> presenter -> render("view/home.mustache");
        }
    }
