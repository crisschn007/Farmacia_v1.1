<?php
// Ruta: ../app/controllers/roles/delete_rol.php

include '../../conexionDB.php'; // Ya incluye $pdo y $URL
session_start();

// Verificamos si se recibe un ID por GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Verificamos si el rol existe
    $consulta = $pdo->prepare("SELECT * FROM roles WHERE id_Roles = :id");
    $consulta->bindParam(':id', $id);
    $consulta->execute();

    if ($consulta->rowCount() > 0) {
        // Procedemos a eliminar
        $eliminar = $pdo->prepare("DELETE FROM roles WHERE id_Roles = :id");
        $eliminar->bindParam(':id', $id);

        if ($eliminar->execute()) {
            // Notificación de éxito
            $_SESSION['titulo'] = '¡Bien Hecho!';
            $_SESSION['mensaje'] = 'Rol eliminado correctamente';
            $_SESSION['icono'] = 'success';
            header('Location: ' . $URL . 'roles');
            exit;
        } else {
            // Error al eliminar
            $_SESSION['titulo'] = '¡Error!';
            $_SESSION['mensaje'] = 'No se pudo eliminar el rol';
            $_SESSION['icono'] = 'error';
            header('Location: ' . $URL . 'roles');
            exit;
        }
    } else {
        // El rol no existe
        $_SESSION['titulo'] = 'Rol no encontrado';
        $_SESSION['mensaje'] = 'El rol que intentas eliminar no existe';
        $_SESSION['icono'] = 'warning';
        header('Location: ' . $URL . 'roles');
        exit;
    }
} else {
    // No se envió ID
    $_SESSION['titulo'] = 'Petición inválida';
    $_SESSION['mensaje'] = 'No se especificó el rol a eliminar';
    $_SESSION['icono'] = 'error';
    header('Location: ' . $URL . 'roles');
    exit;
}

// Redirigimos al listado de roles
header('Location: ' . $URL . 'roles');
exit;


