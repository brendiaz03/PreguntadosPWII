<<<<<<< HEAD
=======

>>>>>>> a9beca70fcbbf31bb29d6f78988ec00bc3f86d61
<?php
    include_once ("Configuration.php");
    $router = Configuration::getRouter();

    $controller = isset($_GET["controller"]) ? $_GET["controller"] : "" ;
    $action = isset($_GET["action"]) ? $_GET["action"] : "" ;

    $router->route($controller, $action);

<<<<<<< HEAD
// index.php?controller=tours&action=get
// tours/get

=======
/*<!doctype html>

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
    <?php
        session_start();

        include_once 'header.mustache';

        include_once 'header.php';

    ?>

    <?php print "<main style='height=auto; min-height:100vh; padding: 5.2rem 3.5rem 3rem 3.5rem;'>"?>
        <form method="post" class="buscador">
            <input class="buscador-input" type="text" placeholder="Ingrese el nombre, tipo o numero del pokemon..." name="busqueda">
            <button class="buscador-btn" type="submit">Buscar</button>
        </form>

        <table class="tabla">
            <thead>
                <tr>
                    <th style="text-align: center">Numero</th>
                    <th style="text-align: center">Nombre</th>
                    <th style="text-align: center">Imagen</th>
                    <th style="text-align: center">Tipo</th>
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
                                            <a style='text-decoration: none; color: rgb(0,0,0); font-size: .9rem' href='../pokemon_formulario.php'>Agregar</a>
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
                                            <a style='text-decoration: none; color: rgb(0,0,0); font-size: .9rem' href='pokemon_formulario.php'>Agregar</a>
                                            <form method='post' action='editar.php'> 
                                                <input value='{$pokemon['id']}' hidden='hidden' name='id'>
                                                <button style='cursor: pointer' type='submit'>Editar</button>
                                            </form>
                                            <form method='post' action='view/eliminar.php'> 
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
                                        <a style='text-decoration: none; color: rgb(0,0,0); font-size: .9rem' href='pokemon_formulario.php'>Agregar</a>
                                        <a style='text-decoration: none; color: rgb(0,0,0); font-size: .9rem' href='pokemon_formulario.php?numero={$pokemon['id']}'>Editar</a>
                                        <form method='post' action='view/eliminar.php'> 
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
<?php
include_once 'footer.mustache';
?>
</body>
</html>*/
>>>>>>> a9beca70fcbbf31bb29d6f78988ec00bc3f86d61

