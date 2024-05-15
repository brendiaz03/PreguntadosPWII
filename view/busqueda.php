<?php
    include 'Conexion_db.php';
    global $conexion;

    if (isset($_POST["busqueda"])) {
        $busqueda = $_POST["busqueda"];
        $consulta_busqueda = "SELECT * FROM pokemon WHERE nombre LIKE '%$busqueda%' OR tipo LIKE '%$busqueda%' OR id = '$busqueda'";
        $busqueda_query = $conexion -> query($consulta_busqueda);
    }
?>
