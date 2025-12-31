<?php
session_start();

/* Ruta segura */
include __DIR__ . '/../../conexionDB.php';

if (!empty($_POST['username_email']) && !empty($_POST['password'])) {

    $username_email = trim($_POST['username_email']);
    $password = trim($_POST['password']);

    // Buscar el usuario por username o email
    $sql = "SELECT * FROM usuario
            WHERE (nombre_usuario = :username OR email = :username)
            AND estado_usuario = 'Activo'";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username_email, PDO::PARAM_STR);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {

        // Verificación de contraseña
        if (password_verify($password, $usuario['password'])) {

            // Guardar las variables de sesión
            $_SESSION['sesion_usuario'] = $usuario['nombre_usuario'];
            $_SESSION['id_usuario'] = $usuario['id_Usuario'];
            $_SESSION['id_rol'] = $usuario['id_Roles'];
            $_SESSION['nombre'] = $usuario['nombre_usuario'];

            // Notificación de éxito
            $_SESSION['titulo'] = "¡Bienvenido!";
            $_SESSION['mensaje'] = "Has iniciado sesión correctamente.";
            $_SESSION['icono'] = "success";

            header("Location: " . $URL . "index.php");
            exit();
        } else {

            // Contraseña incorrecta
            $_SESSION['titulo'] = "Contraseña incorrecta";
            $_SESSION['mensaje'] = "La contraseña ingresada no es válida.";
            $_SESSION['icono'] = "error";

            header("Location: " . $URL . "auth/");
            exit();
        }

    } else {

        // Usuario no encontrado
        $_SESSION['titulo'] = "Usuario no válido";
        $_SESSION['mensaje'] = "El usuario no existe o está inactivo.";
        $_SESSION['icono'] = "warning";

        header("Location: " . $URL . "auth/");
        exit();
    }

} else {

    // Campos vacíos
    $_SESSION['titulo'] = "Campos requeridos";
    $_SESSION['mensaje'] = "Por favor completa todos los campos.";
    $_SESSION['icono'] = "info";

    header("Location: " . $URL . "auth/");
    exit();
}
