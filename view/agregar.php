<?php
    require_once("Conexion_db.php");
    global $conexion;
    if(isset($_POST['numero']) && isset($_POST['nombre']) && isset($_POST['tipo'])  && isset($_POST['descripcion']) && isset($_FILES['imagen'])){
        $id = $_POST["numero"];
        $nombre = $_POST["nombre"];
        $tipo = $_POST["tipo"];
        $descripcion = $_POST["descripcion"];
        $imagen = $_FILES['imagen'];

        $pokemon_almacenado = "SELECT 1 FROM pokemon WHERE id = $id";

        if($conexion -> query($pokemon_almacenado) -> fetch_assoc() == null){
            $agregar_query = "INSERT INTO pokemon(id, nombre, tipo, descripcion) VALUES ($id, '$nombre', '$tipo', '$descripcion')";
            $conexion -> query($agregar_query);
            $carpeta = "imagenes/";
            $imagen_nombre = "$nombre.webp";
            $imagen_tmp = $_FILES['imagen']['tmp_name'];

            move_uploaded_file($imagen_tmp, $carpeta.$imagen_nombre);

            echo "
                <div style='padding: .5rem 1rem'>
                    <p style='padding: 1rem; font-size: 1.3rem; color: #fff; width: 30%; background: rgba(0,120,0,.7); font-family: Roboto, sans-serif'>
                        $nombre ha sido agregado correctamente a la lista de pokemones!
                    </p>
                    <a href='../index.php'>Volver a la pagina principal</a>
                </div> ";
        }else {
            echo "
                <div style='padding: .5rem 1rem'>
                    <p style='padding: 1rem; font-size: 1.3rem; color: #fff; width: 30%; background: rgba(150,0,0,.9); font-family: Roboto, sans-serif'>
                        ERROR! el pokemom ya existe en la lista! Vuelva a intentar cambiando el numero.
                    </p>
                    <a href='pokemon_formulario.php'>Volver</a>
                </div> 
            ";
        }
    }else {
        echo "<div style='padding: .5rem 1rem'>
                    <p style='padding: 1rem; font-size: 1.3rem; color: #fff; width: 30%; background: rgba(150,0,0,.9); font-family: Roboto, sans-serif'>
                        Error! Debes completar todos los campos del formulario.
                    </p>
                    <a href='pokemon_formulario.php'>Volver</a>
                </div> ";
    }
?>
