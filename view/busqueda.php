<?php
    include 'Conexion_db.php';
<<<<<<< HEAD
=======

    include 'conexion_db.php';
>>>>>>> a9beca70fcbbf31bb29d6f78988ec00bc3f86d61
    global $conexion;

    if (isset($_POST["busqueda"])) {
        $busqueda = $_POST["busqueda"];
        $consulta_busqueda = "SELECT * FROM pokemon WHERE nombre LIKE '%$busqueda%' OR tipo LIKE '%$busqueda%' OR id = '$busqueda'";
        $busqueda_query = $conexion -> query($consulta_busqueda);
    }
?>
