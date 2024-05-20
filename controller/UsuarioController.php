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
            $this -> presenter -> render("view/loginInvalidoView.mustache");
        }

        public function logout(){
            $this -> model -> logout();
            header("location:/pokedex/index.php");
            exit();
        }
    }