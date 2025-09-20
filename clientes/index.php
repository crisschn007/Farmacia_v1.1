<?php
include '../app/conexionDB.php';
include '../layouts/sesion.php';
include '../app/controllers/clientes/listado_clientes.php';
?>


<!DOCTYPE html>
<html lang="es"> <!--begin::Head-->

<head>
  <title>Clientes</title><!--begin::Primary Meta Tags-->

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
              <h3 class="mb-0">Clientes</h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page"> <i class="bi bi-person-vcard-fill"></i>
                  Clientes
                </li>
              </ol>
            </div>



          </div> <!--end::Row-->
        </div> <!--end::Container-->
      </div> <!--end::App Content Header--> <!--begin::App Content-->
      <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid">


          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_cliente">
            <i class="bi bi-person-fill-add"></i> Agregar Nuevo Cliente
          </button>

          <!-- Modal -->
          <div class="modal fade" id="add_cliente" tabindex="-1" aria-labelledby="add_clienteLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                  <h1 class="modal-title fs-5" id="add_clienteLabel">Agregar Nuevo Cliente</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="../app/controllers/clientes/add_clientes.php" method="post">

                    <div class="mb-3">
                      <label for="nombre_cliente" class="form-label" id="nombre_cliente">Nombre: </label>
                      <input type="text" name="nombre_cliente" id="nombre_cliente" class="form-control" maxlength="200">
                    </div>

                    <div class="mb-3">
                      <label for="dpi_o_nit" class="form-label" id="dpi_o_nit">DPI o NIT:</label>
                      <input type="text" name="dpi_o_nit" id="dpi_o_nit" class="form-control" maxlength="25">
                    </div>
                    <div class="mb-3">
                      <label for="telefono" class="form-label" id="telefono">Telefono:</label>
                      <input type="text" name="telefono" id="telefono" class="form-control" maxlength="15">
                    </div>
                    <div class="mb-3">
                      <label for="correo" class="form-label" id="correo">Correo Electronico:</label>
                      <input type="email" name="correo" id="correo" class="form-control" maxlength="100" value="consumidorfinal@ejemplo.com">

                    </div>
                    <div class="mb-3">
                      <label for="direccion" class="form-label" id="direccion">Direccion: </label>
                      <textarea name="direccion" id="direccion" class="form-control"></textarea>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Cancelar</button>
                      <button type="submit" class="btn btn-outline-success"><i class="bi bi-check-circle"></i> Guardar Cliente</button>
                    </div>
                  </form>
                </div>

              </div>
            </div>
          </div>

          <br><br>

          <div class="table-responsive overflow-auto">
            <table class="table table-bordered table-hover align-middle text-nowrap w-100" style="min-width: 600px;" id="Clientes">
              <thead class="text-center">
                <tr>
                  <th scope="col" class="text-center">#</th>
                  <th scope="col" class="text-center">Nombre</th>
                  <th scope="col" class="text-center">DPI / NIT</th>
                  <th scope="col" class="text-center">Telefono</th>
                  <th scope="col" class="text-center">Correo</th>
                  <th scope="col" class="text-center">Direccion</th>
                  <th scope="col" class="text-center">Acciones</th>
                </tr>
              </thead>
              <?php
              $contador_clientes = 0;
              foreach ($db_clientes as $clientes) {
                $id_clientes = $clientes['id_Cliente'];
                $nombre_clientes = $clientes['Nombre_Cliente'];
                $dpi_nit = $clientes['DPI_o_NIT'];
                $telefono_c = $clientes['Telefono'];
                $correo_c = $clientes['Correo'];
                $direccion_c = $clientes['Direccion'];

              ?>
                <tbody class="text-center">
                  <tr>
                    <th scope="row"><?php echo ++$contador_clientes; ?></th>
                    <td><?php echo $nombre_clientes; ?></td>
                    <td><?php echo $dpi_nit; ?></td>
                    <td><?php echo $telefono_c; ?></td>
                    <td><?php echo $correo_c; ?></td>
                    <td><?php echo $direccion_c; ?></td>
                    <td>
                      <!-- Example single danger button -->
                      <div class="btn-group">
                        <button type="button" class="btn btn-info text-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                          Ver Más
                        </button>
                        <ul class="dropdown-menu">

                          <li>
                            <a class="dropdown-item text-primary" href="#" data-bs-toggle="modal" data-bs-target="#edit_Cliente<?= $id_clientes ?>">
                              <i class="bi bi-pencil-square"></i> Editar
                            </a>
                          </li>

                          <li>
                            <hr class="dropdown-divider">
                          </li>

                          <li>
                            <a class="dropdown-item text-danger btn-eliminar" href="#" data-id="<?= $id_clientes ?>">
                              <i class="bi bi-trash-fill"></i> Eliminar
                            </a>
                          </li>
                        </ul>
                      </div>


                      <!-- Modal -->
                      <div class="modal fade" id="edit_Cliente<?= $id_clientes ?>" tabindex="-1" aria-labelledby="edit_ClienteLabel<?= $id_clientes ?>" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <form action="../app/controllers/clientes/update_clientes.php" method="post">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5" id="edit_ClienteLabel<?= $id_clientes ?>">Editar Cliente</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                              </div>
                              <div class="modal-body">
                                <input type="hidden" name="id_Cliente" value="<?= $id_clientes ?>">

                                <div class="mb-3">
                                  <label for="nombre_cliente<?= $id_clientes ?>" class="form-label fw-semibold text-start d-block">Nombre: </label>
                                  <input type="text" name="nombre_cliente" id="nombre_cliente<?= $id_clientes ?>"
                                    value="<?= htmlspecialchars($nombre_clientes) ?>" class="form-control" maxlength="200">
                                </div>

                                <div class="mb-3">
                                  <label for="dpi_o_nit<?= $id_clientes ?>" class="form-label fw-semibold text-start d-block" id="dpi_o_nit">DPI o NIT:</label>
                                  <input type="text" name="dpi_o_nit" id="dpi_o_nit<?= $id_clientes ?>" class="form-control"
                                    value="<?= htmlspecialchars($dpi_nit) ?>" maxlength="25">
                                </div>
                                <div class="mb-3">
                                  <label for="telefono<?= $id_clientes ?>" class="form-label fw-semibold text-start d-block" id="telefono">Telefono:</label>
                                  <input type="tel" name="telefono" id="telefono<?= $id_clientes ?>" class="form-control"
                                    value="<?= htmlspecialchars($telefono_c) ?>" maxlength="15">
                                </div>
                                <div class="mb-3">
                                  <label for="correo<?= $id_clientes ?>" class="form-label fw-semibold text-start d-block" id="correo">Correo Electronico:</label>
                                  <input type="email" name="correo" id="correo<?= $id_clientes ?>" class="form-control"
                                    value="<?= htmlspecialchars($correo_c) ?>" maxlength="100" placeholder="consumidorfinal@ejemplo.com">
                                </div>
                                <div class="mb-3">
                                  <label for="direccion<?= $id_clientes ?>" class="form-label fw-semibold text-start d-block" id="direccion">Direccion: </label>
                                  <textarea name="direccion" id="direccion<?= $id_clientes ?>" class="form-control"><?= htmlspecialchars($direccion_c) ?></textarea>
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


                    </td>
                  </tr>
                <?php } ?>
                </tbody>

            </table>
          </div>




        </div> <!--end::Container-->
      </div> <!--end::App Content-->
    </main> <!--end::App Main-->



    <?php include '../layouts/footer.php'; ?>

    <script>
      $(document).ready(function() {
        $('#Clientes').DataTable({
          lengthMenu: [
            [5, 10, 25, 50, 100],
            [5, 10, 25, 50, 100]
          ],
          language: {
            decimal: "",
            emptyTable: "No hay datos disponibles en la tabla",
            info: "Mostrando _START_ a _END_ de _TOTAL_ Clientes Registrados",
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

   <script>
            document.addEventListener('DOMContentLoaded', function() {
                const botonesEliminar = document.querySelectorAll('.btn-eliminar');

                botonesEliminar.forEach(boton => {
                    boton.addEventListener('click', function() {
                        const idRol = this.getAttribute('data-id');

                        Swal.fire({
                            title: "¿Estás seguro?",
                            text: "¡Esta acción no se puede deshacer!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Sí, eliminarlo",
                            cancelButtonText: "Cancelar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Redirigir dinámicamente con PHP
                                window.location.href = "<?= $URL ?>app/controllers/clientes/delete_clientes.php?id=" + idRol;                             
                            }
                        });
                    });
                });
            });
        </script>

    <?php include '../layouts/notificacion.php'; ?>
  




</body><!--end::Body-->

</html>