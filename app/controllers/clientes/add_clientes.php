<?php
// app/controllers/clientes/add_clientes.php

session_start();
require_once '../../conexionDB.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['titulo']  = 'Acceso no permitido';
    $_SESSION['mensaje'] = 'No puedes acceder directamente.';
    $_SESSION['icono']   = 'error';
    header('Location: ' . $URL . 'clientes');
    exit;
}

/* Validación de campos obligatorios reales */
if (
    empty(trim($_POST['nombre_completo'] ?? '')) ||
    empty($_POST['genero_Cliente'] ?? '') ||
    empty($_POST['estado_Cliente'] ?? '')
) {
    $_SESSION['titulo']  = 'Campos incompletos';
    $_SESSION['mensaje'] = 'Nombre, género y estado son obligatorios.';
    $_SESSION['icono']   = 'warning';
    header('Location: ' . $URL . 'clientes');
    exit;
}

/* Asignación segura */
$nombre    = trim($_POST['nombre_completo']);
$direccion = trim($_POST['direccion_Cliente'] ?? '');
$telefono  = trim($_POST['telefono_Cliente'] ?? '');
$email     = trim($_POST['email_Cliente'] ?? '');
$cui       = trim($_POST['cui_Cliente'] ?? '');
$genero    = $_POST['genero_Cliente'];
$estado    = $_POST['estado_Cliente'];

try {

    $sql = "INSERT INTO clientes 
        (nombre_y_apellido, direccion_cliente, telefono_cliente, email, cui, genero, estado)
        VALUES
        (:nombre, :direccion, :telefono, :email, :cui, :genero, :estado)";

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindValue(':direccion', $direccion !== '' ? $direccion : null, $direccion !== '' ? PDO::PARAM_STR : PDO::PARAM_NULL);
    $stmt->bindValue(':telefono',  $telefono  !== '' ? $telefono  : null, $telefono  !== '' ? PDO::PARAM_STR : PDO::PARAM_NULL);
    $stmt->bindValue(':email',     $email     !== '' ? $email     : null, $email     !== '' ? PDO::PARAM_STR : PDO::PARAM_NULL);
    $stmt->bindValue(':cui',       $cui       !== '' ? $cui       : null, $cui       !== '' ? PDO::PARAM_STR : PDO::PARAM_NULL);
    $stmt->bindValue(':genero', $genero, PDO::PARAM_STR);
    $stmt->bindValue(':estado', $estado, PDO::PARAM_STR);

    $stmt->execute();

    $_SESSION['titulo']  = 'Cliente registrado';
    $_SESSION['mensaje'] = 'El cliente fue agregado correctamente.';
    $_SESSION['icono']   = 'success';
} catch (PDOException $e) {

    $_SESSION['titulo']  = 'Error';
    $_SESSION['mensaje'] = 'No se pudo registrar el cliente.';
    $_SESSION['icono']   = 'error';
}

header('Location: ' . $URL . 'clientes');
exit;
