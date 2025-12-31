<?php
// app/controllers/categorias/add_Categorias.php
include '../../conexionDB.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (
        isset($_POST['nombre'], $_POST['descripcion'], $_POST['estado']) &&
        trim($_POST['nombre']) !== '' &&
        trim($_POST['descripcion']) !== '' &&
        trim($_POST['estado']) !== ''
    ) {

        $nombre = trim($_POST['nombre']);
        $descripcion = trim($_POST['descripcion']);
        $estado = $_POST['estado'];

        try {
            $sql = "INSERT INTO Categoria (nombre, descripcion, estado)
                    VALUES (:nombre, :descripcion, :estado)";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':estado', $estado);
            $stmt->execute();

            $_SESSION['titulo'] = '¡Categoría registrada!';
            $_SESSION['mensaje'] = 'La categoría se agregó correctamente.';
            $_SESSION['icono'] = 'success';

        } catch (PDOException $e) {

            $_SESSION['titulo'] = 'Error';
            $_SESSION['mensaje'] = 'No se pudo guardar la categoría.';
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
