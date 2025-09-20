<?php
// Ruta: ../app/controllers/profile/infor_perfil_editar.php

include '../../conexionDB.php';
session_start();

$id_usuario = $_POST['id_usuario'];
$email = trim($_POST['email']);
$edad = intval($_POST['edad']);
$nueva_contrasena = $_POST['password'];

// Verifica si se subió una nueva imagen
if (!empty($_FILES['foto']['name'])) {
    // Ruta física desde este archivo hacia ../../img/usuarios/ (la carpeta azul)
    $carpeta = __DIR__ . '/../../../img/usuarios/';

    // Crea la carpeta si no existe
    if (!file_exists($carpeta)) {
        mkdir($carpeta, 0777, true);
    }

    // Generar nombre único para el archivo
    $nombre_archivo = uniqid() . "_" . basename($_FILES['foto']['name']);

    // Ruta física absoluta donde se moverá el archivo
    $ruta_fisica = $carpeta . $nombre_archivo;

    // Ruta relativa que se guarda en la base de datos
    $ruta_guardar_bd = 'img/usuarios/' . $nombre_archivo;

    // Mover la imagen al servidor
    if (move_uploaded_file($_FILES['foto']['tmp_name'], $ruta_fisica)) {
        // Actualizar datos con la nueva imagen
        $sql = "UPDATE usuario SET email = :email, edad = :edad, foto = :foto WHERE id_Usuario = :id_usuario";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':email' => $email,
            ':edad' => $edad,
            ':foto' => $ruta_guardar_bd,
            ':id_usuario' => $id_usuario
        ]);
    }
} else {
    // Si no se subió imagen, actualizar solo email y edad
    $sql = "UPDATE usuario SET email = :email, edad = :edad WHERE id_Usuario = :id_usuario";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':email' => $email,
        ':edad' => $edad,
        ':id_usuario' => $id_usuario
    ]);
}

// Si se ingresó una nueva contraseña, actualizarla
if (!empty($nueva_contrasena)) {
    $hash = password_hash($nueva_contrasena, PASSWORD_DEFAULT);
    $sql_pass = "UPDATE usuario SET password = :password WHERE id_Usuario = :id_usuario";
    $stmt_pass = $pdo->prepare($sql_pass);
    $stmt_pass->execute([
        ':password' => $hash,
        ':id_usuario' => $id_usuario
    ]);
}

// Notificación con SweetAlert
$_SESSION['titulo'] = "Perfil actualizado";
$_SESSION['mensaje'] = "Tus datos se guardaron correctamente.";
$_SESSION['icono'] = "success";

// Redirección al perfil
header('Location: ' . $URL . 'profile');
exit;
