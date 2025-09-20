<?php
include '../../conexionDB.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar datos enviados
    if (
        isset($_POST['id_Roles'], $_POST['nombre_rol'], $_POST['descripcion'], $_POST['estado']) &&
        !empty(trim($_POST['nombre_rol'])) &&
        !empty(trim($_POST['descripcion'])) &&
        !empty(trim($_POST['estado']))
    ) {
        // Sanitizar y asignar variables
        $id_roles = (int) $_POST['id_Roles'];
        $nombre_roles = trim($_POST['nombre_rol']);
        $descripcion_roles = trim($_POST['descripcion']);
        $estado_roles = $_POST['estado'];

        try {
            // Consulta SQL segura
            $sql = "UPDATE roles
                    SET nombre_rol = :nombre_rol,
                        descripcion = :descripcion,
                        estado = :estado
                    WHERE id_Roles = :id_Roles";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nombre_rol', $nombre_roles);
            $stmt->bindParam(':descripcion', $descripcion_roles);
            $stmt->bindParam(':estado', $estado_roles);
            $stmt->bindParam(':id_Roles', $id_roles, PDO::PARAM_INT);
            $stmt->execute();

            // Notificación de éxito
            $_SESSION['titulo'] = '¡Bien Hecho!';
            $_SESSION['mensaje'] = "Datos actualizados correctamente";
            $_SESSION['icono'] = "success";
            header('Location: ' . $URL . 'roles');
            exit;
        } catch (PDOException $e) {
            // Notificación de error
            $_SESSION['titulo'] = '¡Error!';
            $_SESSION['mensaje'] = 'Error al actualizar el rol: ' . $e->getMessage();
            $_SESSION['icono'] = 'error';
            header('Location: ' . $URL . 'roles');
            exit;
        }
    } else {
        // Notificación por campos vacíos
        $_SESSION['titulo'] = '¡Atención!';
        $_SESSION['mensaje'] = 'Por favor, completa todos los campos obligatorios.';
        $_SESSION['icono'] = 'warning';
        header('Location: ' . $URL . 'roles');
        exit;
    }
} else {
    // Acceso no permitido
    $_SESSION['titulo'] = '¡Error!';
    $_SESSION['mensaje'] = 'Acceso no permitido';
    $_SESSION['icono'] = 'error';
    header('Location: ' . $URL . 'roles');
    exit;
}
