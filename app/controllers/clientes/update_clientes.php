<?php
// app/controllers/clientes/update_clientes.php

session_start();
require_once '../../conexionDB.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['titulo']  = 'Acceso no permitido';
    $_SESSION['mensaje'] = 'No puedes acceder directamente.';
    $_SESSION['icono']   = 'error';
    header('Location: ' . $URL . 'clientes');
    exit;
}

/* Validar campos obligatorios reales */
if (
    empty($_POST['id_Clientes']) ||
    empty(trim($_POST['nombre_cliente'] ?? '')) ||
    empty($_POST['genero'] ?? '') ||
    empty($_POST['estado'] ?? '')
) {
    $_SESSION['titulo']  = 'Campos incompletos';
    $_SESSION['mensaje'] = 'Nombre, género y estado son obligatorios.';
    $_SESSION['icono']   = 'warning';
    header('Location: ' . $URL . 'clientes');
    exit;
}

/* Asignación correcta según el FORM */
$id        = (int) $_POST['id_Clientes'];
$nombre    = trim($_POST['nombre_cliente']);
$direccion = trim($_POST['direccion'] ?? '');
$telefono  = trim($_POST['telefono'] ?? '');
$correo    = trim($_POST['correo'] ?? '');
$cui       = trim($_POST['dpi_o_nit'] ?? '');
$genero    = $_POST['genero'];
$estado    = $_POST['estado'];

try {

    $sql = "UPDATE clientes SET
                nombre_y_apellido = :nombre,
                direccion_cliente = :direccion,
                telefono_cliente  = :telefono,
                email             = :correo,
                cui               = :cui,
                genero            = :genero,
                estado            = :estado
            WHERE id_Clientes = :id";

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindValue(':direccion', $direccion !== '' ? $direccion : null, $direccion !== '' ? PDO::PARAM_STR : PDO::PARAM_NULL);
    $stmt->bindValue(':telefono',  $telefono  !== '' ? $telefono  : null, $telefono  !== '' ? PDO::PARAM_STR : PDO::PARAM_NULL);
    $stmt->bindValue(':correo',    $correo    !== '' ? $correo    : null, $correo    !== '' ? PDO::PARAM_STR : PDO::PARAM_NULL);
    $stmt->bindValue(':cui',       $cui       !== '' ? $cui       : null, $cui       !== '' ? PDO::PARAM_STR : PDO::PARAM_NULL);
    $stmt->bindValue(':genero', $genero, PDO::PARAM_STR);
    $stmt->bindValue(':estado', $estado, PDO::PARAM_STR);

    $stmt->execute();

    $_SESSION['titulo']  = 'Cliente actualizado';
    $_SESSION['mensaje'] = 'Los datos del cliente fueron actualizados correctamente.';
    $_SESSION['icono']   = 'success';
} catch (PDOException $e) {

    $_SESSION['titulo']  = 'Error';
    $_SESSION['mensaje'] = 'No se pudo actualizar el cliente.';
    $_SESSION['icono']   = 'error';
}

header('Location: ' . $URL . 'clientes');
exit;
