<?php
    class UsuarioModel {

        public function __construct(){
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
    }
?>
