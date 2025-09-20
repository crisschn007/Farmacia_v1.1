<nav class="app-header navbar navbar-expand bg-success-subtle" data-bs-theme="light"> <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
            <li class="nav-item d-none d-md-block">
                <a href="<?php echo $URL ?>index.php" class="nav-link">Inicio</a>
            </li>
        </ul>
        <!--end::Start Navbar Links-->

        <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto">

            <!-- 🌞🌙 Switch Modo Claro/Oscuro -->
            <li class="nav-item d-flex align-items-center">
                <button id="themeToggle" class="btn btn-outline-secondary btn-sm rounded-circle">
                    <i id="themeIcon" class="bi bi-sun"></i>
                </button>
            </li>

            <!--begin::Fullscreen Toggle-->
            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i>
                </a>
            </li>
            <!--end::Fullscreen Toggle-->

            <?php
            // Asegúrate de tener cargada la conexión y la sesión
            $nombre_usuario = $_SESSION['sesion_usuario'];

            $sql = "SELECT foto FROM usuario WHERE nombre_usuario = :nombre_usuario LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nombre_usuario', $nombre_usuario, PDO::PARAM_STR);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Usa la imagen del usuario si existe, si no una por defecto
            $fotoPerfil = !empty($usuario['foto']) ? $URL . $usuario['foto'] : 'https://cdn-icons-png.flaticon.com/512/3135/3135715.png';
            ?>

            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="<?php echo $fotoPerfil; ?>" class="user-image rounded-circle shadow" alt="User Image">
                    <span class="d-none d-md-inline"><?php echo isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Usuario desconocido'; ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <!--begin::User Image-->
                    <li class="user-header text-bg-success">
                        <img src="<?php echo $fotoPerfil; ?>" class="rounded-circle shadow" alt="User Image">
                        <p>
                            <?php echo isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Usuario desconocido'; ?>
                            <small>Miembro desde <?php echo date('Y'); ?></small>
                        </p>
                    </li>
                    <!--end::User Image-->

                    <!--begin::Menu Footer Personalizado-->
                    <li class="user-footer d-flex flex-column gap-2 bg-white px-3 pb-3 pt-2 rounded-bottom shadow-sm">
                        <a href="<?php echo $URL; ?>profile" class="btn btn-outline-secondary w-100 text-start">
                            <i class="bi bi-person-vcard-fill me-2"></i> Perfil de Usuario
                        </a>
                        <a href="<?php echo $URL; ?>app/controllers/auth/cerrar_sesion.php" class="btn btn-outline-danger w-100 text-start">
                            <i class="bi bi-box-arrow-right me-2"></i> Cerrar Sesión
                        </a>
                    </li>
                    <!--end::Menu Footer Personalizado-->
                </ul>
            </li>
            <!--end::User Menu Dropdown-->

        </ul>
        <!--end::End Navbar Links-->
    </div>
    <!--end::Container-->
</nav>
<!--end::Header-->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const themeToggle = document.getElementById("themeToggle");
        const themeIcon = document.getElementById("themeIcon");
        const body = document.body;

        // Cargar tema desde localStorage
        const savedTheme = localStorage.getItem("theme");
        if (savedTheme === "dark") {
            body.setAttribute("data-bs-theme", "dark");
            themeIcon.classList.remove("bi-sun");
            themeIcon.classList.add("bi-moon");
        } else {
            body.setAttribute("data-bs-theme", "light");
            themeIcon.classList.remove("bi-moon");
            themeIcon.classList.add("bi-sun");
        }

        // Alternar tema
        themeToggle.addEventListener("click", () => {
            if (body.getAttribute("data-bs-theme") === "light") {
                body.setAttribute("data-bs-theme", "dark");
                themeIcon.classList.remove("bi-sun");
                themeIcon.classList.add("bi-moon");
                localStorage.setItem("theme", "dark");
            } else {
                body.setAttribute("data-bs-theme", "light");
                themeIcon.classList.remove("bi-moon");
                themeIcon.classList.add("bi-sun");
                localStorage.setItem("theme", "light");
            }
        });
    });
</script>



<aside class="app-sidebar bg-success" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
    <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="<?php echo $URL ?>index.php" class="brand-link"> <!--begin::Brand Image-->
            <img src="https://images.emojiterra.com/google/android-12l/512px/2695.png" alt="Logo Farmacia" class="brand-image opacity-75 shadow"> <!--end::Brand Image--> <!--begin::Brand Text-->
            <span class="brand-text fw-light">Farmacia Miscelanea</span> <!--end::Brand Text--> </a> <!--end::Brand Link--> </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">


                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="<?php echo $URL ?>index.php" class="nav-link">
                        <i class="nav-icon bi bi-house"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Administración de Accesos -->
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link inactive">
                        <i class="nav-icon bi bi-key"></i>
                        <p>Admin. de Accesos <i class="nav-arrow bi bi-chevron-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview" style="margin-left: 20px;">
                        <li class="nav-item">
                            <a href="<?php echo $URL ?>usuarios" class="nav-link">
                                <i class="nav-icon bi bi-people"></i>
                                <p>Usuarios</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo $URL ?>roles" class="nav-link">
                                <i class="nav-icon bi bi-shield-lock"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Gestión de Productos -->
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link inactive">
                        <i class="nav-icon bi bi-box-seam"></i>
                        <p>Productos <i class="nav-arrow bi bi-chevron-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview" style="margin-left: 20px;">
                        <li class="nav-item">
                            <a href="<?php echo $URL ?>productos" class="nav-link">
                                <i class="nav-icon bi bi-capsule"></i>
                                <p>Productos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo $URL ?>categorias" class="nav-link">
                                <i class="nav-icon bi bi-tags"></i>
                                <p>Categorías</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo $URL ?>laboratorios" class="nav-link">
                                <i class="nav-icon bi bi-building"></i>
                                <p>Laboratorios</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo $URL ?>presentaciones" class="nav-link">
                                <i class="nav-icon bi bi-file-earmark-medical"></i>
                                <p>Presentaciones</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo $URL ?>tipos_producto" class="nav-link">
                                <i class="nav-icon bi bi-boxes"></i>
                                <p>Tipos de Producto</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Inventario -->
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link inactive">
                        <i class="nav-icon bi bi-clipboard-data"></i>
                        <p>Inventario <i class="nav-arrow bi bi-chevron-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview" style="margin-left: 20px;">
                        <li class="nav-item">
                            <a href="<?php echo $URL ?>lotes" class="nav-link">
                                <i class="nav-icon bi bi-list-check"></i>
                                <p>Lotes</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Compras -->
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link inactive">
                        <i class="nav-icon bi bi-cart-plus"></i>
                        <p>Compras <i class="nav-arrow bi bi-chevron-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview" style="margin-left: 20px;">
                        <li class="nav-item">
                            <a href="<?php echo $URL ?>compras" class="nav-link">
                                <i class="nav-icon bi bi-bag"></i>
                                <p>Registrar Compra</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo $URL ?>proveedores" class="nav-link">
                                <i class="nav-icon bi bi-truck"></i>
                                <p>Proveedores</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Ventas -->
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link inactive">
                        <i class="nav-icon bi bi-cash-coin"></i>
                        <p>Ventas <i class="nav-arrow bi bi-chevron-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview" style="margin-left: 20px;">
                        <li class="nav-item">
                            <a href="<?php echo $URL ?>ventas" class="nav-link">
                                <i class="nav-icon bi bi-cash-stack"></i>
                                <p>Registrar Venta</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo $URL ?>clientes" class="nav-link">
                                <i class="nav-icon bi bi-person-vcard"></i>
                                <p>Clientes</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Recetas Médicas -->
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link inactive">
                        <i class="nav-icon bi bi-file-earmark-text"></i>
                        <p>Recetas <i class="nav-arrow bi bi-chevron-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview" style="margin-left: 20px;">
                        <li class="nav-item">
                            <a href="<?php echo $URL ?>recetas" class="nav-link">
                                <i class="nav-icon bi bi-journal-medical"></i>
                                <p>Recetas Médicas</p>
                            </a>
                        </li>
                    </ul>
                </li>


            </ul> <!--end::Sidebar Menu-->
        </nav>
    </div> <!--end::Sidebar Wrapper-->
</aside> <!--end::Sidebar-->