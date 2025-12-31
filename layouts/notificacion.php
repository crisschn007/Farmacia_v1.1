<?php
// layouts/notificacion.php
//session_start();

if (isset($_SESSION['titulo'], $_SESSION['mensaje'], $_SESSION['icono'])) {
    $titulo = $_SESSION['titulo'];
    $mensaje = $_SESSION['mensaje'];
    $icono = $_SESSION['icono'];

    echo "
    <script>
        Swal.fire({
            title: '$titulo',
            text: '$mensaje',
            icon: '$icono',
            confirmButtonText: 'Aceptar'
        });
    </script>";

    // Limpiar después de mostrar
    unset($_SESSION['titulo'], $_SESSION['mensaje'], $_SESSION['icono']);
}
?>