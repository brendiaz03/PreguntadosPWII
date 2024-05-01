<?php
    include 'conexion_db.php';
    include 'busqueda.php';
    include 'eliminar.php';
    global $conexion;
    global $busqueda_query;
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="index.css">
    <title>TP Pokedex</title>

    <style>
        .nav {
            z-index: 1000;
            background: white;
        }
        .tabla {
            width: 90%;
            margin: 1.5rem auto;
            box-shadow: 0px 0px 3px 0px rgba(0,0,0, .3);
        }
        th,td {
            text-align: center;
            border-bottom: 1px solid rgba(0,0,0, .1);
        }
        th:not(:last-child), td:not(:last-child) {
            border-right: 1px solid rgba(0,0,0, .1);
        }
        th {
            padding: 1rem 0;
        }
    </style>
</head>

<body>
    <nav class="nav">
        <a href="index.php"><img class="nav-logo" src="imagenes/logo.png"></a>
        <h1 class="nav-titulo">Pokedex!</h1>

        <form class="login-form" method="post" action="login.php">
            <input class="login-input" type="text" name="usuario" placeholder="Usuario" >
            <input class="login-input" type="password" name="contraseña" placeholder="Contraseña" >
            <button class="login-btn" type="submit" >Ingresar</button>
        </form>
        <?php
            if(isset($_COOKIE["usuario_cookie"])){
                $nombre = $_COOKIE["usuario_cookie"];
                echo "Hola! $nombre, como has estado?";
            }
        ?>
    </nav>

    <?php print "<main style='height=auto; min-height:100vh; padding: 5.7rem 3.5rem 3rem 3.5rem;'>"?>
        <form method="post" class="buscador">
            <input class="buscador-input" type="text" placeholder="Ingrese el nombre, tipo o numero del pokemon..." name="busqueda">
            <button class="buscador-btn" type="submit">Buscar</button>
        </form>

        <table class="tabla">
            <thead>
                <tr>
                    <th>Numero</th>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Tipo</th>
                    <?php
                        if(isset($_COOKIE["usuario_cookie"])){
                            print "<th>Acciones</th>";
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                    $consultaLista = "SELECT * FROM pokemon";
                    $lista = $conexion -> query($consultaLista);

                    if(isset($_POST['busqueda'])){
                        if($busqueda_query -> num_rows > 0){
                            while($pokemon = $busqueda_query -> fetch_assoc()){
                                print "
                                <tr style='cursor: pointer;'>
                                    <td style='font-size: 1.1rem;'>
                                        <a style='text-decoration: none; color: rgba(0,0,0)' 
                                           href='detalle_pokemon.php?id={$pokemon['id']}&nombre={$pokemon['nombre']}&tipo={$pokemon['tipo']}&descripcion={$pokemon['descripcion']}'
                                        >
                                            {$pokemon['id']}
                                        </a>
                                    </td>
                                    <td style='font-size: 1.1rem'>
                                        <a style='text-decoration: none; color: rgba(0,0,0)' 
                                           href='detalle_pokemon.php?id={$pokemon['id']}&nombre={$pokemon['nombre']}&tipo={$pokemon['tipo']}&descripcion={$pokemon['descripcion']}'
                                        >
                                            {$pokemon['nombre']}
                                        </a>
                                    </td>
                                    <td>
                                        <a style='text-decoration: none; color: rgba(0,0,0)' 
                                           href='detalle_pokemon.php?id={$pokemon['id']}&nombre={$pokemon['nombre']}&tipo={$pokemon['tipo']}&descripcion={$pokemon['descripcion']}'
                                        >
                                            <img width='70px' src='imagenes/{$pokemon['nombre']}.webp'>
                                        </a>
                                    </td>
                                    <td>
                                        <a style='text-decoration: none; color: rgba(0,0,0)' 
                                           href='detalle_pokemon.php?id={$pokemon['id']}&nombre={$pokemon['nombre']}&tipo={$pokemon['tipo']}&descripcion={$pokemon['descripcion']}'
                                        >
                                            <img width='37px'src='imagenes/{$pokemon['tipo']}.png'>
                                        </a>
                                    </td>
                            ";
                                if(isset($_COOKIE["usuario_cookie"])){
                                    print "
                                        <td>
                                            <a style='text-decoration: none; color: rgb(0,0,0); font-size: .9rem' href='agregar.php'>Agregar</a>
                                            <form method='post' action='editar.php'> 
                                                <input value='{$pokemon['id']}' hidden='hidden' name='id'>
                                                <button style='cursor: pointer' type='submit'>Editar</button>
                                            </form>
                                            <form method='post' action='eliminar.php'> 
                                                <input value='{$pokemon['id']}' hidden='hidden' name='id'>
                                                <button style='cursor: pointer' type='submit'>Eliminar</button>
                                            </form>
                                        </td>
                                    ";
                                }
                                print "</tr>";
                            }
                        }else {
                            echo "<p style='font-size: 1.5rem; text-align: center; margin: 1.2rem 0'>Pokemon no encontrado.</p>";
                            while ($pokemon = $lista -> fetch_assoc()){
                                print "
                                <tr style='cursor: pointer;'>
                                    <td style='font-size: 1.1rem;'>
                                        <a style='text-decoration: none; color: rgba(0,0,0)' 
                                           href='detalle_pokemon.php?id={$pokemon['id']}&nombre={$pokemon['nombre']}&tipo={$pokemon['tipo']}&descripcion={$pokemon['descripcion']}'
                                        >
                                            {$pokemon['id']}
                                        </a>
                                    </td>
                                    <td style='font-size: 1.1rem'>
                                        <a style='text-decoration: none; color: rgba(0,0,0)' 
                                           href='detalle_pokemon.php?id={$pokemon['id']}&nombre={$pokemon['nombre']}&tipo={$pokemon['tipo']}&descripcion={$pokemon['descripcion']}'
                                        >
                                            {$pokemon['nombre']}
                                        </a>
                                    </td>
                                    <td>
                                        <a style='text-decoration: none; color: rgba(0,0,0)' 
                                           href='detalle_pokemon.php?id={$pokemon['id']}&nombre={$pokemon['nombre']}&tipo={$pokemon['tipo']}&descripcion={$pokemon['descripcion']}'
                                        >
                                            <img width='70px' src='imagenes/{$pokemon['nombre']}.webp'>
                                        </a>
                                    </td>
                                    <td>
                                        <a style='text-decoration: none; color: rgba(0,0,0)' 
                                           href='detalle_pokemon.php?id={$pokemon['id']}&nombre={$pokemon['nombre']}&tipo={$pokemon['tipo']}&descripcion={$pokemon['descripcion']}'
                                        >
                                            <img width='37px'src='imagenes/{$pokemon['tipo']}.png'>
                                        </a>
                                    </td>
                            ";
                                if(isset($_COOKIE["usuario_cookie"])){
                                    print "
                                        <td>
                                            <a style='text-decoration: none; color: rgb(0,0,0); font-size: .9rem' href='agregar.php'>Agregar</a>
                                            <form method='post' action='editar.php'> 
                                                <input value='{$pokemon['id']}' hidden='hidden' name='id'>
                                                <button style='cursor: pointer' type='submit'>Editar</button>
                                            </form>
                                            <form method='post' action='eliminar.php'> 
                                                <input value='{$pokemon['id']}' hidden='hidden' name='id'>
                                                <button style='cursor: pointer' type='submit'>Eliminar</button>
                                            </form>
                                        </td>
                                ";
                                }
                                print "</tr>";
                            }
                        }
                    }else {
                        while ($pokemon = $lista -> fetch_assoc()){
                            print "
                               <tr style='cursor: pointer;'>
                                    <td style='font-size: 1.1rem;'>
                                        <a style='text-decoration: none; color: rgba(0,0,0)' 
                                           href='detalle_pokemon.php?id={$pokemon['id']}&nombre={$pokemon['nombre']}&tipo={$pokemon['tipo']}&descripcion={$pokemon['descripcion']}'
                                        >
                                            {$pokemon['id']}
                                        </a>
                                    </td>
                                    <td style='font-size: 1.1rem'>
                                        <a style='text-decoration: none; color: rgba(0,0,0)' 
                                           href='detalle_pokemon.php?id={$pokemon['id']}&nombre={$pokemon['nombre']}&tipo={$pokemon['tipo']}&descripcion={$pokemon['descripcion']}'
                                        >
                                            {$pokemon['nombre']}
                                        </a>
                                    </td>
                                    <td>
                                        <a style='text-decoration: none; color: rgba(0,0,0)' 
                                           href='detalle_pokemon.php?id={$pokemon['id']}&nombre={$pokemon['nombre']}&tipo={$pokemon['tipo']}&descripcion={$pokemon['descripcion']}'
                                        >
                                            <img width='70px' src='imagenes/{$pokemon['nombre']}.webp'>
                                        </a>
                                    </td>
                                    <td>
                                        <a style='text-decoration: none; color: rgba(0,0,0)' 
                                           href='detalle_pokemon.php?id={$pokemon['id']}&nombre={$pokemon['nombre']}&tipo={$pokemon['tipo']}&descripcion={$pokemon['descripcion']}'
                                        >
                                            <img width='37px'src='imagenes/{$pokemon['tipo']}.png'>
                                        </a>
                                    </td>
                            ";
                            if(isset($_COOKIE["usuario_cookie"])){
                                print "
                                    <td>
                                        <a style='text-decoration: none; color: rgb(0,0,0); font-size: .9rem' href='agregar.php'>Agregar</a>
                                        <form method='post' action='editar.php'> 
                                            <input value='{$pokemon['id']}' hidden='hidden' name='id'>
                                            <button style='cursor: pointer' type='submit'>Editar</button>
                                        </form>
                                        <form method='post' action='eliminar.php'> 
                                            <input value='{$pokemon['id']}' hidden='hidden' name='id'>
                                            <button style='cursor: pointer' type='submit'>Eliminar</button>
                                        </form>
                                    </td>
                                ";
                            }
                            print "</tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    <?php print "</main>"?>



</body>
</html>


