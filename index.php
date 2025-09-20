<?php
include 'app/conexionDB.php';
include 'layouts/sesion.php';
?>


<!DOCTYPE html>
<html lang="es"> <!--begin::Head-->

<head>
    <title>Inicio</title><!--begin::Primary Meta Tags-->

    <?php include 'layouts/head.php'; ?>
</head> <!--end::Head--> <!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary"> <!--begin::App Wrapper-->
    <div class="app-wrapper"> <!--begin::Header-->

        <?php include 'layouts/navAside.php'; //colocar un switch para el modo claro y oscuro
        ?>

        <!--begin::App Main-->
        <main class="app-main"> <!--begin::App Content Header-->
            <div class="app-content-header"> <!--begin::Container-->
                <div class="container-fluid"> <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Dashboard</h3>
                        </div>



                    </div> <!--end::Row-->
                </div> <!--end::Container-->
            </div> <!--end::App Content Header--> <!--begin::App Content-->
            <div class="app-content"> <!--begin::Container-->
                <div class="container-fluid">

                    <div class="row g-4">
                        <!-- Productos -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box text-bg-info position-relative p-3 rounded-4 shadow-sm overflow-hidden hover-card">
                                <div class="inner">
                                    <h3 class="fw-bold">120</h3>
                                    <p class="mb-0">Productos</p>
                                </div>

                                <!-- Icono SVG flotando en la esquina -->
                                <div class="position-absolute top-0 end-0 opacity-25 p-3" style="font-size: 60px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="white"
                                        class="bi bi-bag-fill" viewBox="0 0 16 16">
                                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5
                 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7
                 0V4H1v10a2 2 0 0 0 2 2h10a2 2
                 0 0 0 2-2V4z" />
                                    </svg>
                                </div>

                                <a href="<?php echo $URL ?>productos"
                                    class="small-box-footer link-light d-block mt-3">
                                    Ver más <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>


                        <!-- Lotes -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box text-bg-danger position-relative p-3 rounded-4 shadow-sm overflow-hidden hover-card">
                                <div class="inner">
                                    <h3 class="fw-bold">8</h3>
                                    <p class="mb-0">Lotes por vencer</p>
                                </div>

                                <!-- Icono SVG flotando en la esquina -->
                                <div class="position-absolute top-0 end-0 opacity-25 p-3" style="font-size: 60px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="white"
                                        class="bi bi-box-seam" viewBox="0 0 16 16">
                                        <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2zm3.564 1.426L5.596 5
                 8 5.961 14.154 3.5zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1
                 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5
                 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5
                 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5
                 0 0 1 .314-.464z" />
                                    </svg>
                                </div>

                                <a href="<?php echo $URL ?>lotes" class="small-box-footer link-light d-block mt-3">
                                    Ver más <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>



                        <!-- Ventas -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box text-bg-success position-relative p-3 rounded-4 shadow-sm overflow-hidden hover-card">
                                <div class="inner">
                                    <h3 class="fw-bold">45</h3>
                                    <p class="mb-0">Ventas hoy</p>
                                </div>

                                <!-- Icono SVG flotando en la esquina -->
                                <div class="position-absolute top-0 end-0 opacity-25 p-3" style="font-size: 60px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="white"
                                        class="bi bi-cash-stack" viewBox="0 0 16 16">
                                        <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zm7 8a2 2 0 1 0
                 0-4 2 2 0 0 0 0 4" />
                                        <path d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1
                 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2
                 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2
                 0 0 1-2-2z" />
                                    </svg>
                                </div>

                                <a href="<?php echo $URL ?>ventas"
                                    class="small-box-footer link-light d-block mt-3">
                                    Ver más <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Compras -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box text-bg-warning position-relative p-3 rounded-4 shadow-sm overflow-hidden hover-card">
                                <div class="inner">
                                    <h3 class="fw-bold">12</h3>
                                    <p class="mb-0">Compras este mes</p>
                                </div>

                                <!-- Icono SVG flotando en la esquina -->
                                <div class="position-absolute top-0 end-0 opacity-25 p-3" style="font-size: 60px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="white"
                                        class="bi bi-bag-plus" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1
                 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5
                 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5" />
                                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5
                 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1
                 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2
                 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1
                 1H3a1 1 0 0 1-1-1z" />
                                    </svg>
                                </div>

                                <a href="<?php echo $URL ?>compras"
                                    class="small-box-footer link-light d-block mt-3">
                                    Ver más <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>


                    </div>

                    <style>
                        .hover-card:hover {
                            transform: translateY(-4px);
                            transition: all 0.3s ease;
                            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
                        }

                        .small-box-icon {
                            z-index: 0;
                        }

                        .inner {
                            position: relative;
                            z-index: 1;
                        }
                    </style>






                </div> <!--end::Container-->
            </div> <!--end::App Content-->
        </main> <!--end::App Main-->



        <?php include 'layouts/footer.php'; ?>
        




</body><!--end::Body-->

</html>