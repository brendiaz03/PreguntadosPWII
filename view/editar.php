<?php
    require_once("conexion_db.php");
    global $conexion;

    if(isset($_POST['numero']) && isset($_POST['nombre']) && isset($_POST['tipo'])  && isset($_POST['descripcion']) && isset($_FILES['imagen'])){
        $id = $_POST["numero"];
        $nombre = $_POST["nombre"];
        $tipo = $_POST["tipo"];
        $descripcion = $_POST["descripcion"];
        $imagen = $_FILES['imagen'];

        $editar_query = "UPDATE pokemon SET nombre = '$nombre', tipo = '$tipo', descripcion = '$descripcion' WHERE id = $id";
        $conexion -> query($editar_query);
        $carpeta = "imagenes/";
        $imagen_nombre = "$nombre.webp";
        $imagen_tmp = $_FILES['imagen']['tmp_name'];

        move_uploaded_file($imagen_tmp, $carpeta.$imagen_nombre);

        echo "
                <div style='padding: .5rem 1rem'>
                    <p style='padding: 1rem; font-size: 1.3rem; color: #fff; width: 30%; background: rgba(0,120,0,.7); font-family: Roboto, sans-serif'>
                          Pokemon editado correctamente!
                    </p>
                    <a href='../index.php'>Volver a la pagina principal</a>
                </div> ";
    }else {
        echo "<div style='padding: .5rem 1rem'>
                        <p style='padding: 1rem; font-size: 1.3rem; color: #fff; width: 30%; background: rgba(150,0,0,.9); font-family: Roboto, sans-serif'>
                            Error! Debes completar todos los campos del formulario.
                        </p>
                        <a href='pokemon_formulario.php?numero={$_POST['numero']}'>Volver</a>
                    </div> ";
    }
?>