<?php
    class UsuarioModel {

        private $database;

        public function __construct($database){
            $this -> database = $database;
        }

        public function logearse($nombreUsuario, $password)
        {
            $sql = "SELECT * FROM usuario WHERE nombreUsuario = '$nombreUsuario' AND password = '$password' LIMIT 1";
            $result = $this->database->query($sql);

            if ($result && count($result) > 0) {
                session_start();
                $_SESSION['id'] = $result[0]['id'];
                $_SESSION['foto'] = $result[0]['foto'];
                $_SESSION['nombreCompleto'] = $result[0]['id'];
                $_SESSION['tipoUsuario'] = $result[0]['tipoUsuario'];
                $_SESSION['puntaje'] = $result[0]['puntaje'];
                return ['success' => true, 'message' => 'Inicio de sesión exitoso'];
            } else {
                return ['success' => false, 'message' => 'Nombre de usuario o contraseña incorrectos'];
            }
        }

        public function logout()
        {
            session_destroy();
        }
    }
?>
