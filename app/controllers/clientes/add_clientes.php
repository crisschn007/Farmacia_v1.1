<?php

include '../../conexionDB.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset(
            $_POST['nombre_cliente'],
            $_POST['dpi_o_nit'],
            $_POST['telefono'],
            $_POST['correo'],
            $_POST['direccion']
        ) &&
        !empty(trim($_POST['nombre_cliente'])) &&
        !empty(trim($_POST['dpi_o_nit'])) &&
        !empty(trim($_POST['telefono'])) &&
        !empty(trim($_POST['correo'])) &&
        !empty(trim($_POST['direccion']))
    ) {
        $nombre_clientes = trim($_POST['nombre_cliente']);
        $dpi_nit = trim($_POST['dpi_o_nit']);
        $telefono_c = trim($_POST['telefono']);
        $correo_c = trim($_POST['correo']);
        $direccion_c = trim($_POST['direccion']);

        try {
            // Preparar la consulta de inserción
            $sql = "INSERT INTO clientes (Nombre_Cliente,
                    DPI_o_NIT, Telefono, Correo, Direccion)
                    VALUES (:nombre_cliente, :dpi_o_nit, :telefono, :correo, :direccion);";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nombre_cliente', $nombre_clientes);
            $stmt->bindParam(':dpi_o_nit', $dpi_nit);
            $stmt->bindParam(':telefono', $telefono_c);
            $stmt->bindParam(':correo', $correo_c);
            $stmt->bindParam(':direccion', $direccion_c);
            
            $stmt->execute();

            // Notificación de éxito
            $_SESSION['titulo'] = '¡Cliente Agregado!';
            $_SESSION['mensaje'] = 'El cliente ha sido registrado correctamente.';
            $_SESSION['icono'] = 'success';
            header('Location: ' . $URL . 'clientes');
            exit;
        } catch (PDOException $e) {
             // Notificación de error
            $_SESSION['titulo'] = '¡Error!';
            $_SESSION['mensaje'] = 'No se Puede Registrar el nuevo cliente: '. $e->getMessage();
            $_SESSION['icono'] = 'error';
            header('Location: ' . $URL . 'clientes');
        }
    } else {
        // Notificación si faltan campos
        $_SESSION['titulo'] = '¡Atención!';
        $_SESSION['mensaje'] = 'Todos los campos son obligatorios.';
        $_SESSION['icono'] = 'warning';
        header('Location: ' . $URL . 'clientes');
        exit;
    }
} else {
    // Acceso indebido
    $_SESSION['titulo'] = '¡Acceso no permitido!';
    $_SESSION['mensaje'] = 'No tienes permiso para acceder a esta función.';
    $_SESSION['icono'] = 'error';
    header('Location: ' . $URL . 'clientes');
    exit;
}
