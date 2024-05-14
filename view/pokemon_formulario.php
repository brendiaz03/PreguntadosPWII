
<?php
   $action = isset($_GET['numero']) ? "editar.php" : "agregar.php";
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../index.css">
    <title>TP Pokedex</title>
    <style>
        .agregar-container {
            height: auto;
            padding: 5rem 0 2rem 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .agregar-form {
            display: flex;
            flex-direction: column;
            row-gap: .7rem;
            padding: 1rem 2rem;
            box-shadow: 0px 0px 3px 0px rgba(0,0,0, .3);
        }
    </style>
</head>
<body>
    <?php
    session_start();

    include_once 'header.mustache';

    include_once 'header.php';
    ?>
    <main class="agregar-container">
        <h2 style='margin-bottom: .7rem'>Introduce los datos del nuevo pokemon!</h2>
        <form class="agregar-form" method="post" enctype="multipart/form-data" action="<?php echo "$action" ?>">
            <?php
                if(isset($_GET['numero'])){
                    $numero = $_GET['numero'];
                    echo "
                           <label for='numero'>Numero:</label>
                           <input 
                            style='border: 1px solid rgba(0,0,0, .4); padding: .3rem; border-radius: 5px; width: 10%'
                            name='numero' 
                            value='$numero' 
                          
                           >
                    ";
                }else {
                    echo "<input style='border: 1px solid rgba(0,0,0, .4); padding: .3rem; border-radius: 5px' type='number' name='numero' placeholder='numero'>";
                }
            ?>
            <input class="login-input" type="text" name="nombre" placeholder="nombre">
            <select class="login-input agregar-select" name="tipo">
                <option value="" selected disabled>Tipo</option>
                <option value="Fuego">Fuego</option>
                <option value="Electrico">Electrico</option>
                <option value="Agua">Agua</option>
                <option value="Planta">Planta</option>
                <option value="Tierra">Tierra</option>
            </select>
            <textarea class="login-input" cols="32" rows="8" style="padding: 1rem" placeholder="Introduzca una descripcion.." name="descripcion"></textarea>
            <label for="imagen">Agregar imagen:</label>
            <input type="file" placeholder="agregar una imagen" name="imagen"/>
            <button class="login-btn" type="submit">Agregar</button>
        </form>
    </main>
    <?php
        include_once 'footer.mustache';
    ?>
</body>
</html>
        include_once 'footer.php';
    ?>
</body>
</html>
<?php
   $action = isset($_GET['numero']) ? "editar.php" : "agregar.php";
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./index.css">
    <title>TP Pokedex</title>
    <style>
        .agregar-container {
            height: auto;
            padding: 5rem 0 2rem 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .agregar-form {
            display: flex;
            flex-direction: column;
            row-gap: .7rem;
            padding: 1rem 2rem;
            box-shadow: 0px 0px 3px 0px rgba(0,0,0, .3);
        }
    </style>
</head>
<body>
    <?php
    session_start();
    include_once 'header.php';
    ?>
    <main class="agregar-container">
        <h2 style='margin-bottom: .7rem'>Introduce los datos del nuevo pokemon!</h2>
        <form class="agregar-form" method="post" enctype="multipart/form-data" action="<?php echo "$action" ?>">
            <?php
                if(isset($_GET['numero'])){
                    $numero = $_GET['numero'];
                    echo "
                           <label for='numero'>Numero:</label>
                           <input 
                            style='border: 1px solid rgba(0,0,0, .4); padding: .3rem; border-radius: 5px; width: 10%'
                            name='numero' 
                            value='$numero' 
                          
                           >
                    ";
                }else {
                    echo "<input style='border: 1px solid rgba(0,0,0, .4); padding: .3rem; border-radius: 5px' type='number' name='numero' placeholder='numero'>";
                }
            ?>
            <input class="login-input" type="text" name="nombre" placeholder="nombre">
            <select class="login-input agregar-select" name="tipo">
                <option value="" selected disabled>Tipo</option>
                <option value="Fuego">Fuego</option>
                <option value="Electrico">Electrico</option>
                <option value="Agua">Agua</option>
                <option value="Planta">Planta</option>
                <option value="Tierra">Tierra</option>
            </select>
            <textarea class="login-input" cols="32" rows="8" style="padding: 1rem" placeholder="Introduzca una descripcion.." name="descripcion"></textarea>
            <label for="imagen">Agregar imagen:</label>
            <input type="file" placeholder="agregar una imagen" name="imagen"/>
            <button class="login-btn" type="submit">Agregar</button>
        </form>
    </main>
    <?php
    include_once 'footer.php';
    ?>
</body>
</html>
