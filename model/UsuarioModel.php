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

            if (count($result) > 0) {
                $_SESSION["id"] = $result[0]['id'];
                if($result[0]['activo'] == 1){
                    return ['success' => true, 'message' => 'Inicio de sesión exitoso'];
                }else {
                    return ['success' => false, 'message' => 'Debe activar su cuenta para iniciar sesion!'];
                }
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
                    "INSERT INTO `Usuario`(`nombreCompleto`, `anioNacimiento`, `sexo`, `pais` , `ciudad` , `mail` , `password` , `nombreUsuario` , `tipoUsuario` ,`foto`, `puntaje`, `activo`, `hash`, `nivel`) 
                        VALUES ('$nombreCompleto', '$anioNacimiento', '$sexo', '$pais','$ciudad','$mail','$password','$nombreUsuario','$tipoUsuario','$imagen_nombre','0', '0', '$hash', 'Intermedio')");
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
            $result = $this->database->query($sql);
            return $result[0];
        }

        public function getJugadoresConPuntajeYPartidasJugadas(){
            $sql = "SELECT
                u.nombreUsuario, u.puntaje, u.id,
                COUNT(p.id) AS totalPartidas,
                SUM(CASE WHEN p.correcta = 1 THEN 1 ELSE 0 END) AS partidasCorrectas,
                SUM(CASE WHEN p.correcta = 0 THEN 1 ELSE 0 END) AS partidasIncorrectas
            FROM
                usuario u
            LEFT JOIN
                partida p ON u.id = p.idUsuario
            GROUP BY
                u.id
            ORDER BY
                u.puntaje DESC"; // Ordenar por cantidad total de partidas

            return $this->database->query($sql);
        }

        public function getPartidasTotalesPorUsuario($idUsuario){
            $sql = "SELECT COUNT(*) AS partidasTotales FROM partida WHERE idUsuario = '$idUsuario'";
            return $this->database->query($sql);
        }

    }
?>
