<header>
    <style>
        .nav {
            position: fixed;
            top: 0;
            z-index: 1000;
            background: #fff;
        }
    </style>
    <nav class="nav">
        <a href="../../index.php"><img class="nav-logo" src="imagenes/logo.png"></a>
        <h1 class="nav-titulo">Pokedex!</h1>
        <div>
            <?php if(isset($_COOKIE["usuario_cookie"])): ?>
                <?php
                $nombre = $_COOKIE["usuario_cookie"];
                echo "Hola! $nombre, como has estado?";
                ?>
                <a href="../logout.php" class="logout-btn">Salir</a>
            <?php else: ?>
                <form class="login-form" method="post" action="../login.php">
                    <input class="login-input" type="text" name="usuario" placeholder="Usuario" >
                    <input class="login-input" type="password" name="contraseña" placeholder="Contraseña" >
                    <button class="login-btn" type="submit" >Ingresar</button>
                </form>
            <?php endif; ?>
        </div>
    </nav>
</header>

