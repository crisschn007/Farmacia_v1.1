<?php
include '../app/conexionDB.php';
include '../layouts/sesion.php';
include '../app/controllers/categorias/listado_Categorias.php';
?>


<!DOCTYPE html>
<html lang="es"> <!--begin::Head-->

<head>
    <title>Categorias</title><!--begin::Primary Meta Tags-->

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
                            <h3 class="mb-0">Categorias</h3>
                        </div>



                    </div> <!--end::Row-->
                </div> <!--end::Container-->
            </div> <!--end::App Content Header--> <!--begin::App Content-->
            <div class="app-content"> <!--begin::Container-->
                <div class="container-fluid">

                    <!-- Modal -->
                    <div class="modal fade" id="agregarCategoria" tabindex="-1" aria-labelledby="agregarCategoriaLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="../app/controllers/categorias/add_Categorias.php" method="post">
                                    <div class="modal-header bg-primary text-white">
                                        <h1 class="modal-title fs-5" id="agregarCategoriaLabel"><i class="bi bi-bookmark-plus"></i> Agregar Nueva Categoria</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label>Nombre de Categoría</label>
                                            <input type="text" name="nombre" maxlength="100" class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label>Descripción</label>
                                            <textarea name="descripcion" class="form-control"></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label>Estado</label>
                                            <select name="estado" class="form-select">
                                                <option value="" hidden>-- Seleccione --</option>
                                                <option value="Activo">Activo</option>
                                                <option value="Inactivo">Inactivo</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-success">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="card card-outline card-success">
                            <div class="card-header">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarCategoria">
                                    <i class="bi bi-bookmark-plus-fill"></i> Agregar Categoria
                                </button>
                            </div> <!-- /.card-header -->
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover align-middle text-nowrap w-100 text-center " style="min-width: 600px;" id="Categorias">
                                        <thead class="table-dark">
                                            <th scope="col">#</th>
                                            <th scope="col">Nombre de la Categoria</th>
                                            <th scope="col">Descripcion</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Acciones</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $contador = 0;
                                            foreach ($categoria_datos as $categoria) {
                                                $id_categoria = $categoria['id_Categoria'];
                                                $nombre = $categoria['nombre'];
                                                $descripcion = $categoria['descripcion'];
                                                $estado = $categoria['estado'];
                                            ?>
                                                <tr>
                                                    <th><?= ++$contador; ?></th>
                                                    <td><?= htmlspecialchars($categoria['nombre']) ?></td>
                                                    <td><?= htmlspecialchars($categoria['descripcion']) ?></td>
                                                    <td>
                                                        <?php if ($categoria['estado'] === 'Activo'): ?>
                                                            <span class="badge bg-success px-3 py-2">Activo</span>
                                                        <?php else: ?>
                                                            <span class="badge bg-danger px-3 py-2">Inactivo</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <!-- Example single danger button -->
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                Ver Acciones
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a class="dropdown-item text-primary"
                                                                        href="#"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#editarCategoria<?= $id_categoria ?>">
                                                                        <i class="bi bi-pencil-square"></i> Editar
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <hr class="dropdown-divider">
                                                                </li>

                                                                <li>
                                                                    <a class="dropdown-item text-danger btn-eliminar-categoria" href="#" data-id="<?= $id_categoria ?>">
                                                                        <i class="bi bi-trash"></i> Eliminar
                                                                    </a>


                                                                </li>
                                                            </ul>

                                                        </div>
                                                    </td>
                                                </tr>

                                                <!-- Modal -->
                                                <div class="modal fade" id="editarCategoria<?= $id_categoria ?>" tabindex="-1" aria-hidden="true">

                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <form action="../app/controllers/categorias/update_Categorias.php" method="post">

                                                                <div class="modal-header bg-warning">
                                                                    <h5 class="modal-title">
                                                                        <i class="bi bi-pencil-square"></i> Editar Categoría
                                                                    </h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                </div>

                                                                <div class="modal-body">

                                                                    <!-- ID oculto -->
                                                                    <input type="hidden" name="id_Categoria" value="<?= $id_categoria ?>">

                                                                    <div class="mb-3">
                                                                        <label>Nombre: </label>
                                                                        <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($nombre) ?>">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label>Descripción</label>
                                                                        <textarea name="descripcion" class="form-control"><?= htmlspecialchars($descripcion) ?></textarea>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label>Estado</label>
                                                                        <select name="estado" class="form-select">
                                                                            <option value="Activo" <?= $estado === 'Activo' ? 'selected' : '' ?>> Activo </option>
                                                                            <option value="Inactivo" <?= $estado === 'Inactivo' ? 'selected' : '' ?>> Inactivo </option>
                                                                        </select>
                                                                    </div>

                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cancelar </button>
                                                                    <button type="submit" class="btn btn-success"> Guardar cambios </button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>

                                            <?php } ?>
                                        </tbody>

                                    </table>


                                </div>

                            </div> <!-- /.card-body -->
                        </div> <!-- /.card -->
                    </div> <!-- /.col -->




                </div> <!--end::Container-->
            </div> <!--end::App Content-->
        </main> <!--end::App Main-->

        <script>
            document.querySelectorAll('.btn-eliminar-categoria').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();

                    const idCategoria = this.getAttribute('data-id');

                    Swal.fire({
                        title: '¿Está seguro?',
                        text: 'Esta acción eliminará la categoría de forma permanente.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href =
                                '../app/controllers/categorias/delete_Categorias.php?id=' + idCategoria;
                        }
                    });
                });
            });
        </script>


        <?php include '../layouts/footer.php'; ?>
        <?php include '../layouts/notificacion.php'; ?>

        <script>
            $(function() {
                $('#Categorias').DataTable({
                    lengthMenu: [
                        [5, 10, 25, 50, 100],
                        [5, 10, 25, 50, 100]
                    ],
                    language: {
                        decimal: "",
                        emptyTable: "No hay datos disponibles en la tabla",
                        info: "Mostrando _START_ a _END_ de _TOTAL_ Categorias Registrados",
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

</body><!--end::Body-->

</html>