<?php
/*app/controllers/usuarios/add_usuarios.php*/
include '../../conexionDB.php';
session_start();


$ruta_imagenes = __DIR__ . '/../../../img/usuarios/'; //no modificar la ruta donde guarda la imagen del usuario


// Comprobamos que la carpeta existe, si no, la creamos
if (!is_dir($ruta_imagenes)) {
    mkdir($ruta_imagenes, 0775, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Validar campos obligatorios
        if (
            empty($_POST['nombre_usuario']) ||
            empty($_POST['email']) ||
            empty($_POST['password']) ||
            empty($_POST['confirm_password']) ||
            empty($_POST['edad']) ||
            empty($_POST['estado_usuario']) ||
            empty($_POST['id_Roles'])
        ) {
            throw new Exception("Todos los campos son obligatorios.");
        }

        // Validar contraseñas
        if ($_POST['password'] !== $_POST['confirm_password']) {
            throw new Exception("Las contraseñas no coinciden.");
        }

        // Guardar datos sanitizados
        $nombre_usuario = trim($_POST['nombre_usuario']);
        $email = trim($_POST['email']);
        $password_hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $edad = intval($_POST['edad']);
        $estado_usuario = $_POST['estado_usuario'];
        $id_Roles = intval($_POST['id_Roles']);

        // Manejo de imagen
        $nombre_foto = null;
        if (!empty($_FILES['foto']['name'])) {
            // Validar formato
            $extension = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
            $tipos_permitidos = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

            if (!in_array($extension, $tipos_permitidos)) {
                throw new Exception("Formato de imagen no permitido.");
            }

            // Nombre único
            $nombre_foto = uniqid('user_', true) . '.' . $extension;

            // Intentar mover archivo
            if (!move_uploaded_file($_FILES['foto']['tmp_name'], $ruta_imagenes . $nombre_foto)) {
                throw new Exception("Error al guardar la imagen. Código de error: " . $_FILES['foto']['error']);
            }
        }

        // Insertar usuario en la base de datos
        $sql = "INSERT INTO usuario
        (nombre_usuario, email, foto, password, edad, estado_usuario, id_Roles)
        VALUES
        (:nombre_usuario, :email, :foto, :password, :edad, :estado_usuario, :id_Roles)";


        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nombre_usuario', $nombre_usuario);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':foto', $nombre_foto);
        $stmt->bindParam(':password', $password_hash);
        $stmt->bindParam(':edad', $edad, PDO::PARAM_INT);
        $stmt->bindParam(':estado_usuario', $estado_usuario);
        $stmt->bindParam(':id_Roles', $id_Roles, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $_SESSION['titulo'] = '¡Usuario Agregado!';
            $_SESSION['mensaje'] = 'El nuevo usuario ha sido registrado correctamente.';
            $_SESSION['icono'] = 'success';
        } else {
            throw new Exception("Error al registrar el usuario.");
        }
    } catch (Exception $e) {
        $_SESSION['titulo'] = 'Error';
        $_SESSION['mensaje'] = $e->getMessage();
        $_SESSION['icono'] = 'error';
    }

    header('Location: ' . $URL . 'usuarios');
    exit;
} else {
    $_SESSION['titulo'] = 'Acceso Denegado';
    $_SESSION['mensaje'] = 'Método no permitido.';
    $_SESSION['icono'] = 'error';
    header('Location: ' . $URL . 'usuarios');
    exit;
}
