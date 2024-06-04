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
                $_SESSION['usuario'] = $result[0];
                if($_SESSION['usuario']['activo'] == 1 && $_SESSION['usuario']['hash'] == null){
                    return ['success' => true, 'message' => 'Inicio de sesión exitoso'];
                }
                return ['success' => false, 'message' => 'Debe activar su cuenta para poder loguearse'];
            } else {
                return ['success' => false, 'message' => 'Nombre de usuario o contraseña incorrectos'];
            }
        }

        public function logout()
        {
            session_destroy();
        }

        public function buscarUsuario($nombreUsuario, $mail){
            $usuarioExistenteSQL = "SELECT 1 FROM usuario WHERE nombreUsuario = '$nombreUsuario' OR mail = '$mail'";
            return $this -> database -> query($usuarioExistenteSQL);
        }

        public function registro($nombreCompleto,$anioNacimiento,$sexo,$pais,$ciudad,$mail,$password,$nombreUsuario,$tipoUsuario,$fotoTmp, $hash)
        {
            $carpeta = "public/imagenes/usuarios/";
            $imagen_nombre = "$nombreUsuario.jpg";
            move_uploaded_file($fotoTmp, $carpeta . $imagen_nombre);
            return $this -> database -> execute(
                    "INSERT INTO `Usuario`(`nombreCompleto`, `anioNacimiento`, `sexo`, `pais` , `ciudad` , `mail` , `password` , `nombreUsuario` , `tipoUsuario` ,`foto`, `puntaje`, `activo`, `hash`) 
                        VALUES ('$nombreCompleto', '$anioNacimiento', '$sexo', '$pais','$ciudad','$mail','$password','$nombreUsuario','$tipoUsuario','$imagen_nombre','0', '0', '$hash')");
        }

        public function confirmacionCuenta($hashUsuario){
            $query = "SELECT 1 FROM usuario WHERE hash = '$hashUsuario' LIMIT 1";
            $result = $this->database->query($query);
            if(count($result) == 1){
                $queryConfirmacion = "UPDATE usuario SET activo = TRUE, hash = NULL WHERE hash = '$hashUsuario'";
                $this -> database -> execute($queryConfirmacion);
                return true;
            }

            return false;
        }

        public function getUsuarioById($idUsuario)
        {
            $sql = "SELECT * FROM usuario WHERE id = '$idUsuario' LIMIT 1";
            return $this->database->query($sql);
        }
    }
?>
