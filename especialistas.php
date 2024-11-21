<?php
session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = "Gracias, dentro de poco te contestarán un especialista";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Contactar Especialista - QuickStart Bootstrap Template</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <style>
    .contact-form {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 50px 0;
    }
    .contact-form .container {
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      max-width: 900px;
      width: 100%;
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
    }
    .contact-form h2 {
      width: 100%;
      margin-bottom: 30px;
      font-size: 24px;
      font-weight: 700;
      color: #333;
      text-align: center;
    }
    .contact-form .form-container {
      flex: 1;
      min-width: 300px;
      margin-right: 20px;
    }
    .contact-form .form-group {
      margin-bottom: 15px;
      width: 100%;
    }
    .contact-form .form-group label {
      display: block;
      margin-bottom: 5px;
      font-weight: 600;
    }
    .contact-form .form-group input,
    .contact-form .form-group textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 5px;
    }
    .contact-form .form-group textarea {
      resize: vertical;
    }
    .contact-form .btn-submit {
      background-color: #007bff;
      color: #fff;
      border: none;
      padding: 10px 20px;
      cursor: pointer;
      border-radius: 5px;
      margin-top: 20px;
    }
    .contact-form .btn-submit:hover {
      background-color: #0056b3;
    }
    .contact-form .message {
      margin-top: 20px;
      font-size: 18px;
      color: #28a745;
      width: 100%;
      text-align: center;
    }
    .contact-form .image-container {
      flex: 1;
      max-width: 400px;
      margin-left: 20px;
    }
    .contact-form .image-container img {
      width: 100%;
      border-radius: 10px;
    }
  </style>
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index_li.php" class="logo d-flex align-items-center me-auto">
        <img src="assets/img/logo.png" alt="">
        <h1 class="sitename">LifeSync</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index_li.php#hero" class="active">Inicio</a></li>
          <li><a href="index_li.php#services">Servicios</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      <a class="btn-getstarted" href="logout.php">Cerrar Sesión</a>

    </div>
  </header>

  <main class="main">

    <!-- Contact Form Section -->
    <section id="contact-form" class="contact-form section">
      <div class="container">
        <h2 class="text-center">Contactar Especialista</h2>
        <div class="form-container">
          <form action="especialistas.php" method="post">
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="email">Correo Electrónico</label>
              <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="mensaje">Mensaje</label>
              <textarea name="mensaje" id="mensaje" class="form-control" rows="5" required></textarea>
            </div>
            <div class="form-group text-center">
              <button type="submit" class="btn-submit">Enviar</button>
            </div>
          </form>
          <?php if (isset($message)): ?>
            <div class="message text-center"><?php echo $message; ?></div>
          <?php endif; ?>
        </div>
        <div class="image-container">
          <img src="https://kdahweb-static.kokilabenhospital.com/kdah-2019/shop/package/images/16225531190.jpg" alt="Especialista">
        </div>
      </div>
    </section><!-- /Contact Form Section -->

  </main>

  <footer id="footer" class="footer position-relative light-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">LifeSync</span>
          </a>
          <div class="footer-contact pt-3">
            <p>ESCOM</p>
            <p>INSTITUTO POLITÉCNICO NACIONAL</p>
            <p class="mt-3"><strong>Phone:</strong> <span>55 6987 6390</span></p>
            <p><strong>Email:</strong> <span>lifesynco@gmail.com</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Links Útiles</h4>
          <ul>
            <li><a href="#">Inicio</a></li>
            <li><a href="#">Acerca de</a></li>
            <li><a href="#">Servicios</a></li>
            <li><a href="#">Terminos y condiciones</a></li>
            <li><a href="#">Politica de privacidad</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Nuestra misión</h4>
          Proveer a nuestros usuarios de una herramienta que les permita organizar sus actividades diarias de manera eficiente.
        </div>

        <div class="col-lg-4 col-md-12 footer-newsletter">
          <h4>Nuestros avisos</h4>
          <p>Suscribete a nuestros avisos para obetener noticias de LifeSync</p>
          <form action="forms/newsletter.php" method="post" class="php-email-form">
            <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your subscription request has been sent. Thank you!</div>
          </form>
        </div>

      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>