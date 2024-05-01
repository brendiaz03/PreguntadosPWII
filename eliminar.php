<?php
    require_once ('conexion_db.php');
    global $conexion;

    if(isset($_POST["id"])){
        $id = $_POST["id"];
        $query = "DELETE FROM pokemon WHERE id = $id";
        $conexion -> query($query);
        print "Pokemon eliminado correctamente!";
        print "<a href='index.php'>Volver a la pagina principal</a>";
    }
?>
