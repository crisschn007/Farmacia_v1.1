<?php
// app/controllers/categorias/update_Categorias.php

session_start();
require_once '../../conexionDB.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (
        isset($_POST['id_Categoria'], $_POST['nombre'], $_POST['descripcion'], $_POST['estado']) &&
        trim($_POST['nombre']) !== '' &&
        trim($_POST['descripcion']) !== '' &&
        trim($_POST['estado']) !== ''
    ) {

        $id_categoria = $_POST['id_Categoria'];
        $nombre = trim($_POST['nombre']);
        $descripcion = trim($_POST['descripcion']);
        $estado = $_POST['estado'];

        try {
            $sql = "UPDATE categoria
                    SET nombre = :nombre,
                        descripcion = :descripcion,
                        estado = :estado
                    WHERE id_Categoria = :id";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':id', $id_categoria, PDO::PARAM_INT);

            $stmt->execute();

            $_SESSION['titulo'] = 'Categoría actualizada';
            $_SESSION['mensaje'] = 'Los datos se modificaron correctamente.';
            $_SESSION['icono'] = 'success';

        } catch (PDOException $e) {

            $_SESSION['titulo'] = 'Error';
            $_SESSION['mensaje'] = 'No se pudo actualizar la categoría.';
            $_SESSION['icono'] = 'error';
        }

    } else {

        $_SESSION['titulo'] = 'Campos incompletos';
        $_SESSION['mensaje'] = 'Todos los campos son obligatorios.';
        $_SESSION['icono'] = 'warning';
    }

} else {

    $_SESSION['titulo'] = 'Acceso no permitido';
    $_SESSION['mensaje'] = 'Método no autorizado.';
    $_SESSION['icono'] = 'error';
}

header('Location: ' . $URL . 'categorias');
exit;
