<?php
session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Index - QuickStart Bootstrap Template</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: QuickStart
  * Template URL: https://bootstrapmade.com/quickstart-bootstrap-startup-website-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
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

    <!-- Hero Section -->
    <section id="hero" class="hero section">
      <div class="hero-bg">
        <img src="assets/img/hero-bg-light.webp" alt="">
      </div>
      <div class="container text-center">
        <div class="d-flex flex-column justify-content-center align-items-center">
          <h1 data-aos="fade-up">Bienvenido a <span>LifeSync</span>, <?php echo htmlspecialchars($_SESSION['nombre']); ?>!</h1>
          <p data-aos="fade-up" data-aos-delay="100">Organiza tus horarios de la mejor manera<br></p>
          <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
            <a href="#about" class="btn-get-started">Comienza</a>
            <a href="https://www.youtube.com/watch?v=oFzXfi9IGWw" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Ver Video</span></a>
          </div>
          <img src="assets/img/hero-services-img.webp" class="img-fluid hero-img" alt="" data-aos="zoom-out" data-aos-delay="300">
        </div>
      </div>

    </section><!-- /Hero Section -->



    <!-- Services Section -->
    <section id="services" class="services section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Servicios</h2>
        <p>Descubre los servicios a los que tienes acceso como miembro</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row g-5">

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item item-cyan position-relative">
              <i class="bi bi-activity icon"></i>
              <div>
                <h3>Gestor de Tareas</h3>
                <p>Aquí podrás añadir nuevas tareas, eliminarlas y llevar un control de las mismas!</p>
                <a href="tareas.php" class="read-more stretched-link">Llevame ahí <i class="bi bi-arrow-right"></i></a>
              </div>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item item-orange position-relative">
              <i class="bi bi-broadcast icon"></i>
              <div>
                <h3>Distribución de tareas</h3>
                <p>Dentro de este apartado, visualizarás analiticas acerca de tus tareas</p>
                <a href="distribucion.php" class="read-more stretched-link">LLevame ahí <i class="bi bi-arrow-right"></i></a>
              </div>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item item-teal position-relative">
              <i class="bi bi-calendar4-week icon"></i>
              <div>
                <h3>Agenda</h3>
                <p>De una manera más visual, consulta tus actividades en un mapa mensual!</p>
                <a href="agenda.php" class="read-more stretched-link">Llevame ahí <i class="bi bi-arrow-right"></i></a>
              </div>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item item-red position-relative">
              <i class="bi bi-bounding-box-circles icon"></i>
              <div>
                <h3>Especialistas</h3>
                <p>Obten consejos y recomendaciones de especialistas en la materia</p>
                <a href="especialistas.php" class="read-more stretched-link">LLevame ahí <i class="bi bi-arrow-right"></i></a>
              </div>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="500">
            <div class="service-item item-indigo position-relative">
              <i class="bi bi-easel icon"></i>
              <div>
                <h3>Herramienta en proceso!</h3>
                <p>Cumque et suscipit saepe. Est maiores autem enim facilis ut aut ipsam corporis aut. Sed animi at autem alias eius labore.</p>
                <a href="#" class="read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a>
              </div>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="600">
            <div class="service-item item-pink position-relative">
              <i class="bi bi-chat-square-text icon"></i>
              <div>
                <h3>herramienta en proceso!</h3>
                <p>Hic molestias ea quibusdam eos. Fugiat enim doloremque aut neque non et debitis iure. Corrupti recusandae ducimus enim.</p>
                <a href="#" class="read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a>
              </div>
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>

    </section><!-- /Services Section -->

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