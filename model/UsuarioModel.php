<?php

class UsuarioModel
{

    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function logearse($nombreUsuario, $password)
    {
        $sql = "SELECT * FROM usuario WHERE nombreUsuario = '$nombreUsuario' LIMIT 1";
        $result = $this->database->query($sql);

        if (count($result) > 0 && password_verify($password, $result[0]['password'])) {
            $_SESSION["id"] = $result[0]['id'];
            if ($result[0]['activo'] == 1) {
                return ['success' => true, 'message' => 'Inicio de sesión exitoso'];
            } else {
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

    public function buscarUsuario($nombreUsuario, $mail)
    {
        $usuarioExistenteSQL = "SELECT 1 FROM usuario WHERE nombreUsuario = '$nombreUsuario' OR mail = '$mail'";
        return $this->database->query($usuarioExistenteSQL);
    }

    public function registro($nombreCompleto, $anioNacimiento, $sexo, $pais, $ciudad, $mail, $password, $nombreUsuario, $fotoTmp, $hash, $latitud, $longitud)
    {
        $hashPass = password_hash($password, PASSWORD_BCRYPT);
        if($fotoTmp){
            $carpeta = "public/imagenes/usuarios/";
            $imagen_nombre = "$nombreUsuario.jpg";
            move_uploaded_file($fotoTmp, $carpeta . $imagen_nombre);

            return $this->database->execute(
                "INSERT INTO `Usuario`(`nombreCompleto`, `anioNacimiento`, `sexo`, `pais` , `ciudad` , `mail` , `password` , `nombreUsuario` , `fechaRegistro`, `tipoUsuario` ,`foto`, `puntaje`, `activo`, `hash`, `latitud`, `longitud`) 
                        VALUES ('$nombreCompleto', '$anioNacimiento', '$sexo', '$pais','$ciudad','$mail','$hashPass','$nombreUsuario', NOW(),'Jugador','$imagen_nombre','0', '0', '$hash', '$latitud', '$longitud')");
        }
        return $this->database->execute(
            "INSERT INTO `Usuario`(`nombreCompleto`, `anioNacimiento`, `sexo`, `pais` , `ciudad` , `mail` , `password` , `nombreUsuario` , `tipoUsuario` , `puntaje`, `activo`, `hash`, `latitud`, `longitud`) 
                        VALUES ('$nombreCompleto', '$anioNacimiento', '$sexo', '$pais','$ciudad','$mail','$hashPass','$nombreUsuario','Jugador','0', '0', '$hash', '$latitud', '$longitud')");
    }

    public function confirmacionCuenta($hashUsuario)
    {
        $query = "SELECT 1 FROM usuario WHERE hash = '$hashUsuario' LIMIT 1";
        $result = $this->database->query($query);
        if (count($result) == 1) {
            $queryConfirmacion = "UPDATE usuario SET activo = TRUE, hash = NULL WHERE hash = '$hashUsuario'";
            $this->database->execute($queryConfirmacion);
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

    public function getJugadoresConPuntajeYPartidasJugadas()
    {
        $sql = "SELECT
        u.nombreUsuario AS nombreCompleto,
        u.puntaje AS puntajeTotal,
        u.id AS id,
        u.foto AS foto,  -- Agregar el campo 'foto'
        COALESCE(partidas.totalPartidas, 0) AS totalPartidas,
        COALESCE(mejorPartida.correctas, 0) AS mejorPartida
    FROM
        usuario u
    LEFT JOIN (
        SELECT
            p.idUsuario,
            COUNT(p.id) AS totalPartidas
        FROM
            partida p
        GROUP BY
            p.idUsuario
    ) AS partidas ON u.id = partidas.idUsuario
    LEFT JOIN (
        SELECT
            sub.idUsuario,
            sub.correctas
        FROM (
            SELECT
                p.idUsuario,
                pp.idPartida,
                SUM(CASE WHEN pp.correcta = 1 THEN 1 ELSE 0 END) AS correctas,
                p.fechaRealizado,
                ROW_NUMBER() OVER (PARTITION BY p.idUsuario ORDER BY SUM(CASE WHEN pp.correcta = 1 THEN 1 ELSE 0 END) DESC, p.fechaRealizado DESC) AS rn
            FROM
                partida_pregunta pp
            JOIN
                partida p ON pp.idPartida = p.id
            GROUP BY
                p.idUsuario, pp.idPartida, p.fechaRealizado
        ) sub
        WHERE sub.rn = 1
    ) AS mejorPartida ON u.id = mejorPartida.idUsuario
    ORDER BY
        u.puntaje DESC";

        return $this->database->query($sql);
    }

    public function getPartidasTotalesPorUsuario($idUsuario)
    {
        $sql = "SELECT COUNT(*) AS partidasTotales FROM partida WHERE idUsuario = '$idUsuario'";
        return $this->database->query($sql);
    }

}

?>
