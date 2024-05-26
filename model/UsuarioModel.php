<?php
    class UsuarioModel {
        private $database;
        public function __construct($database){
            $this -> database = $database;
        }

        public function logearse($username, $password)
        {
            if(isset($username) && isset($password)){
                setcookie("usernameCookie", $username, time() + (86400 * 30), "/");
                setcookie("passwordCookie", $password, time() + (86400 * 30), "/");
            }
        }

        public function logout()
        {
            unset($_COOKIE["usernameCookie"]);
            unset($_COOKIE["passwordCookie"]);
            setcookie("usernameCookie", null, -1, '/');
            setcookie("passwordCookie", null, -1, '/');
        }

        public function registro($nombreCompleto,$añoNacimiento,$sexo,$pais,$ciudad,$mail,$contraseña,$nombreUsuario,$tipoUsuario,$foto,$puntaje)
        {
            $carpeta = "public/imagenes/";
            $imagen_nombre = "$nombreUsuario.webp";
            move_uploaded_file($foto, $carpeta . $imagen_nombre);
            return $this->database->execute(
                "INSERT INTO `pokemon`(`nombreCompleto`, `añoNacimiento`, `sexo`, `pais` , `ciudad` , `mail` , `añoNacimiento` , `contraseña` , `nombreUsuario` , `tipoUsuario` , `foto`, , `puntaje`) 
                VALUES ('$nombreCompleto', '$añoNacimiento', '$sexo', '$pais','$ciudad','$mail','$añoNacimiento','$contraseña','$nombreUsuario','$tipoUsuario','$foto','$puntaje')");
                }

    }
?>
