<?php
session_start();
require_once '../../conexionDB.php';

if (!isset($_GET['id'])) {
    $_SESSION['titulo'] = 'Error';
    $_SESSION['mensaje'] = 'ID de categoría no válido.';
    $_SESSION['icono'] = 'error';
    header('Location: ' . $URL . 'categorias');
    exit;
}

$id_categoria = $_GET['id'];

try {

    // 1. Consultar estado actual
    $sql_estado = "SELECT estado FROM categoria WHERE id_Categoria = :id";
    $stmt_estado = $pdo->prepare($sql_estado);
    $stmt_estado->bindParam(':id', $id_categoria, PDO::PARAM_INT);
    $stmt_estado->execute();

    $categoria = $stmt_estado->fetch(PDO::FETCH_ASSOC);

    if (!$categoria) {
        $_SESSION['titulo'] = 'Error';
        $_SESSION['mensaje'] = 'La categoría no existe.';
        $_SESSION['icono'] = 'error';
        header('Location: ' . $URL . 'categorias');
        exit;
    }

    // 2. Validar estado
    if ($categoria['estado'] === 'Activo') {
        $_SESSION['titulo'] = 'Acción no permitida';
        $_SESSION['mensaje'] = 'No se puede eliminar una categoría activa. Primero desactívela.';
        $_SESSION['icono'] = 'warning';
        header('Location: ' . $URL . 'categorias');
        exit;
    }

    // 3. Eliminar físicamente (solo si está Inactivo)
    $sql_delete = "DELETE FROM categoria WHERE id_Categoria = :id";
    $stmt_delete = $pdo->prepare($sql_delete);
    $stmt_delete->bindParam(':id', $id_categoria, PDO::PARAM_INT);
    $stmt_delete->execute();

    $_SESSION['titulo'] = 'Categoría eliminada';
    $_SESSION['mensaje'] = 'La categoría fue eliminada correctamente.';
    $_SESSION['icono'] = 'success';

    header('Location: ' . $URL . 'categorias');
    exit;

} catch (PDOException $e) {

    $_SESSION['titulo'] = 'Error';
    $_SESSION['mensaje'] = 'Error al eliminar la categoría: ' . $e->getMessage();
    $_SESSION['icono'] = 'error';
    header('Location: ' . $URL . 'categorias');
    exit;
}
