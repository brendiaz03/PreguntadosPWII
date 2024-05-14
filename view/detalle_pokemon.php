<?php
    if(isset($_GET["id"]) && isset($_GET["nombre"]) && isset($_GET["tipo"]) && isset($_GET["descripcion"])){
        $id = $_GET["id"];
        $nombre = $_GET["nombre"];
        $tipo = $_GET["tipo"];
        $descripcion = $_GET["descripcion"];

        print "
            <div style='height: 80vh; width: 100%; padding: 2rem; display: flex; font-family: Roboto, sans-serif;
                flex-direction: column; justify-content: center; align-items: center; gap: 2rem'
            >
                <a href='../index.php'>Volver a la pagina principal</a>
                <div style='width: 40%; padding: 1rem 2rem; box-shadow: 0px 0px 3px 0px rgba(0,0,0, .3); 
                        display: flex; gap: 1.2rem'
                >
                    <div>
                        <div style='display: flex; column-gap: 1rem; align-items: center'>
                            <h4>Pokemon numero: $id</h4>
                            <img width='35px' height='35px' src='imagenes/$tipo.png'>
                        </div>
                        <h5 style='font-size: 1.2rem'>$nombre</h5>
                         <p>Tipo: $tipo</p>
                        <img style='width: 200px' src='imagenes/$nombre.webp'/>
                    </div>
                    <p style='width: 50%'>$descripcion</p>
                </div>
                
            </div>
            
        ";
    }
?>
