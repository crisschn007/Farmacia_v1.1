<?php
include '../app/conexionDB.php';
include '../layouts/sesion.php';
include '../app/controllers/usuarios/listado_usuarios.php';

if (file_exists('../app/controllers/roles/listado_activo.php')) {
    require_once '../app/controllers/roles/listado_activo.php';
} else {
    echo "<div class='alert alert-danger'>Archivo de roles no encontrado</div>";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Usuarios</title>
    <?php include '../layouts/head.php'; ?>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <?php include '../layouts/navAside.php'; ?>

        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Usuarios</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="app-content">
                <div class="container-fluid">

                    <!-- Botón disparador para agregar nuevo usuario -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUser">
                        <i class="bi bi-person-plus-fill"></i> Agregar Nuevo Usuario
                    </button>

                    <!-- Modal para insertar nuevo usuario -->
                    <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form action="../app/controllers/usuarios/add_usuarios.php" method="POST" enctype="multipart/form-data">
                                    <div class="modal-header bg-primary text-white">
                                        <h1 class="modal-title fs-5" id="addUserLabel"><i class="bi bi-person-plus-fill"></i> Agregar Nuevo Usuario</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="row g-3">
                                            <!-- Nombre de usuario -->
                                            <div class="col-md-6">
                                                <label for="nombre_usuario" class="form-label fw-semibold text-start d-block">Nombre de Usuario</label>
                                                <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control" required>
                                            </div>

                                            <!-- Email -->
                                            <div class="col-md-6">
                                                <label for="email" class="form-label fw-semibold text-start d-block">Correo Electrónico</label>
                                                <input type="email" name="email" id="email" class="form-control" required>
                                            </div>

                                            <!-- Foto -->
                                            <div class="col-md-6">
                                                <label for="foto" class="form-label fw-semibold text-start d-block">Foto de Perfil</label>
                                                <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                                            </div>

                                            <!-- Contraseña -->
                                            <div class="col-md-6">
                                                <label for="password" class="form-label fw-semibold text-start d-block">Contraseña</label>
                                                <input type="password" name="password" id="password" class="form-control" required>
                                            </div>

                                            <!-- Confirmar Contraseña -->
                                            <div class="col-md-6">
                                                <label for="confirm_password" class="form-label fw-semibold text-start d-block">Confirmar Contraseña</label>
                                                <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                                            </div>

                                            <!-- Edad -->
                                            <div class="col-md-6">
                                                <label for="edad" class="form-label fw-semibold text-start d-block">Edad</label>
                                                <input type="number" name="edad" id="edad" class="form-control" min="1" required>
                                            </div>

                                            <!-- Estado -->
                                            <div class="col-md-6">
                                                <label for="estado_usuario" class="form-label fw-semibold text-start d-block">Estado</label>
                                                <select name="estado_usuario" id="estado_usuario" class="form-select" required>
                                                    <option value="" hidden selected> --Seleccione el estado -- </option>
                                                    <option value="Activo">Activo</option>
                                                    <option value="Inactivo">Inactivo</option>
                                                </select>
                                            </div>

                                            <!-- Rol -->
                                            <div class="col-md-6">
                                                <label for="id_Roles" class="form-label fw-semibold text-start d-block">Rol</label>
                                                <select name="id_Roles" id="id_Roles" class="form-select" required>
                                                    <option value="" hidden> --Seleccione un rol-- </option>
                                                    <?php foreach ($roles_activos as $rol) { ?>
                                                        <option value="<?= $rol['id_Roles'] ?>"><?= $rol['nombre_rol'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                                            <i class="bi bi-x-circle"></i> Cancelar
                                        </button>
                                        <button type="submit" class="btn btn-outline-success">
                                            <i class="bi bi-check-circle"></i> Guardar Usuario
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <br><br>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle text-nowrap w-100 text-center" style="min-width: 600px;" id="Usuarios">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre del Usuario</th>
                                    <th>E-Mail</th>
                                    <th>Edad</th>
                                    <th>Estado Del Usuario</th>
                                    <th>Rol Designado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>

                            <tbody class="text-center">
                                <?php
                                $contador_usuario = 0;
                                foreach ($usuario_datos as $usuarios) {
                                    $id_usuario     = $usuarios['id_usuario']; // ajustado a alias
                                    $nombre_usuario = $usuarios['usuario'];
                                    $email_usuario  = $usuarios['email'];
                                    $edad_usuario   = $usuarios['edad'];
                                    $estado_usuario = $usuarios['estado_usuario'];
                                    $nombre_roles   = $usuarios['nombre_rol'];
                                ?>
                                    <tr>
                                        <th scope="row"><?= ++$contador_usuario; ?></th>
                                        <td><?= $nombre_usuario; ?></td>
                                        <td><?= $email_usuario; ?></td>
                                        <td><?= $edad_usuario; ?></td>
                                        <td>
                                            <?php if ($estado_usuario == 'Activo') { ?>
                                                <span class="badge rounded-pill text-bg-success">Activo</span>
                                            <?php } else { ?>
                                                <span class="badge rounded-pill text-bg-danger">Inactivo</span>
                                            <?php } ?>
                                        </td>
                                        <td><?= $nombre_roles; ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info text-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Ver más
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item text-primary" href="#" data-bs-toggle="modal" data-bs-target="#editUser<?= $id_usuario ?>">
                                                            <i class="bi bi-pencil-square"></i> Editar
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item text-danger btn-eliminar" href="#">
                                                            <i class="bi bi-trash-fill"></i> Eliminar
                                                        </a>
                                                    </li>
                                                </ul>

                                                <!-- Modal editar -->
                                                <div class="modal fade" id="editUser<?= $id_usuario ?>" tabindex="-1" aria-labelledby="editUserLabel<?= $id_usuario ?>" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <form action="../app/controllers/usuarios/update_usuarios.php" method="POST" enctype="multipart/form-data">
                                                                <div class="modal-header bg-primary text-white">
                                                                    <h1 class="modal-title fs-5" id="editUserLabel<?= $id_usuario ?>">
                                                                        <i class="bi bi-pencil-square"></i> Actualizar Datos del Usuario
                                                                    </h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <input type="hidden" name="id_usuario" value="<?= $id_usuario ?>">

                                                                    <div class="row g-3">
                                                                        <!-- Nombre de usuario -->
                                                                        <div class="col-md-6">
                                                                            <label for="nombre_usuario<?= $id_usuario ?>" class="form-label">Nombre de Usuario</label>
                                                                            <input type="text" name="nombre_usuario" id="nombre_usuario<?= $id_usuario ?>"
                                                                                class="form-control" value="<?= htmlspecialchars($nombre_usuario) ?>" required>
                                                                        </div>

                                                                        <!-- Email -->
                                                                        <div class="col-md-6">
                                                                            <label for="email<?= $id_usuario ?>" class="form-label">Correo Electrónico</label>
                                                                            <input type="email" name="email" id="email<?= $id_usuario ?>"
                                                                                class="form-control" value="<?= htmlspecialchars($email_usuario) ?>" required>
                                                                        </div>

                                                                        <!-- Foto -->
                                                                        <div class="col-md-6">
                                                                            <label for="foto<?= $id_usuario ?>" class="form-label">Foto de Perfil</label>
                                                                            <input type="file" name="foto" id="foto<?= $id_usuario ?>"
                                                                                class="form-control" accept="image/*">
                                                                        </div>

                                                                        <!-- Contraseña -->
                                                                        <div class="col-md-6">
                                                                            <label for="password<?= $id_usuario ?>" class="form-label">Contraseña (dejar en blanco para no cambiar)</label>
                                                                            <input type="password" name="password" id="password<?= $id_usuario ?>" class="form-control">
                                                                        </div>

                                                                        <!-- Confirmar Contraseña -->
                                                                        <div class="col-md-6">
                                                                            <label for="confirm_password<?= $id_usuario ?>" class="form-label">Confirmar Contraseña</label>
                                                                            <input type="password" name="confirm_password" id="confirm_password<?= $id_usuario ?>" class="form-control">
                                                                        </div>

                                                                        <!-- Edad -->
                                                                        <div class="col-md-6">
                                                                            <label for="edad<?= $id_usuario ?>" class="form-label">Edad</label>
                                                                            <input type="number" name="edad" id="edad<?= $id_usuario ?>"
                                                                                class="form-control" min="1" value="<?= htmlspecialchars($edad_usuario) ?>" required>
                                                                        </div>

                                                                        <!-- Estado -->
                                                                        <div class="col-md-6">
                                                                            <label for="estado_usuario<?= $id_usuario ?>" class="form-label">Estado</label>
                                                                            <select name="estado_usuario" id="estado_usuario<?= $id_usuario ?>" class="form-select" required>
                                                                                <option value="Activo" <?= $estado_usuario == 'Activo' ? 'selected' : '' ?>>Activo</option>
                                                                                <option value="Inactivo" <?= $estado_usuario == 'Inactivo' ? 'selected' : '' ?>>Inactivo</option>
                                                                            </select>
                                                                        </div>

                                                                        <!-- Rol -->
                                                                        <div class="col-md-6">
                                                                            <label for="id_Roles<?= $id_usuario ?>" class="form-label">Rol</label>
                                                                            <select name="id_Roles" id="id_Roles<?= $id_usuario ?>" class="form-select" required>
                                                                                <option value="" hidden> --Seleccione un rol-- </option>
                                                                                <?php foreach ($roles_activos as $rol) { ?>
                                                                                    <option value="<?= $rol['id_Roles'] ?>"
                                                                                        <?= $rol['id_Roles'] == $usuarios['id_Roles'] ? 'selected' : '' ?>>
                                                                                        <?= $rol['nombre_rol'] ?>
                                                                                    </option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                                                                        <i class="bi bi-x-circle"></i> Cancelar
                                                                    </button>
                                                                    <button type="submit" class="btn btn-outline-success">
                                                                        <i class="bi bi-check-circle"></i> Guardar Cambios
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </main>

        <?php include '../layouts/footer.php'; ?>
        <script>
            $(function() {
                $('#Usuarios').DataTable({
                    lengthMenu: [
                        [5, 10, 25, 50, 100],
                        [5, 10, 25, 50, 100]
                    ],
                    language: {
                        decimal: "",
                        emptyTable: "No hay datos disponibles en la tabla",
                        info: "Mostrando _START_ a _END_ de _TOTAL_ Usuarios Registrados",
                        infoEmpty: "Mostrando 0 a 0 de 0 registros",
                        infoFiltered: "(filtrado de _MAX_ registros totales)",
                        lengthMenu: "Mostrar _MENU_ registros",
                        loadingRecords: "Cargando...",
                        processing: "Procesando...",
                        search: "Buscar:",
                        zeroRecords: "No se encontraron coincidencias",
                        paginate: {
                            first: "Primero",
                            last: "Último",
                            next: "Siguiente",
                            previous: "Anterior"
                        },
                        aria: {
                            sortAscending: ": activar para ordenar ascendente",
                            sortDescending: ": activar para ordenar descendente"
                        }
                    }
                });
            });
        </script>

        <?php include '../layouts/notificacion.php'; ?>



    </div>
</body>

</html>