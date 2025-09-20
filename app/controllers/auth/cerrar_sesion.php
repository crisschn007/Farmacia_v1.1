<?php
include'../../conexionDB.php';

session_start();

if (isset($_SESSION['sesion_usuario'])) {
    // Elimina todas las variables de sesión
    $_SESSION = [];

    // Destruye la sesión
    session_destroy();
}

// Redirige siempre al login (carpeta auth)
header('Location: ' . $URL . '/auth');
exit();