<?php
    $dbDatos = parse_ini_file("db.ini");
    $conexion = new mysqli($dbDatos["servername"], $dbDatos["username"], $dbDatos["password"], $dbDatos["database"]);

    if ($conexion->connect_error) {
        die("Error! Falló la conexion con la base de datos.");
    }
?>