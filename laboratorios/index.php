<?php
include '../app/conexionDB.php';
include '../layouts/sesion.php';
?>


<!DOCTYPE html>
<html lang="es"> <!--begin::Head-->

<head>
    <title>Inicio</title><!--begin::Primary Meta Tags-->

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
                            <h3 class="mb-0">Laboratorios</h3>
                        </div>



                    </div> <!--end::Row-->
                </div> <!--end::Container-->
            </div> <!--end::App Content Header--> <!--begin::App Content-->
            <div class="app-content"> <!--begin::Container-->
                <div class="container-fluid">





                </div> <!--end::Container-->
            </div> <!--end::App Content-->
        </main> <!--end::App Main-->

      

        <?php include '../layouts/footer.php'; ?>
        <?php include '../layouts/notificacion.php'; ?>

  


</body><!--end::Body-->

</html>