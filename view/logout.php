<?php
// Iniciar sesión si no está iniciada
session_start();

// Eliminar la cookie de sesión si existe
if(isset($_COOKIE["usuario_cookie"])) {
    unset($_COOKIE["usuario_cookie"]);
    setcookie("usuario_cookie", null, -1, '/');
}

// Redirigir al usuario a la página de inicio o a donde desees después de cerrar sesión
header("Location: index.php");
exit; // Asegura que el script se detenga después de redirigir al usuario
?>
<?php
