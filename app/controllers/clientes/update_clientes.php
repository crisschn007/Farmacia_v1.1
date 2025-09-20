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
        $id_clientes = (int) $_POST['id_Cliente'];
        $nombre_clientes = trim($_POST['nombre_cliente']);
        $dpi_nit = trim($_POST['dpi_o_nit']);
        $telefono_c = trim($_POST['telefono']);
        $correo_c = trim($_POST['correo']);
        $direccion_c = trim($_POST['direccion']);

        try {
            $sql = "UPDATE clientes
        SET Nombre_Cliente = :nombre_cliente,
            DPI_o_NIT = :dpi_o_nit,
            Telefono = :telefono,
            Correo = :correo,
            Direccion = :direccion
        WHERE id_Cliente = :id_Cliente";


            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nombre_cliente', $nombre_clientes);
            $stmt->bindParam(':dpi_o_nit', $dpi_nit);
            $stmt->bindParam(':telefono', $telefono_c);
            $stmt->bindParam(':correo', $correo_c);
            $stmt->bindParam(':direccion', $direccion_c);
            $stmt->bindParam(':id_Cliente', $id_clientes, PDO::PARAM_INT);
            $stmt->execute();

            // Notificación de éxito
            $_SESSION['titulo'] = '¡Bien Hecho!';
            $_SESSION['mensaje'] = "Datos del cliente actualizados correctamente";
            $_SESSION['icono'] = "success";
            header('Location: ' . $URL . 'clientes');
            exit;
        } catch (PDOException $e) {
            // Notificación de error
            $_SESSION['titulo'] = '¡Error!';
            $_SESSION['mensaje'] = 'No se Puede acualizar los datos del cliente: ' . $e->getMessage();
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
