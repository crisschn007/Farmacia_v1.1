<?php
/*app/controllers/auth/ingreso.php */
include '../../conexionDB.php';
session_start();

if (isset($_POST['username_email'], $_POST['password'])) {
    $username_email = filter_var(trim($_POST['username_email']), FILTER_SANITIZE_STRING);
    $password = trim($_POST['password']);

    // Buscar por nombre de usuario o email
    $sql = "SELECT * FROM usuario 
            WHERE (nombre_usuario = :username OR email = :username) 
            AND estado_usuario = 'Activo'";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username_email, PDO::PARAM_STR);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        if (password_verify($password, $usuario['password'])) {
            // Guardar variables de sesión
            $_SESSION['sesion_usuario'] = $usuario['nombre_usuario'];
            $_SESSION['id_usuario'] = $usuario['id_Usuario'];
            $_SESSION['id_rol'] = $usuario['id_Roles'];
            $_SESSION['nombre'] = $usuario['nombre_usuario']; // Puedes cambiarlo por otro campo si quieres

            /*
            $_SESSION['titulo'] = '¡Bienvenido!';
            $_SESSION['mensaje'] = 'Has iniciado sesión correctamente.';
            $_SESSION['icono'] = 'success';
            */

            header("Location: " . $URL . "index.php");
            exit();
        } else {
            $_SESSION['titulo'] = 'Contraseña incorrecta';
            $_SESSION['mensaje'] = 'La contraseña ingresada no es válida.';
            $_SESSION['icono'] = 'error';
        }
    } else {
        $_SESSION['titulo'] = 'Usuario no válido';
        $_SESSION['mensaje'] = 'El usuario no existe o está inactivo.';
        $_SESSION['icono'] = 'warning';
    }
} else {
    $_SESSION['titulo'] = 'Campos requeridos';
    $_SESSION['mensaje'] = 'Por favor, completa todos los campos.';
    $_SESSION['icono'] = 'info';
}

// Redirigir al login
header("Location: " . $URL . "auth");
exit();
