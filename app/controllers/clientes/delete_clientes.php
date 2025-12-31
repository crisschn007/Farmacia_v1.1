<?php
// app/controllers/clientes/delete_clientes.php

session_start();
require_once '../../conexionDB.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['titulo']  = '¡Atención!';
    $_SESSION['mensaje'] = 'ID de cliente inválido o no especificado.';
    $_SESSION['icono']   = 'warning';
    header('Location: ' . $URL . 'clientes');
    exit;
}

$id_cliente = (int) $_GET['id'];

try {

    // 1. Verificar existencia y estado del cliente
    $sql = "SELECT nombre_y_apellido, estado 
            FROM clientes 
            WHERE id_Clientes = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id_cliente, PDO::PARAM_INT);
    $stmt->execute();

    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$cliente) {
        $_SESSION['titulo']  = 'Cliente no encontrado';
        $_SESSION['mensaje'] = 'El cliente que intentas eliminar no existe.';
        $_SESSION['icono']   = 'warning';
        header('Location: ' . $URL . 'clientes');
        exit;
    }

    // 2. Validar estado
    if ($cliente['estado'] === 'Activo') {

        $_SESSION['titulo']  = 'Acción no permitida';
        $_SESSION['mensaje'] = "El cliente '{$cliente['nombre_y_apellido']}' está ACTIVO. "
            . "Debes cambiar su estado a INACTIVO antes de eliminarlo.";
        $_SESSION['icono']   = 'warning';
    } else {

        // 3. Eliminar físicamente
        $delete = $pdo->prepare(
            "DELETE FROM clientes WHERE id_Clientes = :id"
        );
        $delete->bindValue(':id', $id_cliente, PDO::PARAM_INT);
        $delete->execute();

        $_SESSION['titulo']  = 'Cliente eliminado';
        $_SESSION['mensaje'] = "El cliente '{$cliente['nombre_y_apellido']}' fue eliminado correctamente.";
        $_SESSION['icono']   = 'success';
    }
} catch (PDOException $e) {

    $_SESSION['titulo']  = '¡Error!';
    $_SESSION['mensaje'] = 'Ocurrió un error al eliminar el cliente.';
    $_SESSION['icono']   = 'error';
}

// Redirección final
header('Location: ' . $URL . 'clientes');
exit;
