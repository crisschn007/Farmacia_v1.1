<?php
// app/controllers/usuarios/update_usuarios.php
include '../../conexionDB.php';
session_start();

$ruta_imagenes = __DIR__ . '/../../../img/usuarios/';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {
        // 1. Capturar datos
        $id_usuario      = $_POST['id_usuario'];
        $nombre_usuario  = trim($_POST['nombre_usuario']);
        $email           = trim($_POST['email']);
        $edad            = $_POST['edad'];
        $estado_usuario  = $_POST['estado_usuario'];
        $id_Roles        = $_POST['id_Roles'];
        $password        = $_POST['password'];
        $confirm         = $_POST['confirm_password'];

        // 2. Obtener foto actual
        $sql_foto = "SELECT foto FROM usuario WHERE id_Usuario = :id";
        $stmt_foto = $pdo->prepare($sql_foto);
        $stmt_foto->bindParam(':id', $id_usuario);
        $stmt_foto->execute();
        $foto_actual = $stmt_foto->fetchColumn();

        $nueva_foto = $foto_actual;

        // 3. Procesar nueva imagen (si existe)
        if (!empty($_FILES['foto']['name'])) {
            $nombre_img = time() . '_' . basename($_FILES['foto']['name']);
            $destino = $ruta_imagenes . $nombre_img;

            if (!move_uploaded_file($_FILES['foto']['tmp_name'], $destino)) {
                throw new Exception("Error al subir la imagen.");
            }

            $nueva_foto = 'img/usuarios/' . $nombre_img;
        }

        // 4. Validar contraseña (si se intenta cambiar)
        if (!empty($password) || !empty($confirm)) {

            if ($password !== $confirm) {
                throw new Exception("Las contraseñas no coinciden.");
            }

            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $sql = "UPDATE usuario SET
                        nombre_usuario = :nombre,
                        email = :email,
                        edad = :edad,
                        estado_usuario = :estado,
                        id_Roles = :rol,
                        foto = :foto,
                        password = :password
                    WHERE id_Usuario = :id";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':password', $password_hash);

        } else {

            $sql = "UPDATE usuario SET
                        nombre_usuario = :nombre,
                        email = :email,
                        edad = :edad,
                        estado_usuario = :estado,
                        id_Roles = :rol,
                        foto = :foto
                    WHERE id_Usuario = :id";

            $stmt = $pdo->prepare($sql);
        }

        // 5. Bind comunes
        $stmt->bindParam(':nombre', $nombre_usuario);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':edad', $edad);
        $stmt->bindParam(':estado', $estado_usuario);
        $stmt->bindParam(':rol', $id_Roles);
        $stmt->bindParam(':foto', $nueva_foto);
        $stmt->bindParam(':id', $id_usuario);

        // 6. Ejecutar
        if ($stmt->execute()) {
            $_SESSION['titulo'] = 'Usuario actualizado';
            $_SESSION['mensaje'] = 'Los datos del usuario se actualizaron correctamente.';
            $_SESSION['icono'] = 'success';
        } else {
            throw new Exception("Error al actualizar el usuario.");
        }

    } catch (Exception $e) {
        $_SESSION['titulo'] = 'Error';
        $_SESSION['mensaje'] = $e->getMessage();
        $_SESSION['icono'] = 'error';
    }

    header('Location: ' . $URL . 'usuarios');
    exit;

} else {
    $_SESSION['titulo'] = 'Acceso denegado';
    $_SESSION['mensaje'] = 'Método no permitido.';
    $_SESSION['icono'] = 'error';
    header('Location: ' . $URL . 'usuarios');
    exit;
}
