<?php
<<<<<<< HEAD
=======
    require_once('Conexion_db.php');
>>>>>>> a9beca70fcbbf31bb29d6f78988ec00bc3f86d61
    require_once('conexion_db.php');
    global $conexion;

    if(isset($_POST["id"])){
        $id = $_POST["id"];
        $query = "DELETE FROM pokemon WHERE id = $id";
        $conexion -> query($query);
        echo "
                <div style='padding: .5rem 1rem'>
                    <p style='padding: 1rem; font-size: 1.3rem; color: #fff; width: 30%; background: rgba(0,120,0,.7); font-family: Roboto, sans-serif'>
                        Pokemon eliminado correctamente!
                    </p>
                    <a href='../index.php'>Volver a la pagina principal</a>
                </div> ";
    }
?>
