 <?php
    $nombre_usuario = $_SESSION['sesion_usuario'];

    $sql = "SELECT u.*, r.nombre_rol FROM usuario u INNER JOIN roles r ON u.id_Roles = r.id_Roles
                            WHERE u.nombre_usuario = :nombre_usuario LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nombre_usuario', $nombre_usuario, PDO::PARAM_STR);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>

