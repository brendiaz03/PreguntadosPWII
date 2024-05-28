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
                    $usuario = $_SESSION['usuario'];
                    $this -> presenter -> render("view/lobby.mustache", ["usuario" => $usuario]);
                    exit();
                } else {
                    $this -> presenter -> render("view/home.mustache", ['error' => true, 'message' => 'Usuario o password incorrecta.']);
                }
        }

        public function logout(){
            $this -> model -> logout();
            header("location:/preguntados/index.php");
            exit();
        }

        public function vistaRegistro(){
            $this -> presenter -> render("view/registro.mustache");
        }

        public function vistaLogin(){
            $this -> presenter -> render("view/home.mustache");
        }
        public function registro(){
            if($_POST["nombreCompleto"] != null && $_POST["anioNacimiento"] != null&& $_POST["sexo"]
                != null&& $_POST["pais"] != null&& $_POST["ciudad"] != null&& $_POST["mail"] != null&& $_POST["password"]
                != null&& $_POST["nombreUsuario"] !=null && $_POST["tipoUsuario"] != null
            ){
                $nombre = $_POST["nombreCompleto"];
                $nacimiento = $_POST["anioNacimiento"];
                $sexo = $_POST["sexo"];
                $pais = $_POST["pais"];
                $ciudad = $_POST["ciudad"];
                $mail = $_POST["mail"];
                $password = $_POST["password"];
                $nombreUsuario = $_POST["nombreUsuario"];
                $tipoUsuario = $_POST["tipoUsuario"];
                $fotoTmp = $_FILES['foto']['tmp_name'];

                $usuarioExistente = $this -> model -> buscarUsuario($nombreUsuario, $mail);
                if($usuarioExistente == null){
                    /*
                       --- LOGICA PHP MAIL ---
                        $to = 'fweigel24@gmail.com';
                        $subject = 'Confirmacion de tu cuenta de Preguntados';
                        $message = 'Ingresa al siguiente link para confirmar tu cuenta: http://localhost/preguntados/index.php?controller=usuario&action=confirmarusuario';
                        $headers = 'From: felicarp50@gmail.com';
                        mail($to, $subject, $message, $headers);
                    */

                    $this -> model -> registro($nombre, $nacimiento, $sexo, $pais, $ciudad, $mail, $password, $nombreUsuario, $tipoUsuario, $fotoTmp,);
                    header("location:/preguntados/index.php");
                    exit();
                }else {
                    $this -> presenter -> render("view/registro.mustache", ['error' => true, 'message' => 'El nombre de usuario y/o email pertenece a un usuario existente.']);
                }
            }else {
                $this -> presenter -> render("view/registro.mustache", ['error' => true, 'message' => 'Debe completar todos los campos del formulario para poder continuar.']);
            }
        }

    }
