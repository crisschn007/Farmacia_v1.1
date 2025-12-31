<?php
include '../../conexionDB.php';
session_start();

if (!isset($_GET['id'])) {
    $_SESSION['titulo'] = 'Error';
    $_SESSION['mensaje'] = 'ID de usuario no válido.';
    $_SESSION['icono'] = 'error';
    header('Location: ' . $URL . 'usuarios');
    exit;
}

$id_usuario = (int) $_GET['id'];

try {

    /* 1️⃣ Consultar estado actual del usuario */
    $sql_estado = "SELECT estado_usuario FROM usuario WHERE id_Usuario = :id";
    $stmt_estado = $pdo->prepare($sql_estado);
    $stmt_estado->bindParam(':id', $id_usuario, PDO::PARAM_INT);
    $stmt_estado->execute();

    $usuario = $stmt_estado->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        throw new Exception('El usuario no existe.');
    }

    /* 2️⃣ Si está ACTIVO → NO eliminar */
    if ($usuario['estado_usuario'] === 'Activo') {
        $_SESSION['titulo'] = 'Acción no permitida';
        $_SESSION['mensaje'] = 'No se puede eliminar un usuario activo. Primero debe desactivarse.';
        $_SESSION['icono'] = 'warning';

        header('Location: ' . $URL . 'usuarios');
        exit;
    }

    /* 3️⃣ Si está INACTIVO → eliminar definitivamente */
    $sql_delete = "DELETE FROM usuario WHERE id_Usuario = :id";
    $stmt_delete = $pdo->prepare($sql_delete);
    $stmt_delete->bindParam(':id', $id_usuario, PDO::PARAM_INT);

    if ($stmt_delete->execute()) {
        $_SESSION['titulo'] = 'Usuario eliminado';
        $_SESSION['mensaje'] = 'El usuario fue eliminado permanentemente del sistema.';
        $_SESSION['icono'] = 'success';
    } else {
        throw new Exception('No se pudo eliminar el usuario.');
    }

} catch (Exception $e) {
    $_SESSION['titulo'] = 'Error';
    $_SESSION['mensaje'] = $e->getMessage();
    $_SESSION['icono'] = 'error';
}

header('Location: ' . $URL . 'usuarios');
exit;
