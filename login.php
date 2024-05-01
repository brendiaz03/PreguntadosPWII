<?php
    if($_POST['usuario'] && $_POST['contraseña']){
        $usuario = $_POST['usuario'];
        $contraseña = $_POST['contraseña'];
        setcookie("usuario_cookie", $usuario, time() + (8640 * 30), "/");

        print "
                <div style='padding: .5rem 1rem'>
                    <p style='padding: 1rem; font-size: 1.3rem; color: #fff; width: 30%; background: rgba(0,120,0,.7); font-family: Roboto, sans-serif'>
                        Te has logueado correctamente!
                    </p>
                    <a href='index.php'>Volver a la pagina principal</a>
                </div> 
               ";
        exit();
    }else {
        print "
                <div style='padding: .5rem 1rem'>
                    <p style='padding: 1rem; font-size: 1.3rem; color: #fff; width: 30%; background: rgba(150,0,0,.9); font-family: Roboto, sans-serif'>
                        Error! Debes completar todos los campos del formulario.
                    </p>
                    <a href='index.php'>Volver a la pagina principal</a>
                </div> 
               ";
    }
?>
