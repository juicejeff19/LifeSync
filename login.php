<?php
session_start();
include_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $db = $database->getConnection();

    $correo = htmlspecialchars(strip_tags($_POST['correo']));
    $contraseña = htmlspecialchars(strip_tags($_POST['contraseña']));

    $query = "SELECT nombre, correo, contraseña FROM usuarios WHERE correo = :correo";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':correo', $correo);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($contraseña === $row['contraseña']) {
            $_SESSION['nombre'] = $row['nombre'];
            header("Location: index_li.php");
            exit();
        } else {
            $error_message = "Invalid password., the password is: " . $row['contraseña'];
        }
    } else {
        $error_message = "No user found with that email.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Login - QuickStart Bootstrap Template</title>
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">

  <style>
    .login-form {
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      align-items: center;
      min-height: 100vh;
      padding-top: 10vh;
    }

    .custom-btn {
      background-color: #4f5357;
      border-color: #007bff;
      color: #fff;
      padding: 10px 20px;
      font-size: 16px;
      border-radius: 5px;
      transition: background-color 0.3s, border-color 0.3s;
      margin-top: 20px;
    }

    .custom-btn:hover {
      background-color: #0056b3;
      border-color: #0056b3;
    }
  </style>
</head>

<body class="login-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <img src="assets/img/logo.png" alt="">
        <h1 class="sitename">LifeSync</h1>
      </a>
      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.html">Inicio</a></li>
          <li><a href="index.html#about">Acerca de</a></li>
          <li><a href="index.html#features">Productos</a></li>
          <li><a href="index.html#services">Servicios</a></li>
          <li><a href="index.html#pricing">Paquetes</a></li>
          <li><a href="index.html#contact">Contacto</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </header>

  <main class="main">
    <section id="login" class="login section">
      <div class="container" data-aos="fade-up">
        <div class="row justify-content-center">
          <div class="col-lg-4">
            <div class="login-form">
              <h2>Iniciar Sesión</h2>
              <?php if (isset($error_message)): ?>
                <div class="alert alert-danger" role="alert">
                  <?php echo $error_message; ?>
                </div>
              <?php endif; ?>
              <form action="login.php" method="post">
                <div class="form-group">
                  <label for="correo">Correo Electrónico</label>
                  <input type="email" name="correo" class="form-control mb-4" id="correo" required>
                </div>
                <div class="form-group">
                  <label for="contraseña">Contraseña</label>
                  <input type="password" name="contraseña" class="form-control" id="contraseña" required>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary custom-btn">Iniciar Sesión</button>
                </div>
                <div class="form-group">
                  <p class="text-center">¿No tienes una cuenta? <a href="register.php">Regístrate</a></p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <div id="preloader"></div>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/js/main.js"></script>

</body>

</html>