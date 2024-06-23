<?php

class AdminModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getAllJugadores(){
        $sql = "SELECT 
        u.*,
        COUNT(pp.idPregunta) AS cantidadPreguntas
    FROM 
        usuario u
    LEFT JOIN 
        partida p ON u.id = p.idUsuario
    LEFT JOIN 
        partida_pregunta pp ON p.id = pp.idPartida
    WHERE 
        u.tipoUsuario = 'Jugador'
    GROUP BY 
        u.id";
        return $this->database->query($sql);
    }
    public function getAllPartidas(){
        $sql = "SELECT * FROM partida";
        return $this->database->query($sql);
    }
    public function getNombrePorId($idUsuario){
        $sql = "SELECT nombre FROM usuario WHERE id = $idUsuario";
        return $this->database->query($sql);
    }
    public function getAllPreguntas(){
        $sql = "SELECT * FROM pregunta";
        return $this->database->query($sql);
    }
    public function getPreguntasSugeridas(){
        $sql = "SELECT * FROM pregunta Where estado = 'Sugerida'";
        return $this->database->query($sql);
    }

    public function getUsuariosPorPaisFiltradoPorFecha($fechaDesde = null, $fechaHasta = null,$rol){
        $whereClause = '';

        if (!empty($fechaDesde && !empty($fechaHasta))) {
            $whereClause = "WHERE fechaRegistro BETWEEN '$fechaDesde' AND '$fechaHasta' AND tipoUsuario = $rol";
        }

        $consulta = "SELECT pais, COUNT(*) AS cantidad FROM usuario $whereClause GROUP BY pais";

        $query = $this->database->query($consulta);

        $cabecera = ['Pais', 'Cantidad'];

        return $this->convertirArrayAJSON($query, $cabecera);
    }

    public function getUsuariosPorPais($rol)
    {
        $consulta = "SELECT pais, COUNT(*) AS cantidad FROM usuario WHERE tipoUsuario = $rol GROUP BY pais";

        $query = $this->database->query($consulta);

        $cabecera = ['Pais', 'Cantidad'];

        return $this->convertirArrayAJSON($query, $cabecera);
    }

    public function getUsuariosPorSexoFiltradoPorFechaYRol($fechaDesde = null, $fechaHasta = null, $rol)
    {
        $whereClause = '';

        if (!empty($fechaDesde && !empty($fechaHasta))) {
            $whereClause = "WHERE fechaRegistro BETWEEN '$fechaDesde' AND '$fechaHasta' AND tipoUsuario = $rol";
            $whereClause .= " AND tipoUsuario = $rol";
        }

        $consulta = "SELECT sexo, COUNT(*) AS cantidad FROM usuario $whereClause GROUP BY sexo";

        $query = $this->database->query($consulta);

        $cabecera = ['Sexo', 'Cantidad'];

        return $this->convertirArrayAJSON($query, $cabecera);
    }

    public function getUsuariosPorSexoYRol($rol)
    {
        $consulta = "SELECT sexo, COUNT(*) AS cantidad FROM usuario WHERE tipoUsuario = $rol GROUP BY sexo";

        $query = $this->database->query($consulta);

        $cabecera = ['Sexo', 'Cantidad'];

        return $this->convertirArrayAJSON($query, $cabecera);
    }

    public function getUsuariosPorEdadFiltradoPorFecha($fechaDesde = null, $fechaHasta = null, $rol)
    {
        $whereClause = '';

        if (!empty($fechaDesde && !empty($fechaHasta))) {
            $whereClause = "WHERE fechaRegistro BETWEEN '$fechaDesde' AND '$fechaHasta' AND tipoUsuario = $rol";
        }

        $consulta = "SELECT CASE WHEN YEAR(CURDATE()) - anioNacimiento < 18 THEN 'Menores'
        WHEN YEAR(CURDATE()) - anioNacimiento BETWEEN 18 AND 60 THEN 'Mayores' 
        WHEN YEAR(CURDATE()) - anioNacimiento > 60 THEN 'Jubilados'
        END AS Grupo, COUNT(*) AS Cantidad FROM usuario $whereClause GROUP BY Grupo";

        $query = $this->database->query($consulta);

        $cabecera = ['Grupo', 'Cantidad'];

        return $this->convertirArrayAJSON($query, $cabecera);
    }

    public function getUsuariosPorEdad($rol)
    {
        $consulta = "SELECT CASE WHEN YEAR(CURDATE()) - anioNacimiento < 18 THEN 'Menores'
        WHEN YEAR(CURDATE()) - anioNacimiento BETWEEN 18 AND 60 THEN 'Mayores' 
        WHEN YEAR(CURDATE()) - anioNacimiento > 60 THEN 'Jubilados'
        END AS Grupo, COUNT(*) AS Cantidad FROM usuario WHERE tipoUsuario = $rol GROUP BY Grupo";

        $query = $this->database->query($consulta);

        $cabecera = ['Grupo', 'Cantidad'];

        return $this->convertirArrayAJSON($query, $cabecera);
    }

//    public function getRespuestasCorrectasPorUsuario($fechaDesde = null, $fechaHasta = null, $rol)
//    {
//        $whereClause = '';
//
//        if (!empty($fechaDesde && !empty($fechaHasta))) {
//            $whereClause = "WHERE fechaRegistro BETWEEN '$fechaDesde' AND '$fechaHasta' AND rol = $rol";
//        } else {
//            // Si no se proporciona una fecha, solo aplicar el filtro de idRol
//            $whereClause = "WHERE rol = $rol";
//        }
//
//        $consulta = "SELECT nombre, (SUM(cantRespuestasCorrectas) / SUM(cantRespuestas)) * 100 AS porcentajeRespuestasCorrectas FROM usuario $whereClause GROUP BY nombre";
//
//        $query = $this->database->query($consulta);
//
//        $cabecera = ['nombre', 'porcentajeRespuestasCorrectas'];
//
//        return $this->convertirArrayAJSON($query, $cabecera);
//    }



    public function getUsuariosNuevos($fechaDesde = null, $fechaHasta = null){
        $whereClause = '';

        if (!empty($fechaDesde && !empty($fechaHasta))) {
            $whereClause = "WHERE fechaRegistro BETWEEN '$fechaDesde' AND '$fechaHasta'";
        } else {
            $whereClause = "WHERE fechaRegistro >= DATE_SUB(CURDATE(), INTERVAL 10 DAY)";
        }
        $consulta = "SELECT * FROM usuario $whereClause";
        return $this->database->query($consulta);
    }


    public function getUsuariosNuevosPDF($fechaDesde = null, $fechaHasta= null){
        $whereClause = '';

        if (!empty($fechaDesde && !empty($fechaHasta))) {
            $whereClause = "WHERE fechaRegistro BETWEEN '$fechaDesde' AND '$fechaHasta'";
        } else {
            $whereClause = "WHERE fechaRegistro >= DATE_SUB(CURDATE(), INTERVAL 10 DAY)";
        }
        $consulta = "SELECT * FROM usuario $whereClause";
        return $this->database->print($consulta);
    }
    public function imprimirTodosLosJugadoresParaPDF(){
        $sql = "SELECT * FROM usuario WHERE tipoUsuario = 'Jugador'";
        $result = $this->database->print($sql);
        return $result;
    }

    private function convertirArrayAJSON($array, $cabecera) {
        $result = [];
        $result[] = $cabecera;

        foreach ($array as $element) {
            $result[] = [$element[0], (int)$element[1]];
        }

        return json_encode($result);
    }
}