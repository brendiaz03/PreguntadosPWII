<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="index.css">
    <title>TP Pokedex</title>

//vverewwef
    <style>
        .nav {
            z-index: 1000;
            background: white;
        }
        .tabla {
            margin-top: 1.5rem;
            width: 60%;
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
    </nav>

    <main class="container">
        <form class="buscador">
            <input class="buscador-input" type="text" placeholder="Ingrese el nombre, tipo o numero del pokemon..." name="pokemon">
            <button class="buscador-btn" type="submit">Buscar</button>
        </form>

        <table class="tabla">
            <thead>
                <tr>
                    <th>Numero</th>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Tipo</th>
                </tr>
            </thead>
            <tbody>
                <tr class="tabla-registro">
                    <td>1</td>
                    <td>Bulbasaur</td>
                    <td><img width="65px" src="imagenes/bulbasaur.webp" alt="Bulbasaur"></td>
                    <td><img width="40px" src="imagenes/planta.png"></td>
                </tr>
                <tr class="tabla-registro">
                    <td>2</td>
                    <td>Pikachu</td>
                    <td><img width="65px" src="imagenes/Pikachu.webp" alt="Pikachu"></td>
                    <td><img width="40px" src="imagenes/electrico.png"></td>
                </tr>
                <tr class="tabla-registro">
                    <td>3</td>
                    <td>Charmander</td>
                    <td><img width="65px" class="pokemon-img" src="imagenes/Charmander.webp" alt="Charmander"></td>
                    <td><img width="40px" class="pokemon-tipo" src="imagenes/fuego.png"></td>
                </tr>
                <tr class="tabla-registro">
                    <td>4</td>
                    <td>Magikarp</td>
                    <td><img width="65px" src="imagenes/Magikarp.webp" alt="Magikarp"></td>
                    <td><img width="40px" src="imagenes/agua.png"></td>
                </tr>
            </tbody>
        </table>
    </main>



</body>
</html>


