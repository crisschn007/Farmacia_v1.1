<?php
try {
    $sql_user = "SELECT us.id_Usuario AS id_usuario,
                        us.nombre_usuario AS usuario,
                        us.email AS email,
                        us.edad,
                        us.estado_usuario,
                        us.id_Roles,
                        rol.nombre_rol
                 FROM usuario AS us
                 INNER JOIN roles AS rol
                 ON us.id_Roles = rol.id_Roles;";

    $query_user = $pdo->prepare($sql_user);
    $query_user->execute();
    $usuario_datos = $query_user->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error al Consultar Usuarios: " . $e->getMessage();
}
