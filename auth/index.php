<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Farmacia Miscelanea | Iniciar Sesión</title>
  <meta name="description" content="Inicia sesión en el sistema de la Farmacia Miscelanea.">

  <link rel="icon" type="image/png" href="https://images.emojiterra.com/google/android-12l/512px/2695.png">

  <!-- Fuentes e iconos -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.21.0/dist/sweetalert2.min.css">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

  <style>
    body.login-page {
      background-image: url('https://static.vecteezy.com/system/resources/previews/002/010/355/non_2x/pharmacy-drugstore-for-background-free-photo.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      font-family: 'Source Sans 3', sans-serif;
      min-height: 100vh;
      overflow-x: hidden;
      overflow-y: auto;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 1rem;
      position: relative;
      transition: background 0.5s ease;
    }

    /* Overlay */
    body.login-page::before {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.45);
      backdrop-filter: blur(2px);
      z-index: 0;
      transition: background 0.5s ease;
    }

    .login-box {
      max-width: 420px;
      width: 100%;
      position: relative;
      z-index: 1;
      background: rgba(255, 255, 255, 0.9);
      border-radius: 18px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.35);
      padding: 30px;
      animation: fadeIn 0.8s ease-in-out;
      backdrop-filter: blur(6px);
      transition: background 0.5s ease, color 0.5s ease;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(25px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    h1 {
      font-size: 1.8rem;
      font-weight: 700;
      color: #198754;
      transition: color 0.5s ease;
    }

    .login-box-msg {
      font-weight: 500;
      margin-bottom: 1rem;
      text-align: center;
      color: #495057;
      transition: color 0.5s ease;
    }

    .form-control:focus {
      border-color: #198754;
      box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
    }

    .btn-success {
      font-weight: 600;
      padding: 12px;
      border-radius: 10px;
      background: linear-gradient(135deg, #198754, #157347);
      border: none;
      transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .btn-success:hover {
      transform: scale(1.05);
      box-shadow: 0 6px 20px rgba(25, 135, 84, 0.4);
    }

    .input-group-text {
      background-color: #e9f7ef;
      color: #198754;
      border: 1px solid #cfe9dc;
      font-size: 1.2rem;
      transition: background 0.5s ease, color 0.5s ease;
    }

    .form-floating>label {
      color: #6c757d;
      transition: color 0.5s ease;
    }

    /* Toggle password button */
    .toggle-password {
      cursor: pointer;
      font-size: 1.2rem;
      color: #198754;
      background-color: #e9f7ef;
      border: 1px solid #cfe9dc;
      display: flex;
      align-items: center;
      padding: 0 0.75rem;
    }

    /* Modo oscuro */
    body.dark-mode::before {
      background: rgba(0, 0, 0, 0.65);
    }

    body.dark-mode .login-box {
      background: rgba(30, 30, 30, 0.92);
      color: #f1f1f1;
    }

    body.dark-mode h1 {
      color: #00d084;
    }

    body.dark-mode .login-box-msg {
      color: #e0e0e0;
    }

    body.dark-mode .form-floating>label {
      color: #bdbdbd;
    }

    body.dark-mode .input-group-text,
    body.dark-mode .toggle-password {
      background-color: #2d3a2f;
      color: #00d084;
      border: 1px solid #3e4e41;
    }

    /* Switch Dark Mode */
    .dark-mode-toggle {
      position: absolute;
      top: 15px;
      right: 20px;
      z-index: 2;
      display: flex;
      align-items: center;
      gap: 6px;
      font-size: 1rem;
      color: white;
    }

    .dark-mode-toggle i {
      font-size: 1.3rem;
      transition: color 0.3s ease;
    }
  </style>
</head>

<body class="login-page">

  <!-- Switch dark mode -->
  <div class="dark-mode-toggle">
    <i class="bi bi-sun-fill" id="modeIcon"></i>
    <div class="form-check form-switch m-0">
      <input class="form-check-input" type="checkbox" id="darkModeSwitch">
    </div>
  </div>

  <main class="login-box">

    <header class="text-center mb-4">
      <h1><i class="bi bi-capsule-pill"></i> <strong>Farmacia</strong> Miscelanea</h1>
    </header>

    <p class="login-box-msg">Inicia sesión para continuar</p>

    <form action="../app/controllers/auth/ingreso.php" method="post" aria-label="Formulario de inicio de sesión">
      <div class="input-group mb-3">
        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
        <div class="form-floating flex-grow-1">
          <input id="loginEmail" name="username_email" type="email" class="form-control"
            placeholder="E-mail" autocomplete="username_email" required>
          <label for="loginEmail">E-mail</label>
        </div>
      </div>

      <div class="input-group mb-4">
        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
        <div class="form-floating flex-grow-1">
          <input id="loginPassword" name="password" type="password" class="form-control"
            placeholder="Contraseña" autocomplete="current-password" required>
          <label for="loginPassword">Contraseña</label>
        </div>
        <span class="toggle-password"><i class="bi bi-eye-slash" id="toggleIcon"></i></span>
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-success">Iniciar Sesión</button>
      </div>
    </form>
  </main>

  <!-- Scripts -->
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/sweetalert2@11.21.0/dist/sweetalert2.all.min.js"></script>

  <script>
    // Toggle mostrar/ocultar contraseña
    document.querySelector(".toggle-password").addEventListener("click", () => {
      const input = document.getElementById("loginPassword");
      const icon = document.getElementById("toggleIcon");
      if (input.type === "password") {
        input.type = "text";
        icon.classList.replace("bi-eye-slash", "bi-eye");
      } else {
        input.type = "password";
        icon.classList.replace("bi-eye", "bi-eye-slash");
      }
    });

    // Dark mode switch con icono dinámico
    const darkModeSwitch = document.getElementById("darkModeSwitch");
    const modeIcon = document.getElementById("modeIcon");

    darkModeSwitch.addEventListener("change", function() {
      document.body.classList.toggle("dark-mode", this.checked);
      if (this.checked) {
        modeIcon.classList.replace("bi-sun-fill", "bi-moon-fill");
        modeIcon.style.color = "#00d084";
      } else {
        modeIcon.classList.replace("bi-moon-fill", "bi-sun-fill");
        modeIcon.style.color = "white";
      }
    });
  </script>

  <?php if (isset($_SESSION['titulo'])): ?>
    <script>
      Swal.fire({
        title: "<?php echo $_SESSION['titulo']; ?>",
        text: "<?php echo $_SESSION['mensaje']; ?>",
        icon: "<?php echo $_SESSION['icono']; ?>",
        timer: 1500,
        showConfirmButton: false,
        position: "top-end",
        toast: true
      });
    </script>
  <?php
    unset($_SESSION['titulo']);
    unset($_SESSION['mensaje']);
    unset($_SESSION['icono']);
  endif;
  ?>
  

</body>

</html>