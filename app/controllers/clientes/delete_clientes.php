<?php
include '../../conexionDB.php'; // conexión con $pdo y $URL
session_start();

if (isset($_GET['id'])) {
    $id_cliente = $_GET['id'];

    try {
        // 1. Verificar si el cliente existe
        $check = $pdo->prepare("SELECT * FROM clientes WHERE id_Cliente = :id");
        $check->bindParam(':id', $id_cliente, PDO::PARAM_INT);
        $check->execute();
        $cliente = $check->fetch(PDO::FETCH_ASSOC);

        if ($cliente) {
            // 2. Eliminar cliente
            $query = $pdo->prepare("DELETE FROM clientes WHERE id_Cliente = :id");
            $query->bindParam(':id', $id_cliente, PDO::PARAM_INT);
            $query->execute();
            $_SESSION['titulo'] = '¡Bien Hecho!';
            $_SESSION['mensaje'] = "El cliente '{$cliente['Nombre_Cliente']}' fue eliminado correctamente.";
            $_SESSION['icono'] = "success";
            
        } else {
            // No existe el cliente
            $_SESSION['titulo'] = 'Cliente no encontrado';
            $_SESSION['mensaje'] = "El cliente con ID {$id_cliente} no existe.";
            $_SESSION['icono'] = "warning";
            
        }
    } catch (PDOException $e) {
        $_SESSION['titulo'] = '¡Error!';
        $_SESSION['mensaje'] = "Error al eliminar el cliente: " . $e->getMessage();
        $_SESSION['icono'] = "error";
       
    }
} else {$_SESSION['titulo'] = '¡Atencion!';
    $_SESSION['mensaje'] = "ID de cliente no especificado.";
    $_SESSION['icono'] = "warning";
   
}

// Redirigir a la vista principal
header("Location: " . $URL . "clientes");
exit();
