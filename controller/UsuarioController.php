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
            if(isset($_POST["usuario"]) && isset($_POST["password"])){
                $username = $_POST['usuario'];
                $password = $_POST['password'];
                //cookies, etc
                header("location:/pokedex/index.php");
                exit();
            }

            $this -> presenter -> render("view/loginInvalidoView.mustache");

        }
    }