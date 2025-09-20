<?php
include '../app/conexionDB.php';
include '../layouts/sesion.php';

?>


<!DOCTYPE html>
<html lang="es"> <!--begin::Head-->

<head>
    <title>Perfil de Usuario</title><!--begin::Primary Meta Tags-->

    <?php include '../layouts/head.php'; ?>
</head> <!--end::Head--> <!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary"> <!--begin::App Wrapper-->
    <div class="app-wrapper"> <!--begin::Header-->

        <?php include '../layouts/navAside.php'; ?>

        <!--begin::App Main-->
        <main class="app-main"> <!--begin::App Content Header-->
            <div class="app-content-header"> <!--begin::Container-->
                <div class="container-fluid"> <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Perfil del Usuario</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>Inicio</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Perfil Usuario
                                </li>
                            </ol>
                        </div>
                    </div> <!--end::Row-->
                </div> <!--end::Container-->
            </div> <!--end::App Content Header-->

            <!--begin::App Content-->
            <div class="app-content"> <!--begin::Container-->
                <div class="container-fluid">


                    <?php
                    include '../app/controllers/profile/info_perfil.php';
                    ?>



                    <div class="col-md-6">
                        <div class="card card-outline card-success shadow-sm border-0">
                            <div class="card-header bg-success text-white">
                                <h4 class="card-title mb-0"><i class="bi bi-person-circle"></i> Mi Perfil</h4>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool text-white" data-lte-toggle="card-collapse">
                                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">

                                <?php
                                $imagen_perfil = !empty($usuario['foto']) ? '../' . $usuario['foto'] : 'https://cdn-icons-png.flaticon.com/512/3135/3135715.png';
                                ?>
                                <div class="text-center mb-3">
                                    <img src="<?php echo $imagen_perfil; ?>"
                                        alt="Imagen de perfil"
                                        class="rounded-circle shadow-sm border border-2 border-success"
                                        width="120" height="120">
                                </div>

                                <div class="text-end mt-3">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#editarPerfil">
                                        <i class="bi bi-pencil-square"></i> Editar Perfil
                                    </button>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="editarPerfil" tabindex="-1" aria-labelledby="editarPerfilLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="../app/controllers/profile/infor_perfil_editar.php" method="POST" enctype="multipart/form-data">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="editarPerfilLabel">Editar Perfil</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    $imagen_modal = !empty($usuario['foto']) ? '../' . $usuario['foto'] : 'https://cdn-icons-png.flaticon.com/512/3135/3135715.png';
                                                    ?>
                                                    <input type="hidden" name="id_usuario" value="<?php echo $usuario['id_Usuario']; ?>">

                                                    <div class="mb-3">
                                                        <label class="form-label">Nombre del Usuario</label>
                                                        <input type="text" class="form-control" name="nombre_usuario" required value="<?php echo $usuario['nombre_usuario'] ?>">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Correo Electrónico</label>
                                                        <input type="email" class="form-control" name="email" required value="<?php echo $usuario['email']; ?>">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Edad</label>
                                                        <input type="number" class="form-control" name="edad" required value="<?php echo $usuario['edad']; ?>">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Imagen de Perfil</label><br>
                                                        <img src="<?php echo $imagen_modal; ?>" width="100" class="mb-2 rounded-circle border border-success shadow-sm"><br>
                                                        <input type="file" name="foto" class="form-control">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Nueva Contraseña (opcional)</label>
                                                        <input type="password" name="password" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <ul class="list-group list-group-flush mt-3">
                                    <li class="list-group-item">
                                        <strong>Nombre de Usuario:</strong> <?php echo htmlspecialchars($usuario['nombre_usuario']); ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Email:</strong> <?php echo htmlspecialchars($usuario['email']); ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Edad:</strong> <?php echo htmlspecialchars($usuario['edad']); ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Rol:</strong> <?php echo htmlspecialchars($usuario['nombre_rol']); ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Estado:</strong>
                                        <span class="badge bg-<?php echo ($usuario['estado_usuario'] === 'Activo') ? 'success' : 'danger'; ?>">
                                            <?php echo  $usuario['estado_usuario']; ?>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>


                    


                </div> <!--end::Container-->
            </div> <!--end::App Content-->
        </main> <!--end::App Main-->



        <?php include '../layouts/footer.php'; ?>
        <?php include '../layouts/notificacion.php'; ?>





</body><!--end::Body-->

</html>