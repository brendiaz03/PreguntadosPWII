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
                $nombreUsuario = $_POST['nombreUsuario'];
                $password = $_POST['password'];

                $resultado = $this->model->logearse($nombreUsuario, $password);

                if ($resultado['success']) {
                    $isLogueado = true;
                    $this -> presenter -> render("view/lobby.mustache", ["isLogueado" => $isLogueado]);
                    exit();
                } else {
                    header("Location: /preguntados/index.php");
                }
        }

        public function logout(){
            $this -> model -> logout();
            $isLogueado = false;
            header("location:/preguntados/index.php");
            exit();
        }
    }