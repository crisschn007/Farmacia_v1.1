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
  <style>
    /* Nuevo color rosado para Femenino */
    .text-bg-pink {
      color: #fff !important;
      background-color: #e83e8c !important;
    }
  </style>
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

          <!-- Modal -->
          <div class="modal fade" id="add_cliente" tabindex="-1" aria-labelledby="add_clienteLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <form action="../app/controllers/clientes/add_clientes.php" method="post">
                  <div class="modal-header bg-primary text-white">
                    <h1 class="modal-title fs-5" id="add_clienteLabel">Agregar Nuevo Cliente</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="mb-3">
                      <label for="nombreCompleto" class="fw-bolder text-start">Nombre y Apellido: </label>
                      <input type="text" class="form-control" id="nombreCompleto" name="nombre_completo">
                    </div>
                    <div class="mb-3">
                      <label for="direccion_Cliente" class="fw-bolder text-start">Direccion:</label>
                      <textarea name="direccion_Cliente" id="direccion_Cliente" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                      <label for="telefono_Cliente" class="fw-bolder text-start">Teléfono:</label>
                      <input type="text" class="form-control" id="telefono_Cliente" name="telefono_Cliente">
                    </div>
                    <div class="mb-3">
                      <label for="email_Cliente" class="fw-bolder text-start">E-Mail:</label>
                      <input type="email" class="form-control" id="email_Cliente" name="email_Cliente">
                    </div>
                    <div class="mb-3">
                      <label for="cui_Cliente" class="fw-bolder text-start">DPI:</label>
                      <input type="text" class="form-control" id="cui_Cliente" name="cui_Cliente">
                    </div>
                    <div class="mb-3">
                      <label for="genero_Cliente" class="fw-bolder text-start">Género:</label>
                      <select name="genero_Cliente" id="genero_Cliente" class="form-select">
                        <option value="" hidden> --Seleccionar el Genero-- </option>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                        <option value="Otro">Otro</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="estado_Cliente" class="fw-bolder text-start">Estado:</label>
                      <select name="estado_Cliente" id="estado_Cliente" class="form-select">
                        <option value="" hidden> --Seleccionar el Estado-- </option>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                      </select>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-outline-success">Guardar Clientes</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="card card-outline card-success">
              <div class="card-header">

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_cliente">
                  <i class="bi bi-person-fill-add"></i> Agregar Cliente
                </button>

              </div> <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive overflow-auto">
                  <table class="table table-bordered table-hover align-middle text-nowrap w-100 text-center" id="Clientes">
                    <thead class="table-dark">
                      <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>E-Mail</th>
                        <th>DPI</th>
                        <th>Género</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>

                    <tbody class="text-center">
                      <?php
                      $contadorClientes = 0;
                      foreach ($db_clientes as $cliente) {
                        $id_cliente = $cliente['id_Clientes'];
                        $nombre_cliente = $cliente['nombre_y_apellido'];
                        $direccion_cliente = $cliente['direccion_cliente'];
                        $telefono_cliente = $cliente['telefono_cliente'];
                        $email_cliente = $cliente['email'];
                        $cui_cliente = $cliente['cui'];
                        $genero_cliente = $cliente['genero'];
                        $estado_cliente = $cliente['estado'];

                      ?>
                        <tr>
                          <th scope="row"><?= ++$contadorClientes; ?></th>
                          <td><?= htmlspecialchars($cliente['nombre_y_apellido']) ?></td>
                          <td><?= htmlspecialchars($cliente['direccion_cliente']) ?> </td>
                          <td><?= htmlspecialchars($cliente['telefono_cliente']) ?></td>
                          <td><?= htmlspecialchars($cliente['email']) ?></td>
                          <td><?= htmlspecialchars($cliente['cui']) ?></td>
                          <td>
                            <?php
                            switch ($cliente['genero']) {
                              case "Masculino":
                                echo '<span class="badge rounded-pill text-bg-primary">Masculino</span>';
                                break;
                              case "Femenino":
                                echo '<span class="badge rounded-pill text-bg-pink">Femenino</span>';
                                break;
                              case "Otro":
                                echo '<span class="badge rounded-pill text-bg-secondary">Otro</span>';
                                break;
                              default:
                                echo '<span class="text-muted">No definido</span>';
                                break;
                            }
                            ?>
                          </td>
                          <td>
                            <?php if ($cliente['estado'] === 'Activo'): ?>
                              <span class="badge bg-success px-3 py-2">Activo</span>
                            <?php else: ?>
                              <span class="badge bg-danger px-3 py-2">Inactivo</span>
                            <?php endif; ?>

                          </td>
                          <td>
                            <!-- Example single danger button -->
                            <div class="btn-group">
                              <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Ver Mas
                              </button>
                              <ul class="dropdown-menu">

                                <li>
                                  <a class="dropdown-item text-primary" href="#" data-bs-toggle="modal" data-bs-target="#editarCliente<?= $id_cliente; ?>">
                                    <i class="bi bi-pencil-square"></i> Editar
                                  </a>
                                </li>
                                <li>
                                  <hr class="dropdown-divider">
                                </li>
                                <li>
                                  <a class="dropdown-item text-danger btn-eliminar" href="#" data-id="<?= $id_cliente; ?>">
                                    <i class="bi bi-trash"></i> Eliminar
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </td>

                        </tr>


                        <!-- Modal para editar-->
                        <div class="modal fade" id="editarCliente<?= $id_cliente; ?>" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <form action="../app/controllers/clientes/update_clientes.php" method="post">
                                <div class="modal-header bg-warning text-black">
                                  <h1 class="modal-title fs-5"><i class="bi bi-pencil-square"></i> Editar Categoria</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                  <input type="hidden" name="id_Clientes" value="<?= $id_cliente; ?>">


                                  <div class="mb-3">
                                    <label for="nombreCliente<?= $id_cliente; ?>" class="fw-bolder text-start">Nombre y Apellido: </label>
                                    <input type="text" class="form-control" id="nombreCliente<?= $id_cliente; ?>" name="nombre_cliente" value="<?= htmlspecialchars($nombre_cliente); ?>">
                                  </div>
                                  <div class="mb-3">
                                    <label for="direccionCliente<?= $id_cliente; ?>" class="fw-bolder text-start">Dirección:</label>
                                    <textarea name="direccion" id="direccionCliente<?= $id_cliente; ?>" class="form-control"><?= htmlspecialchars($direccion_cliente); ?></textarea>
                                  </div>
                                  <div class="mb-3">
                                    <label for="telefonoCliente<?= $id_cliente; ?>" class="fw-bolder text-start">Teléfono:</label>
                                    <input type="text" class="form-control" id="telefonoCliente<?= $id_cliente; ?>" name="telefono" value="<?= htmlspecialchars($telefono_cliente); ?>">
                                  </div>
                                  <div class="mb-3">
                                    <label for="emailCliente<?= $id_cliente; ?>" class="fw-bolder text-start">E-Mail:</label>
                                    <input type="email" class="form-control" id="emailCliente<?= $id_cliente; ?>" name="correo" value="<?= htmlspecialchars($email_cliente); ?>">
                                  </div>
                                  <div class="mb-3">
                                    <label for="cuiCliente<?= $id_cliente; ?>" class="fw-bolder text-start">DPI:</label>
                                    <input type="text" class="form-control" id="cuiCliente<?= $id_cliente; ?>" name="dpi_o_nit" value="<?= htmlspecialchars($cui_cliente); ?>">
                                  </div>
                                  <div class="mb-3">
                                    <label for="generoCliente<?= $id_cliente; ?>" class="fw-bolder text-start">Género:</label>
                                    <select name="genero" id="generoCliente<?= $id_cliente; ?>" class="form-select">
                                      <option value="Masculino" <?= $genero_cliente === 'Masculino' ? 'selected' : ''; ?>>Masculino</option>
                                      <option value="Femenino" <?= $genero_cliente === 'Femenino' ? 'selected' : ''; ?>>Femenino</option>
                                      <option value="Otro" <?= $genero_cliente === 'Otro' ? 'selected' : ''; ?>>Otro</option>
                                    </select>
                                  </div>

                                  <div class="mb-3">
                                    <label for="estadoCliente<?= $id_cliente; ?>" class="fw-bolder text-start">Estado:</label>
                                    <select name="estado" id="estadoCliente<?= $id_cliente; ?>" class="form-select">
                                      <option value="Activo" <?= $estado_cliente === 'Activo' ? 'selected' : ''; ?>>Activo</option>
                                      <option value="Inactivo" <?= $estado_cliente === 'Inactivo' ? 'selected' : ''; ?>>Inactivo</option>
                                    </select>
                                  </div>

                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Cancelar</button>
                                    <button type="submit" class="btn btn-outline-success"><i class="bi bi-check-circle"></i> Guardar Cambios</button>
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
          const idCliente = this.getAttribute('data-id');

          Swal.fire({
            title: "¿Estás seguro?",
            text: "¡Esta acción no se puede deshacer!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar",
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false
          }).then((result) => {
            if (result.isConfirmed) {

              // Cerrar el Swal ANTES de redirigir
              Swal.fire({
                title: "Procesando...",
                text: "Por favor espera",
                icon: "info",
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                didOpen: () => {
                  Swal.showLoading();

                  // Redirigir correctamente
                  window.location.href = "<?= $URL ?>app/controllers/clientes/delete_clientes.php?id=" + idCliente;
                }
              });

            }
          });
        });
      });
    });
  </script>


  <?php include '../layouts/notificacion.php'; ?>

</body><!--end::Body-->

</html>