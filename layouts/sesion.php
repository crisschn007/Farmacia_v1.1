<?php
/* layouts/sesion.php */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Evita el caché del navegador para impedir volver con el botón atrás
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
header('Expires: 0');

if (isset($_SESSION['sesion_usuario'])) {
    $nombre_usuario = $_SESSION['sesion_usuario'];

    $sql = "SELECT * FROM usuario
            WHERE nombre_usuario = :nombre_usuario
            AND estado_usuario = 'Activo'";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nombre_usuario', $nombre_usuario, PDO::PARAM_STR);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        // Ya se guardaron estos datos en ingreso.php, pero puedes actualizarlos si deseas
        $_SESSION['id_usuario'] = $usuario['id_Usuario'];
        $_SESSION['id_rol'] = $usuario['id_Roles'];
        $_SESSION['nombre'] = $usuario['nombre_usuario']; // o cualquier otro campo visible
    } else {
        // Usuario no válido
        header('Location: ' . $URL . 'auth');
        exit();
    }
} else {
    // No ha iniciado sesión
    header('Location: ' . $URL . 'auth');
    exit();
}